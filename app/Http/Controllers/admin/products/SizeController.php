<?php

namespace App\Http\Controllers\admin\products;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductSizeRequest;
use App\Models\ProductSize;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $sizes = ProductSize::query()->get();

            return DataTables::of($sizes)
                ->addIndexColumn()
                ->editColumn('status', function ($size) {
                    return $size->status === 'active'
                        ? '<span class="badge badge-success">Active</span>'
                        : '<span class="badge badge-danger">Inactive</span>';
                })
                ->addColumn('action', function ($size) {
                    return '
                        <a href="' . route('size.edit', $size->slug) . '" 
                            class="btn btn-warning btn-sm text-white" title="Edit">
                            <i class="fa-solid fa-pencil"></i>
                        </a>
                        <button class="btn btn-dark btn-sm toggle-status-btn" 
                            data-slug="' . $size->slug . '" data-status="' . $size->status . '" 
                            title="Change Status">
                            <i class="fa-solid fa-toggle-on"></i>
                        </button>
                         <button class="btn btn-danger btn-sm delete-btn" data-slug="' . $size->slug . '" title="delete product size"><i class="fa-solid fa-trash"></i></button>
                    ';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('backend.products.size.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('backend.products.size.create');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductSizeRequest $request)
    {
        try {
            // Create the size record
            ProductSize::create([
                'name' => $request['name'],
                'status' => $request['status'],
            ]);
            return redirect()->route('size.index')->with('success', 'Product size has been created successfully!');
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
            $size = ProductSize::where('slug', $slug)->first();
            if (!$size) {
                return back()->with('error', 'Product size not found!');
            }
            return view('backend.products.size.edit', compact('size'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductSizeRequest $request, $slug)
    {
        try {
            $size = ProductSize::where('slug', $slug)->first();
            if (!$size) {
                return back()->with('error', 'Product size not found!');
            }

            // Update the size record
            $size->update([
                'name' => $request['name'],
                'status' => $request['status'],
            ]);
            return redirect()->route('size.index')->with('success', 'Product size has been updated successfully!');
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
            $size = ProductSize::where('slug', $slug)->first();

            if (!$size) {
                return response()->json(['status' => 'error', 'message' => 'Product size not found']);
            }

            // Check if size is associated with any products
            if ($size->products()->exists()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Cannot delete size. It is associated with products.'
                ]);
            }

            $size->delete();

            return response()->json(['status' => 'success', 'message' => 'Product size deleted successfully']);
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
            $size = ProductSize::where('slug', $slug)->firstOrFail();
            $size->status = $request->status;
            $size->save();

            return response()->json(['message' => 'Status updated successfully.']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}
