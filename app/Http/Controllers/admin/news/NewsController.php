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
            if (!$news) {
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
            try {
                $image = $request->file('upload');

                // Get original file name (without extension)
                $originName = $image->getClientOriginalName();
                $fileNameWithoutExt = pathinfo($originName, PATHINFO_FILENAME);

                // Set the desired extension (we try WebP first)
                $extension = 'webp';
                $uniqueTime = time();
                $fileName = "{$fileNameWithoutExt}_{$uniqueTime}.{$extension}";

                // Define the destination path in the public directory
                $destinationPath = public_path('media');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
                $fullPath = $destinationPath . '/' . $fileName;

                // Process the image: resize while maintaining aspect ratio and prevent upscaling.
                $img = Image::make($image)
                    ->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });

                // Check if your PHP installation supports WebP encoding.
                // If not, fallback to JPG.
                if (function_exists('imagewebp')) {
                    $img->encode('webp', 80);
                } else {
                    // Fallback to JPG if WebP is not supported.
                    $extension = 'jpg';
                    $fileName = "{$fileNameWithoutExt}_{$uniqueTime}.{$extension}";
                    $fullPath = $destinationPath . '/' . $fileName;
                    $img->encode('jpg', 80);
                }

                // Save the processed image.
                $img->save($fullPath);

                // Build the URL for the saved image.
                $url = asset('media/' . $fileName);

                // Return JSON response as required by CKEditor.
                return response()->json([
                    'fileName' => $fileName,
                    'uploaded' => 1,
                    'url' => $url,
                ]);
            } catch (\Exception $e) {
                // Log the error or handle it as needed.
                return response()->json(['error' => 'Could not upload image: ' . $e->getMessage()], 500);
            }
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
