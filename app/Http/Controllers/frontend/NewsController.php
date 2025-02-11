<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    // =======news details==========
    public function news(Request $request, $slug = null)
    {
        try {
            $keyword = $request->get('keyword'); // Get keyword from query params

            // Handle slug
            if ($slug) {
                $news = News::where('slug', $slug)->where('status', 'active')->first();
            } else if ($keyword) {
                $news = News::where('status', 'active')
                    ->where(function ($query) use ($keyword) {
                        $query->where('title', 'LIKE', "%$keyword%")
                            ->orWhere('description', 'LIKE', "%$keyword%");
                    })
                    ->first();
            }
            if (!$news) {
                return back();
            }
            $news->update([
                'views' => $news->views + 1
            ]);
            $news_with_same_category = News::where('news_categories_id', $news->news_categories_id)
                ->where('id', '!=', $news->id)
                ->latest()
                ->paginate(12);
            $categories = NewsCategory::whereHas('news', function ($query) {
                $query->where('status', 'active'); // Optional: Filter active news only
            })->where('status', 'active') // Filter active categories
                ->orderBy('name')
                ->get();
            return view('frontend.pages.news_details', compact('news', 'news_with_same_category', 'categories'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    // ===========fetch news title suggestion from search field========
    public function getSuggestions(Request $request)
    {
        $keyword = $request->query('keyword');

        // Fetch related news titles based on the keyword
        $suggestions = News::where('status', 'active')
            ->where('title', 'LIKE', "%$keyword%")
            ->orWhere('description', 'LIKE', "%$keyword%")
            ->limit(10)
            ->pluck('title', 'slug'); // Fetch title and slug

        return response()->json($suggestions);
    }

    // =========news with categories==========
    public function newsWithCategories($category, Request $request)
    {
        try {
            $categories = NewsCategory::whereHas('news', function ($query) {
                $query->where('status', 'active'); // Filter active news
            })->where('status', 'active')
                ->orderBy('name')
                ->get();

            if ($category === 'all_news') {
                // Handle "all news" category
                $news_with_same_category_top_news = News::where('status', 'active')->latest()->first();
                $news_with_same_category = News::where('id', '!=', $news_with_same_category_top_news->id)
                    ->where('status', 'active')
                    ->latest()
                    ->paginate(12);
            } else {
                $news_with_same_category_top_news = News::whereHas('news_categories', function ($query) use ($category) {
                    $query->where('name', $category);
                })->latest()->first();

                $news_with_same_category = News::where('id', '!=', $news_with_same_category_top_news->id)
                    ->whereHas('news_categories', function ($query) use ($category) {
                        $query->where('name', $category);
                    })->latest()->paginate(12);
            }

            if ($request->ajax()) {
                // Return news with FULL image URLs
                $newsData = $news_with_same_category->map(function ($news) {
                    return [
                        'title' => $news->title,
                        'slug' => $news->slug,
                        'image' => asset($news->image),
                        'url' => route('news.view', ['slug' => $news->slug]),
                        'created_at' => $news->created_at,
                        'description'=>\Illuminate\Support\Str::limit(html_entity_decode(strip_tags($news->description)), 100, '...'),
                        'category'=>$news->news_categories->name
                    ];
                });

                return response()->json([
                    'news' => $newsData,
                    'next_page_url' => $news_with_same_category->nextPageUrl()
                ]);
            }

            return view('frontend.pages.news_with_category', [
                'categories' => $categories,
                'news_with_same_category_top_news' => $news_with_same_category_top_news,
                'news_with_same_category' => $news_with_same_category,
                'categoryName' => $category,
                'hasMorePages' => $news_with_same_category->hasMorePages(),
            ]);
        } catch (\Exception $exception) {
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // =======load news for news source=========
    public function load(Request $request)
    {
        try {
            $sourceId = $request->input('source_id');

            // Fetch the news for the provided source ID and check if results exist
            $news = News::where('news_sources_id', $sourceId)
                ->where('status', 'active')
                ->latest()  // Orders by 'created_at' column by default
                ->take(2)  // Limits the result to 10 records
                ->get();

            // If no news is found, return an error response in JSON format
            if ($news->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No news found for the selected source.'
                ], 404);  // Return 404 HTTP status code
            }

            // If news exists, return success with the view
            return view('frontend.pages.partial_news', compact('news'));
        } catch (\Throwable $th) {
            // In case of an exception, return an error response in JSON format
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);  // Return 500 HTTP status code for internal server error
        }
    }
}
