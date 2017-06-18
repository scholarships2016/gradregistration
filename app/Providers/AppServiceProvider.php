<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /* Binding Repository*/

        /* Admin Module 
        $this->app->bind('App\Repositories\Contracts\UserRepository', 'App\Repositories\UserRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\RoleRepository', 'App\Repositories\RoleRepositoryImpl’);*/

    }
}
