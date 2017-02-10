<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Request;

class usercmd implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;
    public $cmd;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($cmd)
    {
        //
        $this->cmd=$cmd;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('App.User.'.Request::user()->id);
    }

}
