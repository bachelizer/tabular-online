<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\IUser;

class UserController extends Controller
{
    //
    private IUser $userRepository;

    public function __construct(IUser $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function store(Request $request)
    {
        $this->userRepository->createUser($request);
        return response()->json([
            'status' =>  true ,
            'message' =>"Successfully Added" ,
        ],  200 );
    }

    public function update(Request $request, $id)
    {
        $this->userRepository->updateUser($request, $id);

    }

    public function fetchEventUser($eventId)
    {
        $users = $this->userRepository->fetchEventUser($eventId);
        // $event = $this->eventRepository->showEvent($id);
        return response()->json($users);
    }

    public function getUser($password)
    {
        // $password = $request->get('password');
        return $this->userRepository->getUser($password);
    }

    public function destroy($id)
    {
        $this->userRepository->removeUser($id);
    }
}
