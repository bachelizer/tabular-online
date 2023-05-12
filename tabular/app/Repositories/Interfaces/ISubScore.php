<?php

namespace App\Repositories\Interfaces;

interface ISubScore
{
    public function createScore($scoreDetails);
    public function existingScore($scoreDetails);
    public function updateScore($id, $scoreRaw);
    public function fetchParticipantScore($participantId, $userId, $subEventId);
}