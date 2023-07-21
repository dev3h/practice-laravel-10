<?php

namespace App\Console\Commands;

use App\Models\User;
use Exception;
use Illuminate\Console\Command;

class ConvertEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    public function __construct()
    {
        parent::__construct();
    }
    protected $signature = 'user:convert-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert email in table users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
   

     $users = User::where('email', 'like', '%@finews.biz%')->get();
        $users->each(function ($user) {
            $this->convertEmail($user);
        });
    }
    protected function convertEmail(User $user)
    {
        try {
            $oldEmail = $user->email;
            $newEmail = str_replace('@finews.biz', '@gmail.com', $user->email);
            $user->email = $newEmail;
            $user->save();
            $this->info("convert email from {$oldEmail} to {$newEmail} Success!");
        } catch (Exception $e) {
            $this->error("convert email {$oldEmail} Fail!");
            $this->error('--- ' . $e->getMessage());
        }
    }
}
