<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use App\Models\ProductColor;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Fetch active categories that have at least one product
            $categories = ProductCategory::where('status', 'active')
                ->withCount('products')
                ->having('products_count', '>', 0)
                ->orderBy('name', 'asc')
                ->get();

                  // Fetch active brands that have at least one product
                  $brands = ProductBrand::where('status', 'active')
                  ->withCount('products')
                  ->having('products_count', '>', 0)
                  ->orderBy('name', 'asc')
                  ->get();

            // Fetch active colors (or all if you prefer)
            $colors = ProductColor::where('status', 'active')->get();

            // Get the first six active products
            $initialProducts = Product::where('status', 'active')
                ->latest()
                ->take(6)
                ->get();

            return view('frontend.pages.shop', compact('categories', 'colors', 'initialProducts','brands'));
        } catch (\Throwable $th) {
            return back()->with('error', 'Something went wrong while fetching data.');
        }
    }


    public function filterProducts(Request $request)
    {
        try {
            $validated = $request->validate([
                'minPrice'   => 'nullable|numeric|min:0',
                'maxPrice'   => 'nullable|numeric|min:0',
                'categories' => 'nullable|array',
                'brands' => 'nullable|array',
                'colors'     => 'nullable|array',
                'offset'     => 'nullable|integer|min:0',
                'search'     => 'nullable|string',
                'sort'       => 'nullable|in:low-high,high-low'
            ]);
    
            $minPrice   = $validated['minPrice'] ?? 0;
            $maxPrice   = $validated['maxPrice'] ?? Product::max('price');
            $categories = $validated['categories'] ?? [];
            $brands = $validated['brands'] ?? [];
            $colors     = $validated['colors'] ?? [];
            $offset     = $validated['offset'] ?? 0;
            $search     = $validated['search'] ?? '';
            $sort       = $validated['sort'] ?? null;
            $limit      = 6;
    
            // Build the base query
            $query = Product::where('status', 'active')
                ->whereBetween('price', [$minPrice, $maxPrice]);
    
            if (!empty($categories)) {
                $query->whereIn('category_id', $categories);
            }
            if (!empty($brands)) {
                $query->whereIn('brand_id', $brands);
            }
            if (!empty($colors)) {
                $query->whereHas('colors', function ($q) use ($colors) {
                    $q->whereIn('product_colors.id', $colors);
                });
            }
            if (!empty($search)) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            }
    
            // Apply sorting
            if ($sort === 'low-high') {
                $query->orderBy('price', 'asc');
            } elseif ($sort === 'high-low') {
                $query->orderBy('price', 'desc');
            } else {
                $query->latest();
            }
    
            // Fetch the current page of products
            $products = $query->skip($offset)->take($limit)->get();
    
            // Determine if more products exist by checking for at least one product at the next offset
            $hasMore = $query->skip($offset + $limit)->exists();
    
            if ($products->isEmpty()) {
                return response()->json([
                    'status'    => 'success',
                    'html'      => '',
                    'noProducts'=> true,
                    'hasMore'   => false,
                ]);
            }
    
            $html = view('frontend.pages.product-card', compact('products'))->render();
    
            return response()->json([
                'status'    => 'success',
                'html'      => $html,
                'noProducts'=> false,
                'hasMore'   => $hasMore,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Error filtering products. Please try again.'
            ], 500);
        }
    }
    

    public function loadMoreProducts(Request $request)
    {
        try {
            $validated = $request->validate([
                'offset'     => 'required|integer|min:0',
                'minPrice'   => 'nullable|numeric|min:0',
                'maxPrice'   => 'nullable|numeric|min:0',
                'categories' => 'nullable|array',
                'brands' => 'nullable|array',
                'colors'     => 'nullable|array',
                'search'     => 'nullable|string',
                'sort'       => 'nullable|in:low-high,high-low'
            ]);
    
            $limit      = 6;
            $offset     = $validated['offset'];
            $minPrice   = $validated['minPrice'] ?? 0;
            $maxPrice   = $validated['maxPrice'] ?? Product::max('price');
            $categories = $validated['categories'] ?? [];
            $brands = $validated['brands'] ?? [];
            $colors     = $validated['colors'] ?? [];
            $search     = $validated['search'] ?? '';
            $sort       = $validated['sort'] ?? null;
    
            $query = Product::where('status', 'active')
                ->whereBetween('price', [$minPrice, $maxPrice]);
    
            if (!empty($categories)) {
                $query->whereIn('category_id', $categories);
            }
            if (!empty($brands)) {
                $query->whereIn('brand_id', $brands);
            }
            if (!empty($colors)) {
                $query->whereHas('colors', function ($q) use ($colors) {
                    $q->whereIn('product_colors.id', $colors);
                });
            }
            if (!empty($search)) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            }
    
            if ($sort === 'low-high') {
                $query->orderBy('price', 'asc');
            } elseif ($sort === 'high-low') {
                $query->orderBy('price', 'desc');
            } else {
                $query->latest();
            }
    
            $products = $query->skip($offset)->take($limit)->get();
    
            // Check if additional products exist
            $hasMore = $query->skip($offset + $limit)->exists();
    
            if ($products->isEmpty()) {
                return response()->json([
                    'status'    => 'success',
                    'html'      => '',
                    'hasMore'   => false,
                    'noProducts'=> true,
                ]);
            }
    
            $html = view('frontend.pages.product-card', compact('products'))->render();
    
            return response()->json([
                'status'    => 'success',
                'html'      => $html,
                'hasMore'   => $hasMore,
                'noProducts'=> false,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Error loading products. Please try again.'
            ], 500);
        }
    }
    

    /**
     * product details
     */
    public function productDetail($slug)
    {
        try {
            $product = Product::with('images')->where('status', 'active')->where('slug', $slug)->first();
            return view('frontend.pages.product-detail', compact('product'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
