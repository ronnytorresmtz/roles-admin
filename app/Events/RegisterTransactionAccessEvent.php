<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use Lang;

class RegisterTransactionAccessEvent extends Event
{
    use SerializesModels;

       
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user_action)
    {
        $transAction= explode('.', $user_action);

        $this->module_name      = Lang::get($transAction[0]);
        $this->transaction_name = Lang::get($transAction[1]); 
        $this->action_name      = Lang::get($transAction[2]);
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
