<?php

namespace App\Providers;

use App\Models\Organization;
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
        view()->composer(
            'layouts.template',
            function ($view) {
                $roleName = strtolower(Auth::user()->role->name);
                $name = '';
                if($roleName !== 'admin'){
                    $name = Auth::user()->$roleName[0]->name;
                } else {
                    $name = Auth::user()->$roleName->name;
                }
                $view->with('organization', Organization::first());
                $view->with('name', $name);
            }
        );
    }
}
