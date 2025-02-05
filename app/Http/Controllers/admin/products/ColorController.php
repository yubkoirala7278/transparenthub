<?php

namespace App\Http\Controllers\admin\products;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductColorRequest;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $colors = ProductColor::query()->get();

            return DataTables::of($colors)
                ->addIndexColumn()
                ->editColumn('status', function ($color) {
                    return $color->status === 'active'
                        ? '<span class="badge badge-success">Active</span>'
                        : '<span class="badge badge-danger">Inactive</span>';
                })
                ->addColumn('action', function ($color) {
                    return '
                        <a href="' . route('color.edit', $color->slug) . '" 
                            class="btn btn-warning btn-sm text-white" title="Edit">
                            <i class="fa-solid fa-pencil"></i>
                        </a>
                        <button class="btn btn-dark btn-sm toggle-status-btn" 
                            data-slug="' . $color->slug . '" data-status="' . $color->status . '" 
                            title="Change Status">
                            <i class="fa-solid fa-toggle-on"></i>
                        </button>
                         <button class="btn btn-danger btn-sm delete-btn" data-slug="' . $color->slug . '" title="delete product color"><i class="fa-solid fa-trash"></i></button>
                    ';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('backend.products.color.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('backend.products.color.create');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductColorRequest $request)
    {
        try {
            // Create the color record
            ProductColor::create([
                'name' => $request['name'],
                'status' => $request['status'],
            ]);
            return redirect()->route('color.index')->with('success', 'Product color has been created successfully!');
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
            $color = ProductColor::where('slug', $slug)->first();
            if (!$color) {
                return back()->with('error', 'Color not found!');
            }
            return view('backend.products.color.edit', compact('color'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductColorRequest $request, $slug)
    {
        try {
            $color = ProductColor::where('slug', $slug)->first();
            if (!$color) {
                return back()->with('error', 'Product color not found!');
            }

            // Update the color record
            $color->update([
                'name' => $request['name'],
                'status' => $request['status'],
            ]);
            return redirect()->route('color.index')->with('success', 'Product color has been updated successfully!');
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
            $color = ProductColor::where('slug', $slug)->first();

            if (!$color) {
                return response()->json(['status' => 'error', 'message' => 'Product color not found']);
            }

            // Check if color is associated with any products
            if ($color->products()->exists()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Cannot delete color. It is associated with products.'
                ]);
            }

            $color->delete();

            return response()->json(['status' => 'success', 'message' => 'Product color deleted successfully']);
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
            $color = ProductColor::where('slug', $slug)->firstOrFail();
            $color->status = $request->status;
            $color->save();

            return response()->json(['message' => 'Status updated successfully.']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}
