<?php

namespace App\Http\Controllers\admin\news;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsCategoryRequest;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categories = NewsCategory::query(); // Default ordering

            return DataTables::of($categories)
                ->addIndexColumn()
                ->editColumn('status', function ($category) {
                    return $category->status === 'active'
                        ? '<span class="badge badge-success">Active</span>'
                        : '<span class="badge badge-danger">Inactive</span>';
                })
                ->addColumn('action', function ($category) {
                    return '
                        <a href="' . route('news_category.edit', $category->slug) . '" 
                            class="btn btn-warning btn-sm text-white" title="Edit">
                            <i class="fa-solid fa-pencil"></i>
                        </a>
                        <button class="btn btn-dark btn-sm toggle-status-btn" 
                            data-slug="' . $category->slug . '" data-status="' . $category->status . '" 
                            title="Change Status">
                            <i class="fa-solid fa-toggle-on"></i>
                        </button>
                    ';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('backend.news.category.index');
    }





    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('backend.news.category.create');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewsCategoryRequest $request)
    {
        try {
            // Create the category record
            NewsCategory::create([
                'name' => $request['name'],
                'status' => $request['status']
            ]);
            return redirect()->route('news_category.index')->with('success', 'Category has been created successfully!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        try {
            $category = NewsCategory::where('slug', $slug)->first();
            if (!$category) {
                return back()->with('error', 'Category not found!');
            }
            return view('backend.news.category.edit', compact('category'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NewsCategoryRequest $request, $slug)
    {
        try {
            $category = NewsCategory::where('slug', $slug)->first();
            if (!$category) {
                return back()->with('error', 'Category not found!');
            }

            // Update the category record
            $category->update([
                'name' => $request['name'],
                'status' => $request['status']
            ]);
            return redirect()->route('news_category.index')->with('success', 'Category has been updated successfully!');
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
            $category = NewsCategory::where('slug', $slug)->first();
            if ($category) {
                $category->delete();
                return response()->json(['status' => 'success', 'message' => 'Category deleted successfully']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Category not found']);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }

    /**
     * toggle status
     */
    public function toggleStatus(Request $request, $slug)
    {
        try {
            $category = NewsCategory::where('slug', $slug)->firstOrFail();
            $category->status = $request->status;
            $category->save();

            return response()->json(['message' => 'Status updated successfully.']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}
