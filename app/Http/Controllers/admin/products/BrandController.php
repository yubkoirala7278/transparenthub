<?php

namespace App\Http\Controllers\admin\products;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductBrandRequest;
use App\Models\ProductBrand;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BrandController extends Controller
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
            $brands = ProductBrand::query(); // Default ordering

            return DataTables::of($brands)
                ->addIndexColumn()
                ->editColumn('image', function ($brand) {
                    return '<img src="' . asset($brand->image) . '" alt="Brand Image" loading="lazy" height="30" style="cursor:pointer;" class="brand-image" data-url="' . asset($brand->image) . '">';
                })
                ->editColumn('status', function ($brand) {
                    return $brand->status === 'active'
                        ? '<span class="badge badge-success">Active</span>'
                        : '<span class="badge badge-danger">Inactive</span>';
                })
                ->addColumn('action', function ($brand) {
                    return '
                        <a href="' . route('products_brand.edit', $brand->slug) . '" 
                            class="btn btn-warning btn-sm text-white" title="Edit">
                            <i class="fa-solid fa-pencil"></i>
                        </a>
                        <button class="btn btn-dark btn-sm toggle-status-btn" 
                            data-slug="' . $brand->slug . '" data-status="' . $brand->status . '" 
                            title="Change Status">
                            <i class="fa-solid fa-toggle-on"></i>
                        </button>
                        <button class="btn btn-danger btn-sm delete-btn" data-slug="' . $brand->slug . '" title="delete brand"><i class="fa-solid fa-trash"></i></button>
                    ';
                })
                ->rawColumns(['status', 'action', 'image'])
                ->make(true);
        }

        return view('backend.products.brands.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('backend.products.brands.create');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductBrandRequest $request)
    {
        try {
            $this->productRepository->storeProductBrand($request);
            return redirect()->route('products_brand.index')->with('success', 'Brand has been created successfully!');
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
            $brand = ProductBrand::where('slug', $slug)->first();
            if (!$brand) {
                return back()->with('error', 'Brand not found!');
            }
            return view('backend.products.brands.edit', compact('brand'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductBrandRequest $request, $slug)
    {
        try {
            // Find the brand by slug
            $brand = ProductBrand::where('slug', $slug)->first();
            if (!$brand) {
                return back()->with('error', 'Brand not found!');
            }
            $this->productRepository->updateProductBrand($request, $brand);
            return redirect()->route('products_brand.index')->with('success', 'Brand has been updated successfully!');
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
            $brand = ProductBrand::where('slug', $slug)->first();
            if(!$brand){
                return response()->json(['status' => 'error', 'message' => 'Brand not found']);
            }
            $this->productRepository->destroyProductBrand($brand);
            return response()->json(['status' => 'success', 'message' => 'Brand deleted successfully']);
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
            $brand = ProductBrand::where('slug', $slug)->firstOrFail();
            $brand->status = $request->status;
            $brand->save();

            return response()->json(['message' => 'Status updated successfully.']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}
