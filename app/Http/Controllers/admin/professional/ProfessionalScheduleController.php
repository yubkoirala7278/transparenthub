<?php

namespace App\Http\Controllers\admin\professional;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfessionalScheduleRequest;
use App\Models\ProfessionalSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ProfessionalScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $schedules = ProfessionalSchedule::where('user_id',Auth::user()->id)->get();

            return DataTables::of($schedules)
                ->addIndexColumn()
                ->editColumn('date', function ($schedule) {
                    return \Carbon\Carbon::parse($schedule->date)->format('M d, Y'); // Formats to "Jan 10, 2025"
                })
                ->editColumn('start_time', function ($schedule) {
                    return date('h:i A', strtotime($schedule->start_time)); // Converts to 12-hour format with AM/PM
                })
                ->editColumn('end_time', function ($schedule) {
                    return date('h:i A', strtotime($schedule->end_time)); // Converts to 12-hour format with AM/PM
                })
                ->editColumn('status', function ($schedule) {
                    return $schedule->status === 'available'
                        ? '<span class="badge badge-success">Available</span>'
                        : '<span class="badge badge-danger">Booked</span>';
                })
                ->addColumn('action', function ($schedule) {
                    return '
                        <a href="' . route('professional_schedule.edit', $schedule->slug) . '" 
                            class="btn btn-warning btn-sm text-white" title="Edit">
                            <i class="fa-solid fa-pencil"></i>
                        </a>
                        <button class="btn btn-dark btn-sm toggle-status-btn" 
                            data-slug="' . $schedule->slug . '" data-status="' . $schedule->status . '" 
                            title="Change Status">
                            <i class="fa-solid fa-toggle-on"></i>
                        </button>
                         <button class="btn btn-danger btn-sm delete-btn" data-slug="' . $schedule->slug . '" title="delete schedule"><i class="fa-solid fa-trash"></i></button>
                    ';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('backend.professional.schedule.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try{
            return view('backend.professional.schedule.create');
        }catch(\Throwable $th){
            return back()->with('error',$th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProfessionalScheduleRequest $request)
    {
       try{
            ProfessionalSchedule::create([
                'date'=>$request['date'],
                'start_time'=>$request['start_time'],
                'end_time'=>$request['end_time'],
                'status'=>$request['status'],
                'user_id'=>Auth::user()->id
            ]);
            return redirect()->route('professional_schedule.index')->with('success','Schedule has been added successfully!');
       }catch(\Throwable $th){
        return back()->with('error',$th->getMessage());
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
            $schedule = ProfessionalSchedule::where('slug', $slug)->first();
            if (!$schedule) {
                return back()->with('error', 'Schedule not found!');
            }
            return view('backend.professional.schedule.edit', compact('schedule'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfessionalScheduleRequest $request, $slug)
    {
        try {
            $schedule = ProfessionalSchedule::where('slug', $slug)->first();
            if (!$schedule) {
                return back()->with('error', 'Schedule not found!');
            }

            // Update the schedule record
            $schedule->update([
                'date'=>$request['date'],
                'start_time'=>$request['start_time'],
                'end_time'=>$request['end_time'],
                'status'=>$request['status'],
            ]);
            return redirect()->route('professional_schedule.index')->with('success', 'Schedule has been updated successfully!');
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
            $schedule = ProfessionalSchedule::where('slug', $slug)->first();

            if (!$schedule) {
                return response()->json(['status' => 'error', 'message' => 'Schedule not found']);
            }

            $schedule->delete();

            return response()->json(['status' => 'success', 'message' => 'Schedule deleted successfully']);
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
            $schedule = ProfessionalSchedule::where('slug', $slug)->firstOrFail();
            $schedule->status = $request->status;
            $schedule->save();

            return response()->json(['message' => 'Status updated successfully.']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}
