<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IParticipant;
use App\Models\Participant;

class ParticipantRepository implements IParticipant
{
    public function createParticipant($participantDetails)
    {
        $participant = new Participant([
            'screen_name' => $participantDetails->get('screen_name'),
            'full_name' => $participantDetails->get('full_name'),
            'number' => $participantDetails->get('number'),
            'event_id' => $participantDetails->get('event_id')
        ]);

        $participant->save();
    }

    public function getParticipant($id)
    {
        $participant = Participant::find($id);
        $participant->scores;
        return $participant;
        // return Participant::with('score')->where('id', $id)->get();
    }

    public function updateParticipant($participantDetails, $id)
    {
        $participant =  Participant::find($id);

        $participant->screen_name = $participantDetails->get('screen_name');
        $participant->full_name = $participantDetails->get('full_name');
        $participant->number = $participantDetails->get('number');
    }

    public function removeParticipant($id)
    {
        $participant = Participant::find($id);

        $participant->delete();
    }
}