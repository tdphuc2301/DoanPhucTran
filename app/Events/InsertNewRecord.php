<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InsertNewRecord
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $object;
    public $name;
    /**
     * Create a new event instance.
     *
     * @param Model $objectClass
     * @param string $objectId
     * @param string $name
     * @return void
     */
    public function __construct(Model $object, string $name)
    {
        $this->object = $object;
        $this->name = $name;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
