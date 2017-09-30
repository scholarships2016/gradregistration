<?php

use Illuminate\Foundation\Inspiring;
use App\Repositories\McourseStudyRepositoryImpl;
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

Artisan::command('sync', function () {
    //$this->comment(Inspiring::quote());
    $mcourse = new McourseStudyRepositoryImpl();
    $mcourse->updateAllCourse();
})->describe('Sync Program Detail');
