<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        try {
            if (!Auth::user()) {
                return redirect()->route('frontend.home')->with('error', 'Please login to access this page!');
            }
            $orders = Order::where('user_id', Auth::user()->id)->latest()->paginate(10);
            return view('frontend.pages.my-order', compact('orders'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function orderDetails($slug)
    {
        try {
            if (!Auth::user()) {
                return redirect()->route('frontend.home')->with('error', 'Please login to access this page!');
            }
            $order = Order::with('order_items')->where('user_id', Auth::user()->id)->where('slug', $slug)->first();
            return view('frontend.pages.my-order-details', compact('order'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    public function cancelOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'cancelled']);

        return redirect()->back()->with('success', 'Order has been cancelled successfully.');
    }
}
