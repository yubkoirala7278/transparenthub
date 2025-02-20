<?php

namespace App\Http\Controllers\admin\professional;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfessionalSubCategoryRequest;
use App\Models\ProfessionalCategory;
use App\Models\ProfessionalSubCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $sub_categories = ProfessionalSubCategory::with('category') // Eager load the 'category' relationship
                ->get(); // Fetch all sub-categories along with their category

            return DataTables::of($sub_categories)
                ->addIndexColumn()
                ->editColumn('status', function ($sub_category) {
                    return $sub_category->status === 'active'
                        ? '<span class="badge badge-success">Active</span>'
                        : '<span class="badge badge-danger">Inactive</span>';
                })
                ->addColumn('category', function ($sub_category) {
                    return $sub_category->category ? $sub_category->category->name : 'No Category'; // Display category name
                })
                ->addColumn('action', function ($sub_category) {
                    return '
                        <a href="' . route('professional_sub_category.edit', $sub_category->slug) . '" 
                            class="btn btn-warning btn-sm text-white" title="Edit">
                            <i class="fa-solid fa-pencil"></i>
                        </a>
                        <button class="btn btn-dark btn-sm toggle-status-btn" 
                            data-slug="' . $sub_category->slug . '" data-status="' . $sub_category->status . '" 
                            title="Change Status">
                            <i class="fa-solid fa-toggle-on"></i>
                        </button>
                         <button class="btn btn-danger btn-sm delete-btn" data-slug="' . $sub_category->slug . '" title="delete sub category"><i class="fa-solid fa-trash"></i></button>
                    ';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('backend.professional.sub_category.index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $categories = ProfessionalCategory::where('status', 'active')->orderBy('name', 'asc')->get();
            return view('backend.professional.sub_category.create', compact('categories'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProfessionalSubCategoryRequest $request)
    {
        try {
            // Create the sub category record
            ProfessionalSubCategory::create([
                'name' => $request['name'],
                'status' => $request['status'],
                'professional_categories_id' => $request['category_id']
            ]);
            return redirect()->route('professional_sub_category.index')->with('success', 'Sub Category has been created successfully!');
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
            $sub_category = ProfessionalSubCategory::where('slug', $slug)->first();
            if (!$sub_category) {
                return back()->with('error', 'Sub Category not found!');
            }
            $categories = ProfessionalCategory::where('status', 'active')->orderBy('name', 'asc')->get();
            return view('backend.professional.sub_category.edit', compact('sub_category', 'categories'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfessionalSubCategoryRequest $request, $slug)
    {
        try {
            $sub_category = ProfessionalSubCategory::where('slug', $slug)->first();
            if (!$sub_category) {
                return back()->with('error', 'Sub Category not found!');
            }

            // Update the sub category record
            $sub_category->update([
                'name' => $request['name'],
                'status' => $request['status'],
                'professional_categories_id' => $request['category_id']
            ]);
            return redirect()->route('professional_sub_category.index')->with('success', 'Sub Category has been updated successfully!');
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
            $sub_category = ProfessionalSubCategory::where('slug', $slug)->first();

            if (!$sub_category) {
                return response()->json(['status' => 'error', 'message' => 'Sub Category not found']);
            }

            // Check if subcategory has related products
            // if ($sub_category->products()->exists()) {
            //     return response()->json([
            //         'status' => 'error',
            //         'message' => 'Cannot delete subcategory. It has associated products.'
            //     ]);
            // }

            $sub_category->delete();

            return response()->json(['status' => 'success', 'message' => 'Sub Category deleted successfully']);
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
            $sub_category = ProfessionalSubCategory::where('slug', $slug)->firstOrFail();
            $sub_category->status = $request->status;
            $sub_category->save();

            return response()->json(['message' => 'Status updated successfully.']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}
