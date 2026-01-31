<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share categories with all views
        View::composer('*', function ($view) {
            $categories = cache()->remember('header_categories', 60, function () {
                return Category::where('is_active', true)
                    ->whereNull('parent_id')
                    ->with('children')
                    ->get();
            });
            
            $view->with('categories', $categories);
        });
    }
}
