<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Repositories\Interfaces\BlogRepositoryInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    private $blogRepository;

    /**
     * constructor
     */
    public function __construct(BlogRepositoryInterface $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $blogs = Blog::query();

            return DataTables::of($blogs)
                ->addIndexColumn()
                ->editColumn('image', function ($blog) {
                    return '<img src="' . asset($blog->image) . '" alt="Blog Image" loading="lazy" height="30" style="cursor:pointer;" class="blog-image" data-url="' . asset($blog->image) . '">';
                })
                ->editColumn('status', function ($blog) {
                    if ($blog->status === 'active') {
                        return '<span class="badge badge-success">Active</span>';
                    }
                    return '<span class="badge badge-danger">Inactive</span>';
                })
                ->addColumn('action', function ($blog) {
                    $buttons = '
                        <a href="' . route('blogs.show', $blog->slug) . '" class="btn btn-primary btn-sm text-white" title="view blog"><i class="fa-solid fa-eye"></i></a>
                    ';

                    // Check if the user is an admin
                    $buttons .= '
                            <a href="' . route('blogs.edit', $blog->slug) . '" class="btn btn-warning btn-sm text-white" title="edit blog"><i class="fa-solid fa-pencil"></i></a>
                            <button class="btn btn-danger btn-sm delete-btn" data-slug="' . $blog->slug . '" title="delete blog"><i class="fa-solid fa-trash"></i></button>
                        ';
                    return $buttons;
                })
                ->rawColumns(['image', 'action', 'status'])
                ->make(true);
        }

        return view('backend.blogs.index');
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('backend.blogs.create');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {
        try {
            $this->blogRepository->store($request);
            return redirect()->route('blogs.index')->with('success', 'Blog has been created successfully!');
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
            $blog = Blog::where('slug', $slug)->first();
            if (!$blog) {
                return back()->with('error', 'Blog not found!');
            }
            return view('backend.blogs.view', compact('blog'));
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
            $blog = Blog::where('slug', $slug)->first();
            if (!$blog) {
                return back()->with('error', 'Blog not found!');
            }
            return view('backend.blogs.edit', compact('blog'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, $slug)
    {
        try {
            $blog = Blog::where('slug', $slug)->first();
            if (!$blog) {
                return back()->with('error', 'Blog not found!');
            }
            $this->blogRepository->update($request,$blog);
            return redirect()->route('blogs.index')->with('success', 'Blog has been updated successfully!');
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
            $blog = Blog::where('slug', $slug)->first();
            if(!$blog){
                return response()->json(['status' => 'error', 'message' => 'Blog not found']);
            }
            $this->blogRepository->destroy($blog);
            return response()->json(['status' => 'success', 'message' => 'Blog deleted successfully']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}
