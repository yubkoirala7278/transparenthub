<?php

namespace App\Http\Controllers\admin\professional;

use App\Http\Controllers\Controller;
use App\Models\Appoinment;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use Yajra\DataTables\Facades\DataTables;

class AppoinmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $appoinments = Appoinment::where('professional_id', auth()->id());

            return DataTables::of($appoinments)
                ->addIndexColumn()
                ->addColumn('date', function ($appoinment) {
                    return \Carbon\Carbon::parse($appoinment->schedule->date)->format('F j, Y');
                })
                ->addColumn('time', function ($appoinment) {
                    return \Carbon\Carbon::parse($appoinment->schedule->start_time)->format('h:i A') . '-' . \Carbon\Carbon::parse($appoinment->schedule->end_time)->format('h:i A');
                })
                ->addColumn('action', function ($appoinment) {
                    return '
                        <a href="' . route('appoinment.show', $appoinment->slug) . '" 
                            class="btn btn-info btn-sm text-white" title="Show">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    ';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('backend.professional.appoinment.index');
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function show($slug)
    {
        try {
            $appoinment = Appoinment::where('professional_id', auth()->id())->where('slug', $slug)->first();
            if (!$appoinment) {
                return back()->with('error', 'Appoinment not found!');
            }
            return view('backend.professional.appoinment.show', compact('appoinment'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
