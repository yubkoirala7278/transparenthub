<?php

namespace App\Http\Controllers\admin\palika;

use App\Http\Controllers\Controller;
use App\Http\Requests\PalikaRequest;
use App\Models\District;
use App\Models\Palika;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PalikaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $palikas = Palika::latest()->get();

            return DataTables::of($palikas)
                ->addIndexColumn()
                ->editColumn('status', function ($palika) {
                    return $palika->status === 'active'
                        ? '<span class="badge badge-success">Active</span>'
                        : '<span class="badge badge-danger">Inactive</span>';
                })
                ->addColumn('district', function ($palika) {
                    return $palika->district->name; // Display district name
                })
                ->addColumn('province', function ($palika) {
                    return $palika->district->province->name; // Display province name
                })
                ->addColumn('action', function ($palika) {
                    return '
                        <a href="' . route('palika.edit', $palika->slug) . '" 
                            class="btn btn-warning btn-sm text-white" title="Edit">
                            <i class="fa-solid fa-pencil"></i>
                        </a>
                        <button class="btn btn-dark btn-sm toggle-status-btn" 
                            data-slug="' . $palika->slug . '" data-status="' . $palika->status . '" 
                            title="Change Status">
                            <i class="fa-solid fa-toggle-on"></i>
                        </button>
                         <button class="btn btn-danger btn-sm delete-btn" data-slug="' . $palika->slug . '" title="delete sub palika"><i class="fa-solid fa-trash"></i></button>
                    ';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('backend.palika.palika.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $districts = District::where('status', 'active')->orderBy('name', 'asc')->get();
            return view('backend.palika.palika.create', compact('districts'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PalikaRequest $request)
    {
        try {
            // Create the palika record
            Palika::create([
                'name' => $request['name'],
                'status' => $request['status'],
                'population' => $request['population'],
                'total_area' => $request['total_area'],
                'district_id' => $request['district_id']
            ]);
            return redirect()->route('palika.index')->with('success', 'Palika has been created successfully!');
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
            $palika = Palika::where('slug', $slug)->first();
            if (!$palika) {
                return back()->with('error', 'Palika not found!');
            }
            $districts = District::where('status', 'active')->orderBy('name', 'asc')->get();
            return view('backend.palika.palika.edit', compact('palika', 'districts'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PalikaRequest $request, $slug)
    {
        try {
            $palika = Palika::where('slug', $slug)->first();
            if (!$palika) {
                return back()->with('error', 'Palika not found!');
            }

            // Update the palika record
            $palika->update([
                'name' => $request['name'],
                'status' => $request['status'],
                'total_area' => $request['total_area'],
                'district_id' => $request['district_id']
            ]);
            return redirect()->route('palika.index')->with('success', 'Palika has been updated successfully!');
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
            $palika = Palika::where('slug', $slug)->first();

            if (!$palika) {
                return response()->json(['status' => 'error', 'message' => 'Palika not found']);
            }

            // Check if palika has related products
            // if ($palika->products()->exists()) {
            //     return response()->json([
            //         'status' => 'error',
            //         'message' => 'Cannot delete palika. It has associated products.'
            //     ]);
            // }

            $palika->delete();

            return response()->json(['status' => 'success', 'message' => 'Palika deleted successfully']);
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
            $palika = Palika::where('slug', $slug)->firstOrFail();
            $palika->status = $request->status;
            $palika->save();

            return response()->json(['message' => 'Status updated successfully.']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}
