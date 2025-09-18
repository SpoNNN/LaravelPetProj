<?php

namespace App\Listeners;

use App\Events\DonateSuccesfull;
use App\Mail\DonationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
class SendDonationNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(DonateSuccesfull $event): void
    {
        $donation = $event->donation;
        if ($donation->email) {
            Mail::to($donation->email)->send(new DonationMail($donation));
        }
    }
}
