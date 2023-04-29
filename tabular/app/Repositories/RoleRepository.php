<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IRole;
use App\Models\Role;

class RoleRepository implements IRole
{
    public function fetchRoles()
    {
        return Role::where('role', '!=', 'Admin')->get();
    }
}