<?php

namespace App\Providers;

use App\Models\Refund;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;

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
        View::composer('admin.partials.sidebar', function ($view) {
            $currentRouteName = Route::currentRouteName();

            // If the current route name contains a dot, assume it is a child route
            if (strpos($currentRouteName, '.') !== false) {
                $routeParts = explode('.', $currentRouteName);
                $parentMenuItemId = $routeParts[0]; // The parent menu item ID is the first part of the route name
                $view->with([
                    'routeName' => $currentRouteName,
                    'parentMenuItemId' => $parentMenuItemId
                ]);
            } else {
                // If the current route name does not contain a dot, assume it is a parent menu item
                $view->with([
                    'routeName' => $currentRouteName,
                    'parentMenuItemId' => $currentRouteName
                ]);
            }
        });
    }
}
