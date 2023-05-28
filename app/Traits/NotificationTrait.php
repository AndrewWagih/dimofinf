<?php

namespace App\Traits;

use App\Models\User;

trait NotificationTrait
{
    protected function newUserNotification(User $user,$url,$type)
    {
        $message = $user->username . 'added '.$type;
        storeAndPushNotification('New '.$type, $message, $url);
    }


}
