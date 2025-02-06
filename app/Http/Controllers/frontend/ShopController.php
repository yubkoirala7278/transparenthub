<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('frontend.pages.shop');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    /**
     * load more products 
     */
    public function loadMoreProducts(Request $request)
    {
        try {
            $limit = 5;
            $offset = $request->offset ?? 0;

            $products = Product::where('status', 'active')
                ->latest()
                ->skip($offset)
                ->take($limit)
                ->get();

            $html = view('frontend.pages.product-card', compact('products'))->render();

            return response()->json([
                'status' => 'success',
                'html' => $html,
                'hasMore' => $products->count() == $limit,
            ]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()], 500);
        }
    }

    /**
     * product details
     */
    public function productDetail($slug)
    {
        try{
            $product=Product::with('images')->where('status','active')->where('slug',$slug)->first();
            return view('frontend.pages.product-detail',compact('product'));
        }catch(\Throwable $th){
            return back()->with('error',$th->getMessage());
        }
    }
}
