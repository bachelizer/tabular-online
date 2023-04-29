<?php

namespace App\Repositories\Interfaces;

interface IUser
{
    public function fetchEventUser($eventId);

    public function createUser($userDetails);

    public function getUser($password);

    public function updateUser($userDetails, $id);

    public function removeUser($id);
}