<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PalikaController extends Controller
{
    public function index(){
        return view('frontend.pages.palika');
    }

    public function palikaDetail(){
        return view('frontend.pages.palika-detail');
    }
}
