<?php

namespace App\Providers;

use App\Models\Visit;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('layouts.main', function($view){
            $visitCount = Visit::first()->count ?? 0;

            $view->with('visitCount', $visitCount);
        });
    }
}
