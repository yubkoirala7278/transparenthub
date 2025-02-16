<?php

namespace App\Http\Controllers\admin\palika;

use App\Http\Controllers\Controller;
use App\Http\Requests\DistrictRequest;
use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $districts = District::latest()->get();

            return DataTables::of($districts)
                ->addIndexColumn()
                ->editColumn('status', function ($district) {
                    return $district->status === 'active'
                        ? '<span class="badge badge-success">Active</span>'
                        : '<span class="badge badge-danger">Inactive</span>';
                })
                ->addColumn('province', function ($district) {
                    return $district->province->name; // Display province name
                })
                ->addColumn('action', function ($district) {
                    return '
                        <a href="' . route('district.edit', $district->slug) . '" 
                            class="btn btn-warning btn-sm text-white" title="Edit">
                            <i class="fa-solid fa-pencil"></i>
                        </a>
                        <button class="btn btn-dark btn-sm toggle-status-btn" 
                            data-slug="' . $district->slug . '" data-status="' . $district->status . '" 
                            title="Change Status">
                            <i class="fa-solid fa-toggle-on"></i>
                        </button>
                         <button class="btn btn-danger btn-sm delete-btn" data-slug="' . $district->slug . '" title="delete sub district"><i class="fa-solid fa-trash"></i></button>
                    ';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('backend.palika.district.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $provinces = Province::where('status', 'active')->orderBy('name', 'asc')->get();
            return view('backend.palika.district.create',compact('provinces'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DistrictRequest $request)
    {
        try {
            // Create the district record
            District::create([
                'name' => $request['name'],
                'status' => $request['status'],
                'province_id' => $request['province_id']
            ]);
            return redirect()->route('district.index')->with('success', 'District has been created successfully!');
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
            $district = District::where('slug', $slug)->first();
            if (!$district) {
                return back()->with('error', 'District not found!');
            }
            $provinces = Province::where('status', 'active')->orderBy('name', 'asc')->get();
            return view('backend.palika.district.edit', compact('district','provinces'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DistrictRequest $request, $slug)
    {
        try {
            $district = District::where('slug', $slug)->first();
            if (!$district) {
                return back()->with('error', 'District not found!');
            }

            // Update the district record
            $district->update([
                'name' => $request['name'],
                'status' => $request['status'],
            ]);
            return redirect()->route('district.index')->with('success', 'District has been updated successfully!');
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
            $district = District::where('slug', $slug)->first();

            if (!$district) {
                return response()->json(['status' => 'error', 'message' => 'District not found']);
            }

            // Check if district has related municipality
            if ($district->palikas()->exists()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Cannot delete district. It has associated municipality.'
                ]);
            }

            $district->delete();

            return response()->json(['status' => 'success', 'message' => 'District deleted successfully']);
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
            $district = District::where('slug', $slug)->firstOrFail();
            $district->status = $request->status;
            $district->save();

            return response()->json(['message' => 'Status updated successfully.']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}
