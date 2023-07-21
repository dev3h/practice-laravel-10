<?php

namespace App\Listeners;

use App\Events\CustomerOrder;
use App\Models\User;
use App\Notifications\WelcomeEmailNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SenMailConfirmOrder implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public $user;
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     */
    public function handle(CustomerOrder $event): void
    {
        $this->user = User::where('email', $event->user['email'])->first();
         Notification::send($event->user,new WelcomeEmailNotification($this->user));
    }
}
