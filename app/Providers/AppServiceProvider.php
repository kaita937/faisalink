<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\PeminjamNotification;

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
        View::composer('*', function ($view) {
            if (!Auth::guard('peminjam')->check()) {
                return;
            }

            $userId = Auth::guard('peminjam')->id();
            $notifications = PeminjamNotification::where('id_peminjam', $userId)
                ->orderByDesc('created_at')
                ->limit(10)
                ->get();

            $unreadCount = PeminjamNotification::where('id_peminjam', $userId)
                ->whereNull('read_at')
                ->count();

            $view->with('notifications', $notifications)
                ->with('unreadCount', $unreadCount);
        });
    }
}
