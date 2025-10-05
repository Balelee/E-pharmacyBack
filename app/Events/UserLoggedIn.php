<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserLoggedIn implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

   
    public $user;
    public $device;
    public $ip;

    public function __construct(User $user, $device, $ip)
    {
        $this->user = $user;
        $this->device = $device;
        $this->ip = $ip;
    }

    public function broadcastOn()
    {
        // Chaque user a son canal privé
        return new PrivateChannel('user.'.$this->user->id);
    }

    public function broadcastAs()
    {
        return 'user.logged_in';
    }

    public function broadcastWith()
    {
        return [
            'message' => 'Nouvelle connexion détectée',
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->userName,
            ],
            'device' => $this->device,
            'ip' => $this->ip,
            'time' => now()->toDateTimeString(),
        ];
    }
}
