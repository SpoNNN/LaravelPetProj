<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\Donations;
use Carbon\Carbon;
class CancelExpiredDonations implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $expiredDonations = Donations::where('status', 'pending')
            ->where('created_at', '<', Carbon::now()->subMinutes(10))
            ->get();
        foreach ($expiredDonations as $donation) {
            $donation->markAsCanceled();
        }
    }

}
