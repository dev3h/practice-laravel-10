<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function saving(User $user)
    {
        // dd(1);
    }
    public function creating(User $user)
    {
        // dd(3);
    }

    public function created(User $user): void
    {
        // dd(2);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }
    public function deleting(User $user): void
    {
        foreach ($user->classrooms as $classroom) {
            $classroom->delete();
        }

    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
