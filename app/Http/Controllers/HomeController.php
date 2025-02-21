<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Palika;
use App\Models\Province;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            /**
             *----------------Ecommerce---------------------------
             */
            // Get the total sales
            $totalSales = Order::where('status', 'delivered')->sum('total_charge');

            // Get the total sales for the current month (sum of 'total_charge' in 'orders' table)
            $currentMonthSales = Order::whereMonth('created_at', now()->month)->where('status', 'delivered')->sum('total_charge');

            // Get the total sales for the previous month
            $lastMonthSales = Order::whereMonth('created_at', now()->subMonth()->month)->where('status', 'delivered')->sum('total_charge');

            // Calculate the percentage change from last month
            if ($lastMonthSales == 0) {
                $percentageChangeForSales = $currentMonthSales > 0 ? 100 : 0;
            } else {
                $percentageChangeForSales = (($currentMonthSales - $lastMonthSales) / $lastMonthSales) * 100;
            }


            // Get the total number of orders for the current month
            $totalOrders = Order::count();

            // Get the total number of orders for the current month
            $currentMonthOrders = Order::whereMonth('created_at', now()->month)->count();

            // Get the total number of orders for the previous month
            $lastMonthOrders = Order::whereMonth('created_at', now()->subMonth()->month)->count();

            // Calculate the percentage change from last month
            if ($lastMonthOrders == 0) {
                $percentageChangeForOrders = $currentMonthOrders > 0 ? 100 : 0;
            } else {
                $percentageChangeForOrders = (($currentMonthOrders - $lastMonthOrders) / $lastMonthOrders) * 100;
            }

            // Get the total number of customers (users with the 'user' role)
            $totalCustomers = User::role('user')->count();

            // Get the total number of customers for the current month
            $currentMonthCustomers = User::role('user')
                ->whereMonth('created_at', now()->month)
                ->count();

            // Get the total number of customers for the previous month
            $lastMonthCustomers = User::role('user')
                ->whereMonth('created_at', now()->subMonth()->month)
                ->count();

            // Calculate the percentage change from last month
            if ($lastMonthCustomers == 0) {
                $percentageChangeForCustomer = $currentMonthCustomers > 0 ? 100 : 0;
            } else {
                $percentageChangeForCustomer = (($currentMonthCustomers - $lastMonthCustomers) / $lastMonthCustomers) * 100;
            }


            // Fetch the latest three orders
            $recentOrders = Order::latest()->take(3)->get();

            // Fetch top-selling products based on quantity sold
            $topSellingProducts = OrderItem::select(
                'order_items.product_id',
                DB::raw('SUM(order_items.qty) as total_qty_sold'),
                DB::raw('SUM(order_items.qty * order_items.price) as total_revenue')
            )
                ->join('orders', 'orders.id', '=', 'order_items.order_id')
                ->where('orders.status', 'delivered')
                ->groupBy('order_items.product_id')
                ->orderByDesc('total_qty_sold')
                ->limit(5)
                ->with('product') // Eager load product details
                ->get();



            /**
             *--------------------------News-----------------------------
             */
            // Get the total number of news articles 
            $totalNews = News::where('status', 'active')->count();

            // Get the total number of news articles for the current month
            $currentMonthNews = News::where('status', 'active')->whereMonth('created_at', now()->month)->count();

            // Get the total number of news articles for the previous month
            $lastMonthNews = News::where('status', 'active')->whereMonth('created_at', now()->subMonth()->month)->count();

            // Calculate the percentage change from last month
            if ($lastMonthNews == 0) {
                $percentageChangeForNews = $currentMonthNews > 0 ? 100 : 0;
            } else {
                $percentageChangeForNews = (($currentMonthNews - $lastMonthNews) / $lastMonthNews) * 100;
            }

            // Get the most viewed news article
            $mostViewedNews = News::orderByDesc('views')->first();

            // Get the total views of the most popular article
            $mostViewedCount = $mostViewedNews ? $mostViewedNews->views : 0;

            // Get the most viewed news article for the current month
            $mostViewedNewsCurrentMonth = News::whereMonth('created_at', now()->month)
                ->orderByDesc('views')
                ->first();

            // Get the most viewed count for the current month
            $mostViewedCountCurrentMonth = $mostViewedNewsCurrentMonth ? $mostViewedNewsCurrentMonth->views : 0;

            // Get the most viewed news article for the previous month
            $mostViewedNewsPreviousMonth = News::whereMonth('created_at', now()->subMonth()->month)
                ->orderByDesc('views')
                ->first();

            // Get the most viewed count for the previous month
            $mostViewedCountPreviousMonth = $mostViewedNewsPreviousMonth ? $mostViewedNewsPreviousMonth->views : 0;

            // Calculate percentage change
            if ($mostViewedCountPreviousMonth == 0) {
                $percentageChangeForMostViewed = $mostViewedCountCurrentMonth > 0 ? 100 : 0;
            } else {
                $percentageChangeForMostViewed = (($mostViewedCountCurrentMonth - $mostViewedCountPreviousMonth) / $mostViewedCountPreviousMonth) * 100;
            }

            // Get the count of trending news
            $totalTrendingNews = News::where('trending_news', true)
                ->count();

            // Get the count of trending news for the current month
            $currentMonthTrendingNews = News::whereMonth('created_at', now()->month)
                ->where('trending_news', true)
                ->count();

            // Get the count of trending news for the previous month
            $lastMonthTrendingNews = News::whereMonth('created_at', now()->subMonth()->month)
                ->where('trending_news', true)
                ->count();

            // Calculate percentage change for trending news
            if ($lastMonthTrendingNews == 0) {
                $percentageChangeForTrendingNews = $currentMonthTrendingNews > 0 ? 100 : 0;
            } else {
                $percentageChangeForTrendingNews = (($currentMonthTrendingNews - $lastMonthTrendingNews) / $lastMonthTrendingNews) * 100;
            }

            // Get the count of news categories
            $totalCategories = NewsCategory::where('status', 'active')
                ->count();

            // Get the count of news categories for the current month
            $currentMonthCategories = NewsCategory::whereMonth('created_at', now()->month)
                ->where('status', 'active')
                ->count();

            // Get the count of news categories for the previous month
            $lastMonthCategories = NewsCategory::whereMonth('created_at', now()->subMonth()->month)
                ->where('status', 'active')
                ->count();

            // Calculate percentage change for news categories
            if ($lastMonthCategories == 0) {
                $percentageChangeForCategories = $currentMonthCategories > 0 ? 100 : 0;
            } else {
                $percentageChangeForCategories = (($currentMonthCategories - $lastMonthCategories) / $lastMonthCategories) * 100;
            }

            /**
             *--------------------------Municipalities-----------------------------
             */
            $totalProvinces = Province::where('status', 'active')->count();
            $totalDistricts = District::where('status', 'active')->count();
            $totalMunicipalities = Palika::where('status', 'active')->count();

            return view('backend.index', compact(
                'totalSales',
                'percentageChangeForSales',
                'totalOrders',
                'percentageChangeForOrders',
                'totalCustomers',
                'percentageChangeForCustomer',
                'currentMonthSales',
                'recentOrders',
                'topSellingProducts',
                'totalNews',
                'percentageChangeForNews',
                'mostViewedCount',
                'percentageChangeForMostViewed',
                'totalTrendingNews',
                'percentageChangeForTrendingNews',
                'totalCategories',
                'percentageChangeForCategories',
                'totalProvinces',
                'totalDistricts',
                'totalMunicipalities'
            ));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function getRevenueData()
    {
        $currentYear = now()->year;
        // Query to get revenue per month for delivered orders.
        $monthlyRevenue = Order::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_charge) as revenue')
        )
            ->whereYear('created_at', $currentYear)
            ->where('status', 'delivered')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('revenue', 'month')
            ->toArray();

        // Create an array for all 12 months, defaulting to 0 if no revenue exists.
        $fullRevenue = [];
        for ($m = 1; $m <= 12; $m++) {
            $fullRevenue[$m] = isset($monthlyRevenue[$m]) ? $monthlyRevenue[$m] : 0;
        }

        return response()->json($fullRevenue);
    }

    public function getNewsTrendData()
    {
        $currentYear = now()->year;

        // Get the count of news published per month for the current year
        $newsTrend = News::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as news_count')
        )
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('news_count', 'month')
            ->toArray();

        // Prepare an array for all 12 months; if no news published, default to 0
        $newsTrendData = [];
        for ($m = 1; $m <= 12; $m++) {
            $newsTrendData[$m] = isset($newsTrend[$m]) ? $newsTrend[$m] : 0;
        }

        return response()->json($newsTrendData);
    }

    public function getNewsCategoriesData()
    {
        $newsCategoriesDistribution = DB::table('news')
            ->join('news_categories', 'news.news_categories_id', '=', 'news_categories.id')
            ->select('news_categories.name', DB::raw('COUNT(news.id) as news_count'))
            ->groupBy('news_categories.name')
            ->orderBy('news_categories.name')
            ->get();

        $labels = $newsCategoriesDistribution->pluck('name');
        $series = $newsCategoriesDistribution->pluck('news_count');

        return response()->json([
            'labels' => $labels,
            'series' => $series
        ]);
    }
}
