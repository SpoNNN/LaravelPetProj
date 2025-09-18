<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Jobs\CancelExpiredDonations;
use Illuminate\Console\Scheduling\Schedule;
class ConsoleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);

            $schedule->job(new CancelExpiredDonations)->everyMinute();
        });
    }
}
