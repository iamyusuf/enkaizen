<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ImageHandled implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    private $image;

    /**
     * Create a new event instance.
     *
     * @param $image
     */
    public function __construct($image)
    {
        //
        $this->image = $image;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('downloaded');
    }

    public function broadcastWith()
    {
        return [
            'image' => $this->image
        ];
    }

    public function broadcastAs()
    {
        return 'fileUploaded.' . $this->image->user_id;
    }
}
