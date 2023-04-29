<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\IAuth;
use App\Http\Requests\AuthRequest;

class AuthController extends Controller
{
    //
    private IAuth $authRepository;

    public function __construct(IAuth $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function signIn(AuthRequest $request)
    {
        $password = $request->get('password');

        $userAdmin = $this->authRepository->getAdmin($password);
        $userRegular = $this->authRepository->getUser($password);

        if($userAdmin != null) return $userAdmin;
        if($userRegular != null) return $userRegular;

        return response()->json([
            'status' => false,
            'message' => "Invalid Account",
        ], 400);
    }
}
