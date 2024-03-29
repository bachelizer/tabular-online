<?php

namespace App\Repositories\Interfaces;

interface IParticipant
{
    public function fetchEventParticipant($eventId);

    public function createParticipant($participantDetails);

    public function getParticipant($id);

    public function updateParticipant($participantDetails, $id);

    public function removeParticipant($id);

}