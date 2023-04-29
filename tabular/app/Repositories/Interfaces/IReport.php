<?php

namespace App\Repositories\Interfaces;

interface IReport
{
    public function getScores($eventId);
    public function getAllScores($eventId);
    public function getScoringJudge($eventId);
}