<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // $this->app->bind('App\Repositories\RepositoryInterface', 'App\Repositories\ProductRepository');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        Blade::directive('rupiah', function ($num) {
            return "<?php echo number_format($num, 0 , ',', '.'); ?>";
        });
    }
}
