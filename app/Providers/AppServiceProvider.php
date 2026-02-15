<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
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
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
        Paginator::useTailwind();
        View::composer('*', function ($view) {

            $educationCategories = Category::with('educations')
                ->whereHas('educations')
                ->get();

            $recipeCategories = Category::with('recipes')
                ->whereHas('recipes')
                ->get();

            $view->with([
                'educationCategories' => $educationCategories,
                'recipeCategories' => $recipeCategories,
            ]);
        });
    }
}
