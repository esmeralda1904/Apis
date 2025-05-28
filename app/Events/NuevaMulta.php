<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Multa;

class NuevaMulta implements ShouldBroadcast
{
    public $multa;

    public function __construct(Multa $multa)
    {
        $this->multa = $multa;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('departamento.' . $this->multa->departamento);
    }
}

