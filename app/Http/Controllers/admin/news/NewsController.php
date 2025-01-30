<?php

namespace App\Http\Controllers\admin\news;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\NewsSource;
use App\Repositories\Interfaces\NewsRepositoryInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    private $newsRepository;

    /**
     * constructor
     */
    public function __construct(NewsRepositoryInterface $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $news = News::with('news_categories')->latest()->get();

                return DataTables::of($news)
                    ->addIndexColumn()
                    ->editColumn('status', function ($news) {
                        if ($news->status === 'active') {
                            return '<span class="badge badge-success">Active</span>';
                        }
                        return '<span class="badge badge-danger">Inactive</span>';
                    })
                    ->addColumn('category', function ($news) {
                        return $news->news_categories->name ?? 'N/A';
                    })
                    ->editColumn('trending_news', function ($news) {
                        if ($news->trending_news) {
                            return '<span class="badge badge-success">Yes</span>';
                        }
                        return '<span class="badge badge-danger">No</span>';
                    })
                    ->addColumn('created_at', function ($news) {
                        return $news->created_at->format('F d, Y'); // Format the date
                    })
                    ->editColumn('image', function ($news) {
                        return '<img src="' . asset($news->image) . '" alt="News Image" loading="lazy" height="30" style="cursor:pointer;" class="news-image" data-url="' . asset($news->image) . '">';
                    })
                    ->addColumn('action', function ($news) {
                        $buttons = '
                            <a href="' . route('news.show', $news->slug) . '" class="btn btn-primary btn-sm text-white" title="view news"><i class="fa-solid fa-eye"></i></a>
                        ';

                        // Check if the user is an admin
                        $buttons .= '
                                <a href="' . route('news.edit', $news->slug) . '" class="btn btn-warning btn-sm text-white" title="edit news"><i class="fa-solid fa-pencil"></i></a>
                                <button class="btn btn-danger btn-sm delete-btn" data-slug="' . $news->slug . '" title="delete news"><i class="fa-solid fa-trash"></i></button>
                            ';
                        return $buttons;
                    })
                    ->rawColumns(['status', 'image', 'action', 'trending_news']) // Allow HTML rendering
                    ->make(true);
            }

            return view('backend.news.news.index');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $categories = NewsCategory::where('status', 'active')->latest()->get();
            $sources = NewsSource::where('status', 'active')->latest()->get();
            return view('backend.news.news.create', compact('categories', 'sources'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewsRequest $request)
    {
        try {
            $this->newsRepository->storeNews($request);
            return redirect()->route('news.index')->with('success', 'News has been created successfully!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        try {
            $news = News::where('slug', $slug)->first();
            if (!$news) {
                return back()->with('error', 'News not found!');
            }
            return view('backend.news.news.view', compact('news'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        try {
            $news = News::with('news_categories', 'news_sources')->where('slug', $slug)->first();
            if (!$news) {
                return back()->with('error', 'News not found!');
            }
            $categories = NewsCategory::where('status', 'active')->latest()->get();
            $sources = NewsSource::where('status', 'active')->latest()->get();
            return view('backend.news.news.edit', compact('news', 'categories', 'sources'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NewsRequest $request, $slug)
    {
        try {
            $news = News::where('slug', $slug)->first();
            if (!$news) {
                return back()->with('error', 'News not found!');
            }
            $this->newsRepository->updateNews($request, $news);
            return redirect()->route('news.index')->with('success', 'News has been updated successfully!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        try {
            $news = News::where('slug', $slug)->first();
            if(!$news){
                return response()->json(['status' => 'error', 'message' => 'News not found']);
            }
            $this->newsRepository->destroyNews($news);
            return response()->json(['status' => 'success', 'message' => 'News deleted successfully']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }

    /**
     * upload  file from ck editor
     */
    public function upload(Request $request): JsonResponse
    {
        if ($request->hasFile('upload')) {
            $image = $request->file('upload');

            // Get the original file name and extension
            $originName = $image->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();

            // Generate a unique file name with WebP extension
            $fileName = $fileName . '_' . time() . '.webp';

            // Define the storage path (public directory for CKEditor images)
            $path = public_path('media/' . $fileName);

            // Process and compress the image
            $img = Image::make($image)
                ->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio(); // Maintain aspect ratio
                    $constraint->upsize(); // Prevent upscaling
                })
                ->encode('webp', 80); // Convert to WebP format with 80% quality

            // Save the image in the 'media' directory
            $img->save($path);

            // Get the URL of the uploaded image
            $url = asset('media/' . $fileName);

            // Return the response as required by CKEditor
            return response()->json([
                'fileName' => $fileName,
                'uploaded' => 1,
                'url' => $url
            ]);
        }

        return response()->json(['error' => 'No file uploaded.'], 400);
    }
    /**
     * delete  file from ck editor
     */
    public function delete(Request $request): JsonResponse
    {
        $images = $request->input('images', []);
        $errors = [];

        foreach ($images as $image) {
            $filePath = public_path('media/' . basename($image));
            if (File::exists($filePath)) {
                File::delete($filePath);
            } else {
                $errors[] = $image;
            }
        }

        if (empty($errors)) {
            return response()->json(['success' => true, 'message' => 'Images deleted successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'Some images could not be deleted.', 'errors' => $errors]);
    }
}
