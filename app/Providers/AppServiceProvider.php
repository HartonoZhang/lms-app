<?php

namespace App\Providers;

use App\Models\Organization;
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
        view()->composer(
            'layouts.template',
            function ($view) {
                $view->with('organization', Organization::first());
            }
        );
    }
}
