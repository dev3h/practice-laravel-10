<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationUser implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $user;
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        // return [
        //     new PrivateChannel("User.{$this->user->id}"),
        // ];
        return [
            'public',
        ];
    }
    public function broadcastAs(): string
    {
        return 'user.notification';
    }
    // public function broadcastToEveryone()
    // {
    //     return true;
    // }
    public function broadcastWith()
    {
        return [
            "name" => $this->user->name,
            "email" => $this->user->email,
        ];
    }
}
