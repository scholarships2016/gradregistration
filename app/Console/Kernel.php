<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Repositories\McourseStudyRepositoryImpl;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $filePath = storage_path('logs/sync-program-batch.log');
        $schedule->call(function () {
           //DB::table('recent_users')->delete();
            $mcourse = new McourseStudyRepositoryImpl();
            $mcourse->updateAllCourse();
			$mcourse->syncMajor();
			$mcourse->syncDepartment();
      $mcourse->syncDegree();
      $mcourse->syncDataStatus();
			//$mcourse->syncFaculty();
       })->daily()->appendOutputTo($filePath);
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
