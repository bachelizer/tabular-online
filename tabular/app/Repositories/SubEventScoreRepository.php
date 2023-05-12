<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ISubScore;
use App\Models\SubEventScore;

use DB;

class SubEventScoreRepository implements ISubScore
{
    public function createScore($scoreDetails)
    {
        $score = new SubEventScore([
            'event_id' => $scoreDetails->get('event_id'),
            'sub_event_id' => $scoreDetails->get('sub_event_id'),
            'participant_id' => $scoreDetails->get('participant_id'),
            'sub_criteria_id' => $scoreDetails->get('sub_criteria_id'),
            'user_id' => $scoreDetails->get('user_id'),
            'score'  => $scoreDetails->get('score')
        ]);

        $score->save();
    }

    public function existingScore($scoreDetails)
    {
        $score = SubEventScore::where([
            ['participant_id', '=', $scoreDetails->get('participant_id')],
            ['sub_criteria_id', '=', $scoreDetails->get('sub_criteria_id')],
            ['event_id', '=', $scoreDetails->get('event_id')],
            ['user_id', '=', $scoreDetails->get('user_id')]
        ])->first();

        return $score;
    }

    public function updateScore($id, $scoreRaw)
    {
        $score = SubEventScore::find($id);
        $score->score = $scoreRaw;
        $score->save();
    }

    public function fetchParticipantScore($participantId, $userId, $subEventId)
    {
        return SubEventScore::where([['participant_id', '=', $participantId], ['user_id', '=', $userId], ['sub_event_id', '=', $subEventId]])->get();
    }
}
