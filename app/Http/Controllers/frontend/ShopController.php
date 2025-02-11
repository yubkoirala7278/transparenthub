<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Models\Cart;
use App\Models\CustomerAddress;
use App\Models\DiscountCoupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\ShippingCharge;
use App\Models\UserCoupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

            return view('frontend.pages.shop', compact('categories', 'colors', 'initialProducts', 'brands'));
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
                    'noProducts' => true,
                    'hasMore'   => false,
                ]);
            }

            $html = view('frontend.pages.product-card', compact('products'))->render();

            return response()->json([
                'status'    => 'success',
                'html'      => $html,
                'noProducts' => false,
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
                    'noProducts' => true,
                ]);
            }

            $html = view('frontend.pages.product-card', compact('products'))->render();

            return response()->json([
                'status'    => 'success',
                'html'      => $html,
                'hasMore'   => $hasMore,
                'noProducts' => false,
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

    /**
     * add to  cart
     */
    public function addToCart(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
            'color'      => 'nullable|exists:product_colors,id',
            'size'      => 'nullable|exists:product_sizes,id'
        ]);

        // Ensure the user is authenticated
        $user = auth()->user();
        if (!$user) {
            return response()->json(['error' => 'Please login to add items to cart.'], 401);
        }

        // Check if a cart record already exists for the same product, color and size combination
        $cart = Cart::where('user_id', $user->id)
            ->where('product_id', $request->product_id)
            ->where(function ($query) use ($request) {
                if ($request->filled('color')) {
                    $query->where('color_id', $request->color);
                } else {
                    $query->whereNull('color_id');
                }
            })
            ->where(function ($query) use ($request) {
                if ($request->filled('size')) {
                    $query->where('size_id', $request->size);
                } else {
                    $query->whereNull('size_id');
                }
            })
            ->first();

        if ($cart) {
            // If the record exists, update the quantity
            $cart->cart_count += $request->quantity;
            $cart->save();
        } else {
            // Otherwise, create a new cart record including the selected color and selected size (if provided)
            $cart = Cart::create([
                'user_id'    => $user->id,
                'product_id' => $request->product_id,
                'cart_count' => $request->quantity,
                'color_id'   => $request->filled('color') ? $request->color : null,
                'size_id' => $request->filled('size') ? $request->size : null,
            ]);
        }

        // Calculate the updated cart count for the user
        $cartCount = Cart::where('user_id', $user->id)->sum('cart_count');

        // Return a JSON response with a success message and updated cart count
        return response()->json([
            'message'    => 'Item added to cart successfully!',
            'cart_count' => $cartCount,
        ]);
    }

    /**
     * Update the quantity of a cart item.
     * This method is used by the AJAX logic for the "+" and "–" buttons.
     */
    public function updateCart(Request $request)
    {
        // Validate request input
        $request->validate([
            'id'       => 'required|exists:carts,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Ensure the user is authenticated
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please log in to update your cart.'
            ], 401);
        }

        $user = Auth::user();
        $cartItem = Cart::where('id', $request->id)
            ->where('user_id', $user->id)
            ->first();

        if (!$cartItem) {
            return response()->json([
                'success' => false,
                'message' => 'Cart item not found.'
            ], 404);
        }

        $cartItem->cart_count = $request->quantity;
        $cartItem->save();

        // Recalculate the updated cart count for the authenticated user
        $cartCount = Cart::where('user_id', auth()->id())->sum('cart_count');
        $cartCountDisplay = ($cartCount >= 100) ? '100+' : $cartCount;

        return response()->json([
            'success' => true,
            'message' => 'Cart item updated successfully.',
            'cartCount' => $cartCountDisplay,
        ]);
    }
    /**
     * Remove an item from the cart.
     */
    public function removeFromCart(Request $request)
    {
        // Validate request input
        $request->validate([
            'id' => 'required|exists:carts,id',
        ]);

        // Ensure the user is authenticated
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please log in to remove items from your cart.'
            ], 401);
        }

        $user = Auth::user();
        $cartItem = Cart::where('id', $request->id)
            ->where('user_id', $user->id)
            ->first();

        if (!$cartItem) {
            return response()->json([
                'success' => false,
                'message' => 'Cart item not found.'
            ], 404);
        }

        $cartItem->delete();

        // Recalculate the updated cart count for the authenticated user
        $cartCount = Cart::where('user_id', auth()->id())->sum('cart_count');
        $cartCountDisplay = ($cartCount >= 100) ? '100+' : $cartCount;

        return response()->json([
            'success' => true,
            'message' => 'Cart item removed successfully.',
            'cartCount' => $cartCountDisplay,
        ]);
    }


    /**
     * view all the items in cart
     */
    public function viewCart()
    {
        // Ensure the user is logged in.
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('frontend.home')->with('error', 'Please login to view your cart.');
        }

        // Fetch the cart items for this user.
        $cartItems = Cart::with('product')->where('user_id', $user->id)->get();

        // Calculate the total cart count by summing up the 'cart_count' field of each item.
        $cartCount = $cartItems->sum('cart_count');

        // Return the cart view with cart items and total count.
        return view('frontend.pages.cart', compact('cartItems', 'cartCount'));
    }

    /**
     * checkout page
     */
    public function checkout()
    {
        try {
            if (!Auth::user()) {
                return back()->with('error', 'Please login to proceed checkout!!');
            }
            $cartsProducts = Cart::with('product')->latest()->where('user_id', Auth::user()->id)->get();
            $customerDetail = CustomerAddress::where('user_id', Auth::user()->id)->first();
            // $countries = Country::orderBy('name', 'asc')->get();
            // $countryName = CustomerAddress::where('user_id', Auth::user()->id)->value('country_name');
            // $shippingCharge = ShippingCharge::where('country_name', $countryName)->value('amount');
            // $couponId = UserCoupon::where('user_id', Auth::user()->id)->latest()->value('coupon_id');
            // $couponDiscount = DiscountCoupon::where('id', $couponId)->latest()->value('discount_amount');
            return view('frontend.pages.checkout', compact('cartsProducts','customerDetail'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * checkout product
     */
    public function checkoutProduct(CheckoutRequest $request)
    {
        try {
            // get payment method
            $paymentMethod = $request->input('payment_method');
            // save user addresses to database
            $user = Auth::user();
            $customerAddress = CustomerAddress::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'user_id' => $user->id,
                    'email' => $request->email,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'phone_number' => $request->phone_number,
                    'street_address' => $request->street_address,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zip' => $request->zip,
                ]
            );

            //  save order details to database
            if ($paymentMethod === 'cod') {
                // $countryName = CustomerAddress::where('user_id', Auth::user()->id)->value('country_name');
                // $shippingCharge = ShippingCharge::where('country_name', $countryName)->value('amount')??0;
                $shippingCharge = 100;
                // $couponId = UserCoupon::where('user_id', Auth::user()->id)->latest()->value('coupon_id');
                // $couponDiscount=DiscountCoupon::where('id',$couponId)->latest()->value('discount_amount')??0;
                $couponDiscount = 0;
                $subTotal = Cart::with('product')
                    ->where('user_id', $user->id)
                    ->get()
                    ->sum(function ($cartItem) {
                        return $cartItem->product->price * $cartItem->cart_count;
                    });
                $totalCharge = $shippingCharge + $subTotal - $couponDiscount;
                $order = Order::create([
                    'user_id' => $user->id,
                    'email' => $request->email,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'phone_number' => $request->phone_number,
                    'street_address' => $request->street_address,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zip' => $request->zip,
                    'sub_total' => $subTotal,
                    'shipping_charge' => $shippingCharge,
                    'total_charge' => $totalCharge,
                    'coupon_discount' => $couponDiscount,
                ]);

                // store order items in order items table
                $carts = Cart::with('product')->where('user_id', Auth::user()->id)->get();
                foreach ($carts as $key => $cart) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $cart->product_id,
                        'product_name' => $cart->product->name,
                        'qty' => $cart->cart_count,
                        'price' => $cart->product->price,
                        'total' => $cart->cart_count * $cart->product->price + $shippingCharge - $couponDiscount,
                    ]);
                    $product = Product::where('id', $cart->product_id)->first();
                    if ($product->track_qty == true) {
                        $product->update(
                            [
                                'qty' => $product->qty - $cart->cart_count
                            ]
                        );
                    }
                }
                // event(new OrderPlaced($customerAddress, $carts, $shippingCharge, $subTotal, $couponDiscount, $totalCharge));
                Cart::where('user_id', Auth::user()->id)->delete();
                return view('frontend.pages.order_success');
            } elseif ($paymentMethod === 'credit_card') {
                dd('pay with credit_card');
            }elseif ($paymentMethod === 'paypal') {
                dd('pay with paypal');
            }else{
                dd('invalid payment method');
            }
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
