<?php

use Illuminate\Foundation\Inspiring;
use App\Repositories\McourseStudyRepositoryImpl;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/
Log::info('console.php is called!');
Log::info('Start Sync Program Data');
$mcourse = new McourseStudyRepositoryImpl();
$mcourse->updateAllCourse();
$mcourse->syncMajor();
$mcourse->syncDepartment();
Log::info('End Sync Program Data');


//Artisan::command('sync', function () {
    //$this->comment(Inspiring::quote());
    //Log::info('Artisan::command sync is called!');
    //$mcourse->updateAllCourse();
//})->describe('Sync Program Detail');
