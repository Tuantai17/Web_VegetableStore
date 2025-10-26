<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // Ép toàn bộ URL sử dụng HTTPS trong môi trường production (như Render)
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
             URL::forceRootUrl(config('app.url'));  // <— thêm dòng này
        }
    }
}
