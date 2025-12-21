<?php

namespace App\Providers;

use App\Models\Visit;
use Illuminate\Support\Facades\Blade;
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
        View::composer('layouts.main', function ($view) {
            $visitCount = Visit::first()->count ?? 0;

            $view->with('visitCount', $visitCount);
        });

        Blade::directive('inr_words', function ($amount) {
            return "<?php 
                \$f = new \NumberFormatter('en_IN', \NumberFormatter::SPELLOUT);
                // Handle decimals (Paise)
                \$whole = floor($amount);
                \$fraction = round(($amount - \$whole) * 100);
                
                \$output = \$f->format(\$whole) . ' Rupees';
                
                if (\$fraction > 0) {
                    \$output .= ' and ' . \$f->format(\$fraction) . ' Paise';
                }
                
                echo ucwords(\$output) . ' Only';
            ?>";
        });
    }
}
