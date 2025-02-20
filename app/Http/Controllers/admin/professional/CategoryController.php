<?php

namespace App\Http\Controllers\admin\professional;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfessionalCategoryRequest;
use App\Models\ProfessionalCategory;
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
            $categories = ProfessionalCategory::query()->get();

            return DataTables::of($categories)
                ->addIndexColumn()
                ->editColumn('status', function ($category) {
                    return $category->status === 'active'
                        ? '<span class="badge badge-success">Active</span>'
                        : '<span class="badge badge-danger">Inactive</span>';
                })
                ->addColumn('action', function ($category) {
                    return '
                        <a href="' . route('professional_category.edit', $category->slug) . '" 
                            class="btn btn-warning btn-sm text-white" title="Edit">
                            <i class="fa-solid fa-pencil"></i>
                        </a>
                        <button class="btn btn-dark btn-sm toggle-status-btn" 
                            data-slug="' . $category->slug . '" data-status="' . $category->status . '" 
                            title="Change Status">
                            <i class="fa-solid fa-toggle-on"></i>
                        </button>
                         <button class="btn btn-danger btn-sm delete-btn" data-slug="' . $category->slug . '" title="delete professional category"><i class="fa-solid fa-trash"></i></button>
                    ';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        

        return view('backend.professional.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('backend.professional.category.create');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProfessionalCategoryRequest $request)
    {
        try {
            // Create the category record
            ProfessionalCategory::create([
                'name' => $request['name'],
                'status' => $request['status'],
            ]);
            return redirect()->route('professional_category.index')->with('success', 'Professional category has been created successfully!');
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
            $category = ProfessionalCategory::where('slug', $slug)->first();
            if (!$category) {
                return back()->with('error', 'Category not found!');
            }
            return view('backend.professional.category.edit', compact('category'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfessionalCategoryRequest $request, $slug)
    {
        try {
            $category = ProfessionalCategory::where('slug', $slug)->first();
            if (!$category) {
                return back()->with('error', 'Category not found!');
            }

            // Update the category record
            $category->update([
                'name' => $request['name'],
                'status' => $request['status'],
            ]);
            return redirect()->route('professional_category.index')->with('success', 'Professional category has been updated successfully!');
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
            $category = ProfessionalCategory::where('slug', $slug)->first();

            if (!$category) {
                return response()->json(['status' => 'error', 'message' => 'Category not found']);
            }

            // Check if category is associated with any products
            // if ($color->products()->exists()) {
            //     return response()->json([
            //         'status' => 'error',
            //         'message' => 'Cannot delete color. It is associated with products.'
            //     ]);
            // }

            $category->delete();

            return response()->json(['status' => 'success', 'message' => 'Category deleted successfully']);
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
            $category = ProfessionalCategory::where('slug', $slug)->firstOrFail();
            $category->status = $request->status;
            $category->save();

            return response()->json(['message' => 'Status updated successfully.']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}
