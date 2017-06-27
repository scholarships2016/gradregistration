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
        /* Binding Repository */

        /*Applicant Info*/
        $this->app->bind('App\Repositories\Contracts\ApplicantRepository', 'App\Repositories\ApplicantRepositoryImpl');

        /* Master Data */
        $this->app->bind('App\Repositories\Contracts\NewsSourceRepository', 'App\Repositories\NewsSourceRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\NationRepository', 'App\Repositories\NationRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\ReligionRepository', 'App\Repositories\ReligionRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\EngTestRepository', 'App\Repositories\EngTestRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\DistrictRepository', 'App\Repositories\DistrictRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\ProvinceRepository', 'App\Repositories\ProvinceRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\NameTitleRepository', 'App\Repositories\NameTitleRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\NationRepository', 'App\Repositories\NationRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\DegreeRepository', 'App\Repositories\DegreeRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\BankRepository', 'App\Repositories\BankRepositoryImpl');




    }

}
