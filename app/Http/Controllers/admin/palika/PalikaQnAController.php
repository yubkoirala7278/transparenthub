<?php

namespace App\Http\Controllers\admin\palika;

use App\Http\Controllers\Controller;
use App\Http\Requests\PalikaQnARequest;
use App\Models\Palika;
use App\Models\PalikaQnA;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class PalikaQnAController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $palika_qna = PalikaQnA::latest()->get();

            return DataTables::of($palika_qna)
                ->addIndexColumn()
                ->editColumn('status', function ($qna) {
                    return $qna->status === 'active'
                        ? '<span class="badge badge-success">Active</span>'
                        : '<span class="badge badge-danger">Inactive</span>';
                })
                ->editColumn('question', function ($qna) {
                    return Str::limit(strip_tags($qna->question), 30, '...');
                })
                ->editColumn('answer', function ($qna) {
                    return Str::limit(strip_tags($qna->answer), 30, '...');
                })
                ->addColumn('palika', function ($qna) {
                    return $qna->palika->name; // Display palika name
                })
                ->addColumn('action', function ($qna) {
                    return '
                        <a href="' . route('palika_qna.edit', $qna->slug) . '" 
                            class="btn btn-warning btn-sm text-white" title="Edit">
                            <i class="fa-solid fa-pencil"></i>
                        </a>
                         <a href="' . route('palika_qna.show', $qna->slug) . '" 
                            class="btn btn-info btn-sm text-white" title="Show">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <button class="btn btn-dark btn-sm toggle-status-btn" 
                            data-slug="' . $qna->slug . '" data-status="' . $qna->status . '" 
                            title="Change Status">
                            <i class="fa-solid fa-toggle-on"></i>
                        </button>
                         <button class="btn btn-danger btn-sm delete-btn" data-slug="' . $qna->slug . '" title="delete answer"><i class="fa-solid fa-trash"></i></button>
                    ';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('backend.palika.question_answer.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $palikas = Palika::where('status', 'active')->orderBy('name', 'asc')->get();
            return view('backend.palika.question_answer.create', compact('palikas'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PalikaQnARequest $request)
    {
        try {
            $palika_id = $request->input('palika_id');
            $questions = $request->input('questions');
            $answers   = $request->input('answers');
            $status    = $request->input('status');

            // Loop through each Q&A pair and create a record
            foreach ($questions as $index => $question) {
                // Optionally skip completely empty pairs
                if (trim($question) === '' && trim($answers[$index]) === '') {
                    continue;
                }
                PalikaQnA::create([
                    'palika_id' => $palika_id,
                    'question'  => $question,
                    'answer'    => $answers[$index],
                    'status'    => $status,
                ]);
            }

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'QNA has been created successfully!',
                    'redirect_url' => route('palika_qna.index')
                ]);
            }

            return redirect()->route('palika_qna.index')
                ->with('success', 'QNA has been created successfully!');
        } catch (\Throwable $th) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $th->getMessage()
                ], 500);
            }
            return back()->with('error', $th->getMessage());
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        try {
            $palika_qna = PalikaQnA::where('slug', $slug)->first();
            if (!$palika_qna) {
                return back()->with('error', 'Palika QnA not found!');
            }
            return view('backend.palika.question_answer.show', compact('palika_qna'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        try {
            $palika_qna = PalikaQnA::where('slug', $slug)->first();
            if (!$palika_qna) {
                return back()->with('error', 'Palika QnA not found!');
            }
            $palikas = Palika::where('status', 'active')->orderBy('name', 'asc')->get();
            return view('backend.palika.question_answer.edit', compact('palika_qna', 'palikas'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $request->validate([
            'palika_id'      => 'required|exists:palikas,id',
            'question'      => 'required',
            'answer'        => 'required',
            'status'         => 'required|in:active,inactive',
        ]);
        try {
            $palika_qna = PalikaQnA::where('slug', $slug)->first();
            if (!$palika_qna) {
                return back()->with('error', 'Palika QnA not found!');
            }

            // Update the palika qna record
            $palika_qna->update([
                'question' => $request['question'],
                'answer' => $request['answer'],
                'status' => $request['status'],
                'palika_id' => $request['palika_id']
            ]);
            return redirect()->route('palika_qna.index')->with('success', 'Palika QnA has been updated successfully!');
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
            $palika_qna = PalikaQnA::where('slug', $slug)->first();

            if (!$palika_qna) {
                return response()->json(['status' => 'error', 'message' => 'Palika QnA not found']);
            }

            // Check if province has related products
            // if ($province->products()->exists()) {
            //     return response()->json([
            //         'status' => 'error',
            //         'message' => 'Cannot delete province. It has associated products.'
            //     ]);
            // }

            $palika_qna->delete();

            return response()->json(['status' => 'success', 'message' => 'Palika QnA deleted successfully']);
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
            $palika_qna = PalikaQnA::where('slug', $slug)->firstOrFail();
            $palika_qna->status = $request->status;
            $palika_qna->save();

            return response()->json(['message' => 'Status updated successfully.']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}
