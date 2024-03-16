<?php

namespace App\Providers;

use App\Models\Organization;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

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
        view()->composer(
            'layouts.template',
            function ($view) {
                $roleName = strtolower(Auth::user()->role->name);
                $view->with('organization', Organization::first());
            }
        );
    }
}
