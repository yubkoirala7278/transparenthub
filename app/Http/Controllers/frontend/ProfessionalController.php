<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfessionalController extends Controller
{
    public function index(){
        return view('frontend.pages.professional');
    }

    public function professionalDetail(){
        return view('frontend.pages.professional-detail');
    }
}
