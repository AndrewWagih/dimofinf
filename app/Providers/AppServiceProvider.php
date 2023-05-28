<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Admin;
use Illuminate\Support\Facades\View;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('partials.dashboard.header', function ($view) {
            $unreadNotifications = Admin::first()->unreadNotifications()->get();
            $allNotifications = Admin::first()->notifications()->get();
            $view->with(['unreadNotifications' => $unreadNotifications, "allNotifications" => $allNotifications]);
        });

        View::composer('partials.dashboard.sidebar', function ($view) {
            $unreadNotifications = Admin::first()->unreadNotifications()->take(5)->get();

            $view->with(['unreadNotifications' => $unreadNotifications]);
        });
    }
}
