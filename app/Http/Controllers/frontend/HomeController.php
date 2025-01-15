<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function index(){
        try{
            return view('frontend.pages.index');
        }catch(\Throwable $th){
            return back()->with('error',$th->getMessage());
        }
    }
}
