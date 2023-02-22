<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\IRole;

class RoleController extends Controller
{
    //
    private IRole $roleRepository;

    public function __construct(IRole $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        return $this->roleRepository->fetchRoles();
    }
}
