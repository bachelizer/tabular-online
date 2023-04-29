<?php

namespace App\Repositories\Interfaces;

interface IScore
{
    public function createScore($scoreDetails);
    public function getTotalPercentage($eventId);
}