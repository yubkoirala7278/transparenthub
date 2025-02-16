<?php

namespace App\Http\Controllers\admin\products;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $orders = Order::query(); // Default ordering

            return DataTables::of($orders)
                ->addIndexColumn()
                ->editColumn('status', function ($order) {
                    if ($order->status == 'pending') {
                        return '<span class="badge badge-info">Pending</span>';
                    } else if ($order->status == 'shipped') {
                        return '<span class="badge badge-warning">Shipped</span>';
                    } else if ($order->status == 'delivered') {
                        return '<span class="badge badge-success">Delivered</span>';
                    } else if ($order->status == 'cancelled') {
                        return '<span class="badge badge-danger">Cancelled</span>';
                    }
                })
                ->addColumn('action', function ($order) {
                    return '
                        <a href="' . route('admin.orders.view', $order->slug) . '" 
                        class="btn btn-info btn-sm text-white" title="View Order">
                        <i class="fa-regular fa-eye"></i>
                    </a>
                    ';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('backend.products.orders.index');
    }

    public function view($slug)
    {
        try {
            $order = Order::with('order_items')->where('slug', $slug)->first();
            return view('backend.products.orders.show', compact('order'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function updateStatus(Request $request, $slug)
    {
        $this->validate($request, [
            'shipped_date' => 'required_if:status,delivered',
            'status' => 'required'
        ]);
        try {
            Order::where('slug', $slug)->update([
                'status' => $request->status,
                'shipped_date' => $request->shipped_date && $request->status == 'delivered' ? $request->shipped_date : null
            ]);
            return back()->with('success', 'Status updated successfully!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
