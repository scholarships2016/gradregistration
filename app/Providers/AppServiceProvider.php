<?php

namespace App\Providers;

use App\Utils\FileManager;
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

        /* Applicant Info */
        $this->app->bind('App\Repositories\Contracts\ApplicantRepository', 'App\Repositories\ApplicantRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\ApplicantNewsSourceRepository', 'App\Repositories\ApplicantNewsSourceRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\ApplicantWorkRepository', 'App\Repositories\ApplicantWorkRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\ApplicantEduRepository', 'App\Repositories\ApplicantEduRepositoryImpl');


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
        $this->app->bind('App\Repositories\Contracts\TblMajorRepository', 'App\Repositories\TblMajorRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\TblSubMajorRepository', 'App\Repositories\TblSubMajorRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\TblProjectRepository', 'App\Repositories\TblProjectRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\McourseStudyRepository', 'App\Repositories\McourseStudyRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\ApplySettingRepository', 'App\Repositories\ApplySettingRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\TblCurriculumWorkflowStatusRepository', 'App\Repositories\TblCurriculumWorkflowStatusRepositoryImpl');


        /* File */
        $this->app->bind('App\Repositories\Contracts\FileRepository', 'App\Repositories\FileRepositoryImpl');


        $this->app->bind('App\Repositories\Contracts\DepartmentRepository', 'App\Repositories\DepartmentRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\FacultyRepository', 'App\Repositories\FacultyRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\CourseRepository', 'App\Repositories\CourseRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\CurriculaRepository', 'App\Repositories\CurriculaRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\BankRepository', 'App\Repositories\BankRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\DocumentsRepository', 'App\Repositories\DocumentsRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\ApplicationPeopleRefRepository', 'App\Repositories\ApplicationPeopleRefRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\CurriculumRepository', 'App\Repositories\CurriculumRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\CurriculumSubMajorRepository', 'App\Repositories\CurriculumSubMajorRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\CurriculumProgramRepository', 'App\Repositories\CurriculumProgramRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\ApplicationRepository', 'App\Repositories\ApplicationRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\ApplicationDocumentFileRepository', 'App\Repositories\ApplicationDocumentFileRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\SatisfactionRepository', 'App\Repositories\SatisfactionRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\CurriculumActivityRepository', 'App\Repositories\CurriculumActivityRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\UserRepository', 'App\Repositories\UserRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\CurriculumWorkflowTransactionRepository', 'App\Repositories\CurriculumWorkflowTransactionRepositoryImpl');
        $this->app->bind('App\Repositories\Contracts\AudittrailRepository', 'App\Repositories\AudittrailRepositoryImpl');
$this->app->bind('App\Repositories\Contracts\TblExamStatusRepository', 'App\Repositories\TblExamStatusRepositoryImpl');

    }

}
