<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Palika;
use App\Models\PalikaQnA;
use App\Models\Province;
use Illuminate\Http\Request;

class PalikaController extends Controller
{
    public function index()
    {
        try {
            $provinces = Province::with([
                'districts' => function ($query) {
                    $query->where('status', 'active')
                        ->orderBy('name', 'asc')
                        ->with([
                            'palikas' => function ($query) {
                                $query->where('status', 'active')
                                    ->orderBy('name', 'asc');
                            }
                        ]);
                }
            ])
                ->where('status', 'active')
                ->orderBy('name', 'asc')
                ->get();

            return view('frontend.pages.palika', compact('provinces'));
        } catch (\Throwable $th) {
            return redirect()->route('frontend.home')->with('error', $th->getMessage());
        }
    }


    public function palikaDetail($slug)
    {
        try {
            // Fetch the palika and its related questions and answers in a single query using eager loading
            $palika = Palika::where('slug', $slug)->with('palikaQnAs')->first();
    
            // Extract questions from the related palikaQnAs using the loaded data
            $questions = $palika->palikaQnAs->pluck('question')->toArray();
            
            // Return the view with the palika and its questions/answers
            return view('frontend.pages.palika-detail', compact('palika', 'questions'));
        } catch (\Throwable $th) {
            return redirect()->route('frontend.home')->with('error', $th->getMessage());
        }
    }
    
}
