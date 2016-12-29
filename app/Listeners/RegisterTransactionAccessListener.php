<?php

namespace App\Listeners;

use App\Events\RegisterTransactionAccessEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Auth, UserActionLog;

class RegisterTransactionAccessListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserLogIn  $event
     * @return void
     */
    public function handle(RegisterTransactionAccessEvent $registerTransactionAccess)
    {
        $userAction = new UserActionLog;
 
        $userAction->username    = Auth::user()->username;
        $userAction->module_name = $registerTransactionAccess->module_name;
        $userAction->transaction_name = $registerTransactionAccess->transaction_name;
        $userAction->action_name = $registerTransactionAccess->action_name;
        $userAction->created_at  = date('Y-m-d H:i:s');

        $userAction->save();
       

        return false;

    }
}
