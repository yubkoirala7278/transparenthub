<?php

namespace App\Http\Controllers\admin\palika;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProvinceRequest;
use App\Models\Province;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $provinces = Province::latest()->get();

            return DataTables::of($provinces)
                ->addIndexColumn()
                ->editColumn('status', function ($province) {
                    return $province->status === 'active'
                        ? '<span class="badge badge-success">Active</span>'
                        : '<span class="badge badge-danger">Inactive</span>';
                })
                ->addColumn('action', function ($province) {
                    return '
                        <a href="' . route('province.edit', $province->slug) . '" 
                            class="btn btn-warning btn-sm text-white" title="Edit">
                            <i class="fa-solid fa-pencil"></i>
                        </a>
                        <button class="btn btn-dark btn-sm toggle-status-btn" 
                            data-slug="' . $province->slug . '" data-status="' . $province->status . '" 
                            title="Change Status">
                            <i class="fa-solid fa-toggle-on"></i>
                        </button>
                         <button class="btn btn-danger btn-sm delete-btn" data-slug="' . $province->slug . '" title="delete sub province"><i class="fa-solid fa-trash"></i></button>
                    ';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('backend.palika.province.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('backend.palika.province.create');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProvinceRequest $request)
    {
        try {
            // Create the province record
            Province::create([
                'name' => $request['name'],
                'status' => $request['status'],
            ]);
            return redirect()->route('province.index')->with('success', 'Province has been created successfully!');
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
            $province = Province::where('slug', $slug)->first();
            if (!$province) {
                return back()->with('error', 'Province not found!');
            }
            return view('backend.palika.province.edit', compact('province'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProvinceRequest $request, $slug)
    {
        try {
            $province = Province::where('slug', $slug)->first();
            if (!$province) {
                return back()->with('error', 'Province not found!');
            }

            // Update the province record
            $province->update([
                'name' => $request['name'],
                'status' => $request['status'],
            ]);
            return redirect()->route('province.index')->with('success', 'Province has been updated successfully!');
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
            $province = Province::where('slug', $slug)->first();

            if (!$province) {
                return response()->json(['status' => 'error', 'message' => 'Province not found']);
            }

            // Check if province has related district
            if ($province->districts()->exists()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Cannot delete province. It has associated district.'
                ]);
            }

            $province->delete();

            return response()->json(['status' => 'success', 'message' => 'Province deleted successfully']);
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
            $province = Province::where('slug', $slug)->firstOrFail();
            $province->status = $request->status;
            $province->save();

            return response()->json(['message' => 'Status updated successfully.']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}
