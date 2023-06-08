<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NoticeEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $title;
    public $type;
    public $duration;
    public $src;

    public function __construct($params)
    {

        // config([
        //     "PUSHER_APP_ID" => "1561990",
        //     "PUSHER_APP_KEY" => "597d1d6a8840eafc2c67",
        //     "PUSHER_APP_SECRET" => "bd1e3719466d7465ce0b",
        // ]);

        config("PUSHER_APP_ID" , "1563286");
        config("PUSHER_APP_KEY" , "95a142e8a2ee0f3aeaff");
        config("PUSHER_APP_SECRET" , "88d4f3ed8f4a6685617e");

        $this->title = $params['title'];
        $this->message = $params['message'];
        $this->src = $params['src'];
        $this->type = "success";
        $this->duration = 10000;
    }

    public function broadcastOn()
    {
        return ['notice', 'user-notice'];
    }

    public function broadcastAs()
    {
        return 'notice';
    }
}
