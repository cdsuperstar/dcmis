<?php

namespace App\Events;

use Faker\Provider\DateTime;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class normal implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;
    public $sNotifi;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($msg)
    {
        //
        $this->sNotifi["text"]=$msg;
        $this->sNotifi["datetime"]=date("h:i:sa");
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('dcBroadcast');
    }

}
