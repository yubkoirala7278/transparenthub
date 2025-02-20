<?php

namespace App\Http\Controllers\admin\professional;

use App\Http\Controllers\Controller;
use App\Models\Appoinment;
use Illuminate\Http\Request;

class AppoinmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        try{
            $appoinments=Appoinment::where('professional_id',auth()->id())->latest()->paginate(10);
            return view('backend.professional.appoinment.index',compact('appoinments'));
        }catch(\Throwable $th){
            return back()->with('error',$th->getMessage());
        }
    }
}
