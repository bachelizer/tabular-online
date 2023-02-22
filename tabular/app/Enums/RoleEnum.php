<?php

namespace App\Enums;

enum RoleEnum: int
{
    case Admin = 1;
    case Emcee = 2;
    case Judge = 3;
}