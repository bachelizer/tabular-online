<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IUser;
use App\Models\User;

class UserRepository implements IUser
{
    public function fetchEventUser($eventId)
    {
        return User::with('role')->where('event_id', $eventId)->orderBy('full_name')->get();
    }

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

    public function updateUser($userDetails, $id)
    {
        $user =  User::find($id);

        $user->screen_name = $userDetails->get('screen_name');
        $user->full_name = $userDetails->get('full_name');
        $user->role_id = $userDetails->get('role_id');
        $user->password = $userDetails->get('password');

        $user->save();
    }

    public function getUser($password)
    {
        $user = User::where('password','=',$password)->first();
        $user->role;
        $user->event;
        return $user;
    }

    public function removeUser($id)
    {
        $participant = User::find($id);
        $participant->delete();
    }
}