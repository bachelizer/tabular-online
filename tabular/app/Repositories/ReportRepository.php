<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IReport;

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

        return $qry;
    }
}
