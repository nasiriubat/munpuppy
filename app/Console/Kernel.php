<?php

namespace App\Console;

use Exception;
use App\Mail\SendBackupMail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

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
        // $schedule->command('backup:run')->everyMinute();
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () use ($schedule) {
            File::deleteDirectory(storage_path('app/' . env('APP_NAME')));
            // Artisan::call('backup:run');
            Artisan::call('backup:run', ['--only-db' => true]);

            $path = storage_path('app\\' . env('APP_NAME'));
            $file = scandir(storage_path('app\\' . env('APP_NAME')))[2];
            $file_path = $path . '/' . $file;

            try {
                $email = new SendBackupMail($file_path);
                Mail::send($email);
            } catch (Exception $e) {
                dd($e->getMessage());
            }
        })->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
