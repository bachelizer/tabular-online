<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IScore;
use App\Models\Score;

use DB;

class ScoreRepository implements IScore
{
    public function createScore($scoreDetails)
    {
        $score = new Score([
            'participant_id' => $scoreDetails->get('participant_id'),
            'criteria_id' => $scoreDetails->get('criteria_id'),
            'score' => $scoreDetails->get('score'),
            'user_id' => $scoreDetails->get('user_id'),
            'event_id' => $scoreDetails->get('event_id')
        ]);

        $score->save();
    }

    public function existingScore($scoreDetails)
    {
        $score = Score::where([
            ['participant_id', '=', $scoreDetails->get('participant_id')],
            ['criteria_id', '=', $scoreDetails->get('criteria_id')],
            ['event_id', '=', $scoreDetails->get('event_id')],
            ['user_id', '=', $scoreDetails->get('user_id')]
        ])->first();

        return $score;
    }

    public function updateScore($id, $scoreRaw)
    {
        $score = Score::find($id);
        $score->score = $scoreRaw;
        $score->save();
    }

    public function fetchParticipantScore($participantId, $userId)
    {
        return Score::where([['participant_id', '=', $participantId], ['user_id', '=', $userId]])->get();
    }

    public function getTotalPercentage($eventId)
    {
        $result = DB::select("SELECT p.*, a.participant_id, a.criteria_id, a.score, a.event_id, b.criteria, b.percentage, ROUND((SUM(score) * b.percentage / 100) / COUNT(user_no.user_no),2) percent_score, p.total_percent_score  FROM scores a 
        JOIN criterias b ON a.criteria_id = b.id
        LEFT JOIN ( SELECT COUNT(id)user_no, user_id FROM scores WHERE event_id = 1 GROUP BY user_id ) user_no ON user_no.user_id = a.user_id
        LEFT JOIN (
            SELECT ROUND(SUM(p.percent_score),2)total_percent_score, p.participant_id FROM
            (SELECT a.participant_id, (SUM(score) * b.percentage / 100) / COUNT(user_no.user_no) percent_score FROM scores a 
            JOIN criterias b ON a.criteria_id = b.id
            LEFT JOIN ( SELECT COUNT(id)user_no, user_id FROM scores WHERE event_id = 1 GROUP BY user_id ) user_no ON user_no.user_id = a.user_id
            WHERE a.event_id = '$eventId'
            GROUP BY a.participant_id, criteria_id) p GROUP BY p.participant_id
        ) p ON a.participant_id = p.participant_id
        LEFT JOIN participants p ON p.id = a.`participant_id`
        WHERE a.event_id = '$eventId'
        GROUP BY a.criteria_id, a.participant_id
        ORDER BY  p.total_percent_score DESC, a.criteria_id");

        return $result;
    }
}
