<?php

namespace App\Providers;

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
        // Ép buộc Laravel sử dụng HTTPS cho tất cả các đường link (CSS, JS, Route)
        // Render luôn dùng HTTPS ở ngoài, nhưng chuyển thành HTTP khi vào container
        if (config('app.env') === 'production' || env('RENDER') === 'true' || str_contains(config('app.url'), 'https')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
        // Đảm bảo Super Admin luôn có quyền truy cập tất cả Menu trong Filament
        \Illuminate\Support\Facades\Gate::before(function ($user, $ability) {
            return $user->hasRole('super_admin') ? true : null;
        });
    }
}
