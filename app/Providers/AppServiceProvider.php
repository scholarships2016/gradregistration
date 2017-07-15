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
        $this->app->bind('App\Repositories\Contracts\ApplicantNewsSourceRepository', 'App\Repositories\ApplicantNewsSourceRepositoryImpl');


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
        $this->app->bind('App\Repositories\Contracts\GaduateLevelRepository', 'App\Repositories\GaduateLevelRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\EducationPassRepository', 'App\Repositories\EducationPassRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\UniversityRepository', 'App\Repositories\UniversityRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\WorkStatusRepository', 'App\Repositories\WorkStatusRepositoryImpl');
         $this->app->bind('App\Repositories\Contracts\ProgramTypeRepository', 'App\Repositories\ProgramTypeRepositoryImpl');


        
        $this->app->bind('App\Repositories\Contracts\DepartmentRepository', 'App\Repositories\DepartmentRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\FacultyRepository', 'App\Repositories\FacultyRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\CourseRepository', 'App\Repositories\CourseRepositoryImpl');
         $this->app->bind('App\Repositories\Contracts\CurriculaRepository', 'App\Repositories\CurriculaRepositoryImpl');
          $this->app->bind('App\Repositories\Contracts\BankRepository', 'App\Repositories\BankRepositoryImpl');
           $this->app->bind('App\Repositories\Contracts\DocumentsRepository', 'App\Repositories\DocumentsRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\ApplicationPeopleRefRepository', 'App\Repositories\ApplicationPeopleRefRepositoryImpl');
         $this->app->bind('App\Repositories\Contracts\CurriculumRepository', 'App\Repositories\CurriculumRepositoryImpl');
           
    }

}
