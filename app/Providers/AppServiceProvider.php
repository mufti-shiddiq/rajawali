<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        config(['app.locale' => 'id']);
        Carbon::setLocale('id');

        Schema::defaultStringLength(191);

        Blade::directive('rupiah', function ($rupiah) {
            return "Rp. <?php echo number_format($rupiah,0,',','.'); ?>";
        });

        Blade::directive('money', function ($money) {
            return "<?php echo number_format($money,0,',','.'); ?>";
        });
    }
}
