<?php

namespace App\Providers;

use App\Models\NewsCategory;
use App\Repositories\BlogRepository;
use App\Repositories\Interfaces\BlogRepositoryInterface;
use App\Repositories\Interfaces\NewsRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\NewsRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BlogRepositoryInterface::class, BlogRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(NewsRepositoryInterface::class, NewsRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Fetch all categories and share them with all views
        view()->share('news_categories', NewsCategory::whereHas('news', function ($query) {
            $query->where('status', 'active');
        })->orderBy('name', 'asc')->get());
        // This composer attaches the cart count to every view.
        view()->composer('*', function ($view) {
            if (auth()->check()) {
                $cartCount = \App\Models\Cart::where('user_id', auth()->id())->sum('cart_count');
                if($cartCount>=100){
                    $view->with('cartCount', '100+');
                }else{
                    $view->with('cartCount', $cartCount);
                }
            } else {
                $view->with('cartCount', 0);
            }
        });
    }
}
