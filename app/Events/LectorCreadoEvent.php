<?php
namespace App\Events;
use App\Lector;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
class LectorCreadoEvent extends Event implements ShouldBroadcast{
    public $lector;
    public function __construct(Lector $lector){
        $this->lector = $lector;
    }
    
    public function broadcastOn(){
        return new Channel('lector');
    }
}