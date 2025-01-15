<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $blogs = Blog::where('status','active')->latest()->paginate(10);
    
            if ($request->ajax()) {
                $view = view('frontend.pages.blog-list', compact('blogs'))->render();
                $pagination = $blogs->links('pagination::custom-pagination')->render();
                return response()->json([
                    'blogs' => $view,
                    'pagination' => $pagination
                ]);
            }
    
            return view('frontend.pages.blog', compact('blogs'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    

    /**
     * Blog Details
     */
    public function blogDetail($slug){
        try{
            $blog=Blog::where('slug',$slug)->where('status','active')->first();
            if(!$blog){
                return back()->with('error','Blog not found!');
            }
            $recentBlogs = Blog::where('status','active')->latest()->take(3)->get();
            return view('frontend.pages.blog-detail',compact('blog','recentBlogs'));
        }catch(\Throwable $th){
            return back()->with('error',$th->getMessage());
        }
        
    }
}
