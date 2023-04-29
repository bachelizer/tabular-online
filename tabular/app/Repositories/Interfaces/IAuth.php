<?php

namespace App\Repositories\Interfaces;

interface IAuth
{
    public function getAdmin($password);

    public function getUser($password);
}