<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IAuth;
use App\Models\User;
use App\Models\SuperUser;

class AuthRepository implements IAuth
{
    public function getAdmin($password)
    {
        return SuperUser::with('role')->where('password', '=', $password)->first();
    }

    public function getUser($password)
    {
        return User::with('role')->where('password', '=', $password)->first();
    }
}