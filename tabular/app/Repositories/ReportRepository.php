<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IReport;
use App\Models\User;

use DB;

class ReportRepository implements IReport
{
    public function getScores($eventId)
    {
        $qry = DB::select("select  a.criteria_id, b.criteria,total.total_score, sum(a.score),((cast(b.percentage as float) / 100) * cast(sum(a.score)as float)) percent_score, a.participant_id
        from scores a
        join criterias b on a.criteria_id = b.id
        left join (select ROUND(sum(a.percent_score),2)total_score, a.participant_id from
            (select (cast(b.percentage as float) / 100) * cast(sum(a.score)as float) percent_score, a.participant_id
            from scores a
            join criterias b on a.criteria_id = b.id
            where a.event_id = '$eventId'
            group by a.participant_id, b.percentage) a
            group by a.participant_id
        ) total on a.participant_id = total.participant_id
        where a.event_id = 1
        group by a.criteria_id, b.criteria, a.participant_id, b.percentage, total.total_score
        order by total.total_score desc;");

        return $qry;
    }

    public function getAllScores($eventId)
    {
        $qry = DB::select("select * from participants a
        left join (
            select ROUND(sum(a.percent_score),2)total_score, a.participant_id from
            (select (cast(b.percentage as float) / 100) * cast(sum(a.score)as float) percent_score, a.participant_id
            from scores a
            join criterias b on a.criteria_id = b.id
            where a.event_id = '$eventId'
            group by a.participant_id, b.percentage) a
            group by a.participant_id
        ) b on a.id = b.participant_id
        where a.event_id = '$eventId' 
        order by b.total_score desc;");

        return $qry;
    }

    public function getScoringJudge($eventId)
    {
        $qry = DB::select("SELECT a.id, a.`criteria_id`, a.`user_id`, a.`participant_id`, a.`score`, b.`number`, b.`screen_name`, b.`full_name`, b.gender, 
                c.`criteria`, c.`percentage`, d.`full_name` judge_full_name, d.`screen_name` judge_screen_name,
                ROUND((SUM(score) * c.percentage / 100), 2) percent_score
                FROM scores a
                JOIN participants b ON a.`participant_id` = b.`id`
                JOIN criterias c ON a.`criteria_id` = c.`id`
                JOIN users d ON a.`user_id` = d.`id`
                WHERE a.`event_id` = '$eventId'
                GROUP BY a.user_id, a.participant_id,a.`criteria_id`
                ORDER BY a.user_id, a.participant_id;");

        // $qry = collect($data)->groupBy(['participant_id', 'name'])
        //     ->map(function ($grouped) {
        //         $subjects = $grouped->map(function ($item) {
        //             return [
        //                 'subject' => $item['subject'],
        //                 'score' => $item['score']
        //             ];
        //         });
        //         return [
        //             'student_id' => $grouped[0]['student_id'],
        //             'name' => $grouped[0]['name'],
        //             'subjects' => $subjects->toArray()
        //         ];
        //     })
        //     ->values()
        //     ->toArray();

        return $qry;
    }

    public function individualJudgeScoring($eventId, $userId, $gender)
    {
        $data = DB::select("SELECT a.`sub_event_id`,a.sub_criteria_id, a.`participant_id`,a.`user_id`, a.event_id, b.`full_name`, b.`number`, c.`criteria`, c.`percentage` sub_criteria_percent, d.`sub_event_name`, d.`percentage` sub_event_percent
        , ((CAST(c.percentage AS FLOAT) / 100) * a.score) criteria_score, total.sub_event_total_score
        FROM sub_event_scores a
        JOIN participants b ON a.participant_id = b.id
        JOIN sub_event_criterias c ON c.id = a.sub_criteria_id
        JOIN `sub_events` d ON d.id = a.sub_event_id
        JOIN users e ON a.user_id = e.id 
        LEFT JOIN (
                            SELECT a.participant_id, a.`sub_criteria_id`, a.sub_event_id,
                            ROUND(SUM((CAST(c.percentage AS FLOAT) / 100) * a.score),2) sub_event_total_score
                            FROM sub_event_scores a
                            JOIN sub_event_criterias c ON c.id = a.sub_criteria_id
                            JOIN users e ON a.user_id = e.id 
                            WHERE a.user_id = '$userId' AND a.event_id = '$eventId'
                            GROUP BY a.participant_id, a.sub_event_id 
                            ORDER BY a.participant_id, a.`sub_criteria_id` 
                            
        ) total ON total.participant_id = a.participant_id AND a.sub_event_id = total.sub_event_id
        
        WHERE a.user_id = '$userId' AND a.event_id = '$eventId' AND b.gender = '$gender'
        GROUP BY a.`participant_id`, a.`sub_criteria_id`
        ORDER BY total.sub_event_total_score DESC;");

        /* $result = collect($data)->groupBy(['participant_id'])
            ->map(function ($grouped) {
                $scores = $grouped->map(function ($item) {
                    return [
                        'sub_event_id' => $item->sub_event_id,
                        'sub_criteria_id' => $item->sub_criteria_id,
                        'criteria' => $item->criteria,
                        'criteria_score' => $item->criteria_score
                    ];
                });
                return [
                    'number' => $grouped[0]->number,
                    'participant_id' => $grouped[0]->participant_id,
                    'participant_name' => $grouped[0]->full_name,
                    'total_score' => $grouped[0]->sub_event_total_score,
                    'sub_event_name' =>$grouped[0]->sub_event_name,
                    'scores' => $scores->toArray()
                ];
            })
            ->values()
            ->toArray();
        return $data; */

        $result = array_reduce($data, function ($acc, $item) {
            $subEventId = $item->sub_event_id;
            $participantId = $item->participant_id;
            $subCriteriaId = $item->sub_criteria_id;

            // create sub-event group if not exist
            if (!isset($acc[$subEventId])) {
                $acc[$subEventId] = [
                    'sub_event_id' => $subEventId,
                    'user_id' => $item->user_id,
                    'sub_event_name' => $item->sub_event_name,
                    'sub_event_percent' => $item->sub_event_percent,
                    // 'sub_event_total_score' => $item->sub_event_total_score,
                    'participants' => [],
                ];
            }

            // get sub-event group
            $subEventGroup = &$acc[$subEventId];

            // create participant group if not exist
            $participantKey = array_search($participantId, array_column($subEventGroup['participants'], 'participant_id'));
            if ($participantKey === false) {
                $participantKey = count($subEventGroup['participants']);
                $subEventGroup['participants'][$participantKey] = [
                    'participant_id' => $participantId,
                    'full_name' => $item->full_name,
                    'number' => $item->number,
                    'sub_event_total_score' => $item->sub_event_total_score,
                    'scores' => [],
                ];
            }

            // get participant group
            $participantGroup = &$subEventGroup['participants'][$participantKey];

            // create score group if not exist
            $scoreKey = array_search($subCriteriaId, array_column($participantGroup['scores'], 'sub_criteria_id'));
            if ($scoreKey === false) {
                $scoreKey = count($participantGroup['scores']);
                $participantGroup['scores'][$scoreKey] = [
                    'sub_criteria_id' => $subCriteriaId,
                    'criteria' => $item->criteria,
                    'criteria_score' => $item->criteria_score,
                    'sub_criteria_percent' => $item->sub_criteria_percent,
                ];
            }

            return $acc;
        }, []);

        // convert associative array to indexed array
        $result = array_values($result);
        foreach ($result as &$subEventGroup) {
            $subEventGroup['participants'] = array_values($subEventGroup['participants']);
            foreach ($subEventGroup['participants'] as &$participantGroup) {
                $participantGroup['scores'] = array_values($participantGroup['scores']);
            }
        }

        return $result;
    }

    public function fetchEventUser($eventId)
    {
        return User::with('role')->where('event_id', $eventId)->where('role_id', '!=', 2)->orderBy('full_name')->get();
    }

    public function scoreSummary($eventId, $gender)
    {
        $data = DB::select("select a.*, c.number, c.full_name participant_name,
        sum((cast(b.percentage as float) / 100 * a.score)) percent_score, d.overall_score
        from scores a
        join criterias b on a.criteria_id = b.id
        join participants c on a.participant_id = c.id
        left join (
            select a.participant_id,
            Round(sum((cast(b.percentage as float) / 100 * a.score)) / (select count(id) from users where event_id = '$eventId' and role_id != 2), 2) overall_score
            from scores a
            join criterias b on a.criteria_id = b.id
            join participants c on a.participant_id = c.id
            where a.event_id = '$eventId'
            GROUP BY participant_id
        ) d on a.participant_id = d.participant_id
        where a.event_id = '$eventId' and c.gender = '$gender'
        GROUP BY participant_id, a.user_id
        ORDER BY d.overall_score desc, a.participant_id;");

        $result = collect($data)->groupBy(['participant_id'])
            ->map(function ($grouped) {
                $scores = $grouped->map(function ($item) {
                    return [
                        'user_id' => $item->user_id,
                        'score' => $item->percent_score
                    ];
                });
                return [
                    'participant_id' => $grouped[0]->participant_id,
                    'number' => $grouped[0]->number,
                    'participant_name' => $grouped[0]->participant_name,
                    'overall_score' => $grouped[0]->overall_score,
                    'scores' => $scores->toArray()
                ];
            })
            ->values()
            ->toArray();

        // Sort the data by score in descending order
        usort($result, function ($a, $b) {
            return $b['overall_score'] - $a['overall_score'];
        });

        $rank = 0;
        $lastScore = null;

        foreach ($result as &$item) {
            if ($item['overall_score'] !== $lastScore) {
                $rank = $item['rank'] = $rank + 1;
            } else {
                $item['rank'] = $rank;
            }
            $lastScore = $item['overall_score'];
        }

        return $result;
    }

    public function scoreSummary2($eventId, $gender)
    {
        $finalScore = DB::select("SELECT par.participant_id, SUM(par.criteria_score) over_all_total FROM 
                (
                    SELECT a.`sub_event_id`, a.`participant_id`,a.`user_id`, a.event_id, b.`full_name`, b.`number`, c.`criteria`, c.`percentage` sub_criteria_percent, d.`sub_event_name`, d.`percentage` sub_event_percent
                    , ((CAST(d.percentage AS FLOAT) / 100) * a.score) criteria_score
                    FROM sub_event_scores a
                    JOIN participants b ON a.participant_id = b.id
                    JOIN sub_event_criterias c ON c.id = a.sub_criteria_id
                    JOIN `sub_events` d ON d.id = a.sub_event_id
                    JOIN users e ON a.user_id = e.id
                    WHERE a.event_id = '$eventId' AND b.gender = '$gender'
                    GROUP BY a.`participant_id`, a.`sub_event_id`
                ) par GROUP BY par.`participant_id`
                ORDER BY par.criteria_score DESC;");

        $byParticipants = DB::select("
                    SELECT a.`sub_event_id`, a.`participant_id`,a.`user_id`, a.event_id, b.`full_name`, b.`number`, c.`criteria`, c.`percentage` sub_criteria_percent, d.`sub_event_name`, d.`percentage` sub_event_percent
                , ((CAST(d.percentage AS FLOAT) / 100) * a.score) criteria_score
                FROM sub_event_scores a
                JOIN participants b ON a.participant_id = b.id
                JOIN sub_event_criterias c ON c.id = a.sub_criteria_id
                JOIN `sub_events` d ON d.id = a.sub_event_id
                JOIN users e ON a.user_id = e.id
                WHERE a.event_id = '$eventId' AND b.gender = '$gender'
                GROUP BY a.`participant_id`, a.`sub_event_id`;");


        $participants = collect($byParticipants)->groupBy(['participant_id'])
            ->map(function ($grouped) {
                $scores = $grouped->map(function ($item) {
                    return [
                        'sub_event_id' => $item->sub_event_id,
                        'sub_event_name' => $item->sub_event_name,
                        'sub_event_score' => $item->criteria_score
                    ];
                });
                return [
                    'participant_id' => $grouped[0]->participant_id,
                    'number' => $grouped[0]->number,
                    'participant_name' => $grouped[0]->full_name,
                    // 'overall_score' => $grouped[0]->overall_score,
                    'scores' => $scores->toArray()
                ];
            })
            ->values()
            ->toArray();


        foreach ($participants as &$participant) {
            foreach ($finalScore as $score) {
                if ($score->participant_id === $participant['participant_id']) {
                    $participant['over_all_total'] = $score->over_all_total;
                    break;
                }
            }
        }

        unset($participant);

        $rank = 0;
        $lastScore = null;

        foreach ($participants as &$item) {
            if ($item['over_all_total'] !== $lastScore) {
                $rank = $item['rank'] = $rank + 1;
            } else {
                $item['rank'] = $rank;
            }
            $lastScore = $item['over_all_total'];
        }

        // return $result;

        return $participants;
    }
}
