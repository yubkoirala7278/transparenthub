<?php

namespace App\Http\Controllers\admin\products;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\ProductSubCategory;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\JsonResponse;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
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
            $products = Product::with(['category', 'subCategory', 'brand'])->get();

            return DataTables::of($products)
                ->addIndexColumn()
                ->editColumn('feature_image', function ($product) {
                    return '<img src="' . asset($product->feature_image) . '" alt="Product Image" loading="lazy" height="30" style="cursor:pointer;" class="product-image" data-url="' . asset($product->feature_image) . '">';
                })
                ->editColumn('status', function ($product) {
                    return $product->status === 'active'
                        ? '<span class="badge badge-success">Active</span>'
                        : '<span class="badge badge-danger">Inactive</span>';
                })
                ->editColumn('track_qty', function ($product) {
                    return $product->track_qty
                        ? '<span class="badge badge-success">Yes</span>'
                        : '<span class="badge badge-danger">No</span>';
                })
                ->editColumn('qty', function ($product) {
                    return $product->qty
                        ?? 'N/A';
                })
                ->editColumn('is_featured', function ($product) {
                    return $product->is_featured=='Yes'
                        ? '<span class="badge badge-success">Yes</span>'
                        : '<span class="badge badge-danger">No</span>';
                })
                ->addColumn('category', function ($product) {
                    return $product->category ? $product->category->name : 'N/A';
                })
                ->addColumn('sub_category', function ($product) {
                    return $product->subCategory ? $product->subCategory->name : 'N/A';
                })
                ->addColumn('brand', function ($product) {
                    return $product->brand ? $product->brand->name : 'N/A';
                })
                ->addColumn('action', function ($product) {
                    return '
                    <a href="' . route('products.edit', $product->slug) . '" 
                        class="btn btn-warning btn-sm text-white" title="Edit">
                        <i class="fa-solid fa-pencil"></i>
                    </a>
                     <a href="' . route('products.show', $product->slug) . '" 
                        class="btn btn-info btn-sm text-white" title="View Product">
                        <i class="fa-regular fa-eye"></i>
                    </a>
                    <button class="btn btn-dark btn-sm toggle-status-btn" 
                        data-slug="' . $product->slug . '" data-status="' . $product->status . '" 
                        title="Change Status">
                        <i class="fa-solid fa-toggle-on"></i>
                    </button>
                    <button class="btn btn-danger btn-sm delete-btn" data-slug="' . $product->slug . '" title="delete product"><i class="fa-solid fa-trash"></i></button>
                ';
                })
                ->rawColumns(['track_qty','is_featured','status', 'action', 'feature_image'])
                ->make(true);
        }

        return view('backend.products.product.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $categories = ProductCategory::where('status', 'active')->orderBy('name', 'asc')->get();
            $sub_categories = ProductSubCategory::where('status', 'active')->orderBy('name', 'asc')->get();
            $brands = ProductBrand::where('status', 'active')->orderBy('name', 'asc')->get();
            $colors = ProductColor::where('status', 'active')->orderBy('name', 'asc')->get();
            $sizes = ProductSize::where('status', 'active')->orderBy('name', 'asc')->get();
            return view('backend.products.product.create', compact('categories', 'sub_categories', 'brands', 'colors','sizes'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        try {
            $this->productRepository->storeProduct($request);
            return redirect()->route('products.index')->with('success', 'Product added successfully!');
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
            $product = Product::where('slug', $slug)->first();
            
            if (!$product) {
                return back()->with('error', 'Product not found!');
            }
            return view('backend.products.product.show', compact('product'));
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
            $product = Product::where('slug', $slug)->first();
            
            if (!$product) {
                return back()->with('error', 'Product not found!');
            }
            $categories = ProductCategory::where('status', 'active')->orderBy('name', 'asc')->get();
            $sub_categories = ProductSubCategory::where('status', 'active')->orderBy('name', 'asc')->get();
            $brands = ProductBrand::where('status', 'active')->orderBy('name', 'asc')->get();
            $colors = ProductColor::where('status', 'active')->orderBy('name', 'asc')->get();
            $sizes = ProductSize::where('status', 'active')->orderBy('name', 'asc')->get();
            return view('backend.products.product.edit', compact('product','categories','sub_categories','brands','colors','sizes'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, $slug)
    {
        try {
            // Find the product by slug
            $product = Product::where('slug', $slug)->first();
            if (!$product) {
                return back()->with('error', 'Product not found!');
            }
            $this->productRepository->updateProduct($request, $product);
            return redirect()->route('products.index')->with('success', 'Product has been updated successfully!');
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
            $product = Product::where('slug', $slug)->first();
            if(!$product){
                return response()->json(['status' => 'error', 'message' => 'Product not found']);
            }
            $this->productRepository->destroyProduct($product);
            return response()->json(['status' => 'success', 'message' => 'Product deleted successfully']);
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
            $product = Product::where('slug', $slug)->firstOrFail();
            $product->status = $request->status;
            $product->save();

            return response()->json(['message' => 'Status updated successfully.']);
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

            // Define the storage directory and path
            $directory = public_path('products');
            $path = $directory . '/' . $fileName;

            // Create the directory if it doesn't exist
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true); // Create directory with permissions 0755
            }

            // Process and compress the image
            $img = Image::make($image)
                ->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio(); // Maintain aspect ratio
                    $constraint->upsize(); // Prevent upscaling
                })
                ->encode('webp', 80); // Convert to WebP format with 80% quality

            // Save the image in the 'products' directory
            $img->save($path);

            // Get the URL of the uploaded image
            $url = asset('products/' . $fileName);

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
            $filePath = public_path('products/' . basename($image));
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
