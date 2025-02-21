<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsSource;
use App\Models\ProductCategory;
use App\Models\User;

class HomeController extends Controller
{

    public function index()
    {
        try {
            $bulletin_news = News::where('status', 'active')
                ->whereNull('news_sources_id')
                ->latest()
                ->take(10)
                ->get();
            $lokPriyaNews = News::where('status', 'active')
                ->where('updated_at', '>=', now()->subDays(2)) // Only include news from the past 2 days
                ->orderBy('views', 'desc') // Sort by the highest number of views
                ->limit(5) // Limit to the top 10
                ->select('slug', 'title', 'created_at') // Select only the slug and title columns
                ->get();
                
            $trendingNews = News::where('status', 'active')
                ->where('trending_news', true)
                ->orderBy('updated_at', 'desc') // Correctly order by the updated_at column
                ->limit(10) // Limit the results to 10 records
                ->select('slug', 'title') // Select only the required columns
                ->get();
               

            $news_sources = NewsSource::whereHas('news', function ($query) {
                $query->where('status', 'active'); // Optional: Filter active news only
            })->where('status', 'active')->orderBy('name', 'asc')->get();

            $sahitya_blog_news = News::where('status', 'active')
                ->whereHas('news_categories', function ($query) {
                    $query->where('name', 'साहित्य - ब्लग');
                })
                ->limit(3)
                ->latest()
                ->get();

            $product_categories = ProductCategory::where('status', 'active')->orderBy('name', 'asc')->get();

            $professionals = User::role('professional')->where('status', 'active')->latest()->get();
            return view('frontend.pages.index', compact('bulletin_news', 'lokPriyaNews', 'news_sources', 'trendingNews', 'sahitya_blog_news', 'product_categories', 'professionals'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
