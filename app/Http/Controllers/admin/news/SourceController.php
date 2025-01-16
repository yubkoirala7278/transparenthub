<?php

namespace App\Http\Controllers\admin\news;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsSourceRequest;
use App\Models\NewsSource;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $sources = NewsSource::query(); // Default ordering

            return DataTables::of($sources)
                ->addIndexColumn()
                ->editColumn('status', function ($source) {
                    return $source->status === 'active'
                        ? '<span class="badge badge-success">Active</span>'
                        : '<span class="badge badge-danger">Inactive</span>';
                })
                ->addColumn('action', function ($source) {
                    return '
                        <a href="' . route('news_source.edit', $source->slug) . '" 
                            class="btn btn-warning btn-sm text-white" title="Edit">
                            <i class="fa-solid fa-pencil"></i>
                        </a>
                        <button class="btn btn-dark btn-sm toggle-status-btn" 
                            data-slug="' . $source->slug . '" data-status="' . $source->status . '" 
                            title="Change Status">
                            <i class="fa-solid fa-toggle-on"></i>
                        </button>
                    ';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('backend.news.source.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('backend.news.source.create');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewsSourceRequest $request)
    {
        try {
            // Create the source record
            NewsSource::create([
                'name' => $request['name'],
                'status' => $request['status']
            ]);
            return redirect()->route('news_source.index')->with('success', 'Source has been created successfully!');
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
            $source = NewsSource::where('slug', $slug)->first();
            if (!$source) {
                return back()->with('error', 'Source not found!');
            }
            return view('backend.news.source.edit', compact('source'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NewsSourceRequest $request, $slug)
    {
        try {
            $source = NewsSource::where('slug', $slug)->first();
            if (!$source) {
                return back()->with('error', 'Source not found!');
            }

            // Update the source record
            $source->update([
                'name' => $request['name'],
                'status' => $request['status']
            ]);
            return redirect()->route('news_source.index')->with('success', 'Source has been updated successfully!');
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
            $source = NewsSource::where('slug', $slug)->first();
            if ($source) {
                $source->delete();
                return response()->json(['status' => 'success', 'message' => 'Source deleted successfully']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Source not found']);
            }
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
            $source = NewsSource::where('slug', $slug)->firstOrFail();
            $source->status = $request->status;
            $source->save();

            return response()->json(['message' => 'Status updated successfully.']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}
