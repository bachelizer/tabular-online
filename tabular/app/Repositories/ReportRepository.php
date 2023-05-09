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
        $data = DB::select("select a.*, b.number, b.full_name participant_name, concat(c.criteria,' / ', c.percentage, '%') criteria, e.full_name judge_name, e.screen_name, 
        ((cast(c.percentage as float) / 100) * a.score) percent_score, total.total_score
        from scores a
        join participants b on a.participant_id = b.id
        join criterias c on c.id = a.criteria_id
        join `events` d on d.id = a.event_id
        join users e on a.user_id = e.id 
        left join (
                    select a.participant_id,
                    sum((cast(c.percentage as float) / 100) * a.score) total_score
                    from scores a
                    join criterias c on c.id = a.criteria_id
                    join users e on a.user_id = e.id 
                    where a.user_id = '$userId' and a.event_id = '$eventId'
                        group by a.participant_id
                    order by a.participant_id
        ) total on total.participant_id = a.participant_id
        where a.user_id = '$userId' and a.event_id = '$eventId' and b.gender = '$gender'
        order by total.total_score desc;");

        $result = collect($data)->groupBy(['participant_id'])
            ->map(function ($grouped) {
                $scores = $grouped->map(function ($item) {
                    return [
                        'criteria_id' => $item->criteria_id,
                        'criteria' => $item->criteria,
                        'score' => $item->percent_score
                    ];
                });
                return [
                    'number' => $grouped[0]->number,
                    'participant_id' => $grouped[0]->participant_id,
                    'participant_name' => $grouped[0]->participant_name,
                    'total_score' => $grouped[0]->total_score,
                    'scores' => $scores->toArray()
                ];
            })
            ->values()
            ->toArray();
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
                $rank = $item['rank'] = $rank+1;
            } else {
                $item['rank'] = $rank;
            }
            $lastScore = $item['overall_score'];
        }

        return $result;
    }
}
