<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
//
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        /* Binding Repository */

        /* Admin Module   */
        $this->app->bind('App\Repositories\Contracts\NationRepository', 'App\Repositories\NationRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\DegreeRepository', 'App\Repositories\DegreeRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\BankRepository', 'App\Repositories\BankRepositoryImpl');
    }

}
