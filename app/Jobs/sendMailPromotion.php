<?php

namespace App\Jobs;

use App\Mail\PromotionMail;
use App\Models\User;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class sendMailPromotion implements ShouldQueue, ShouldBeUnique
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    private $user;
    public function __construct($user)
    {
        $this->user = $user;
    }
    // public function __construct()
    // {

    // }

    /**
     * Execute the job.
     */
    public function handle()
    {
//         $users = User::all();
//         // Log::info($users[0]['email']);
//         foreach ($users as $user) {
//             Mail::to($user->email)
// // ->bcc($recipientEmails)
// // ->queue(new PromotionMail($request->user()));
//                 ->send(new PromotionMail($user));
//         }

//         foreach ($users as $user) {
//             // Log::info($user);
//             Mail::to($user)
// // ->bcc($recipientEmails)
// // ->queue(new PromotionMail($request->user()));
//                 ->send(new PromotionMail($user));

//         }
        Mail::to($this->user)->queue(new PromotionMail($this->user));

    }
}
