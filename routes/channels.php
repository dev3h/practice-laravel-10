<?php

use Illuminate\Support\Facades\Broadcast;
use App\Broadcasting\UserChannel;

// Broadcast::channel('User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });
Broadcast::channel('User.{id}', UserChannel::class);
