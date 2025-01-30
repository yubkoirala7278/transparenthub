<?php

namespace App\Http\Controllers\admin\products;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCategoryRequest;
use App\Models\ProductCategory;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class CategoryController extends Controller
{
    private $productRepository;
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categories = ProductCategory::query(); // Default ordering

            return DataTables::of($categories)
                ->addIndexColumn()
                ->editColumn('image', function ($category) {
                    return '<img src="' . asset($category->image) . '" alt="Category Image" loading="lazy" height="30" style="cursor:pointer;" class="category-image" data-url="' . asset($category->image) . '">';
                })
                ->editColumn('status', function ($category) {
                    return $category->status === 'active'
                        ? '<span class="badge badge-success">Active</span>'
                        : '<span class="badge badge-danger">Inactive</span>';
                })
                ->addColumn('action', function ($category) {
                    return '
                        <a href="' . route('products_category.edit', $category->slug) . '" 
                            class="btn btn-warning btn-sm text-white" title="Edit">
                            <i class="fa-solid fa-pencil"></i>
                        </a>
                        <button class="btn btn-dark btn-sm toggle-status-btn" 
                            data-slug="' . $category->slug . '" data-status="' . $category->status . '" 
                            title="Change Status">
                            <i class="fa-solid fa-toggle-on"></i>
                        </button>
                        <button class="btn btn-danger btn-sm delete-btn" data-slug="' . $category->slug . '" title="delete category"><i class="fa-solid fa-trash"></i></button>
                    ';
                })
                ->rawColumns(['status', 'action', 'image'])
                ->make(true);
        }

        return view('backend.products.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('backend.products.category.create');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCategoryRequest $request)
    {
        try {
            $this->productRepository->storeProductCategory($request);
            return redirect()->route('products_category.index')->with('success', 'Category has been created successfully!');
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
            $category = ProductCategory::where('slug', $slug)->first();
            if (!$category) {
                return back()->with('error', 'Category not found!');
            }
            return view('backend.products.category.edit', compact('category'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductCategoryRequest $request, $slug)
    {
        try {
            // Find the category by slug
            $category = ProductCategory::where('slug', $slug)->first();
            if (!$category) {
                return back()->with('error', 'Category not found!');
            }
            $this->productRepository->updateProductCategory($request, $category);
            return redirect()->route('products_category.index')->with('success', 'Category has been updated successfully!');
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
            $category = ProductCategory::where('slug', $slug)->first();
            if(!$category){
                return response()->json(['status' => 'error', 'message' => 'Category not found']);
            }
            $this->productRepository->destroyProductCategory($category);
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
            $category = ProductCategory::where('slug', $slug)->firstOrFail();
            $category->status = $request->status;
            $category->save();

            return response()->json(['message' => 'Status updated successfully.']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}
