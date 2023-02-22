<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IUser;
use App\Models\User;

class UserRepository implements IUser
{
    public function createUser($userDetails)
    {
        $user = new User([
            'password' => $userDetails->get('password'),
            'event_id' => $userDetails->get('event_id'),
            'role_id' => $userDetails->get('role_id'),
            'full_name' => $userDetails->get('full_name'),
            'screen_name' => $userDetails->get('screen_name')
        ]);

        $user->save();
    }
}