<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Log;

class eventusermsg implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;
    public $msg;
    private $touserid;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($touserid,$msg)
    {
        //
        $this->msg=$msg;
        $this->touserid=$touserid;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('App.User.'.$this->touserid);
    }

}
