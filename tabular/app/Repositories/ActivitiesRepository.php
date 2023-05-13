<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IActivity;
use App\Models\Activities;

class ActivitiesRepository implements IActivity
{
    public function index()
    {
        return Activities::all();
    }

    public function store($activityDetails)
    {
        $activity = new Activities([
            'title' => $activityDetails->get('title'),
            'description' => $activityDetails->get('description'),
            'date' => $activityDetails->get('date'),
            'is_active' => true // $activityDetails->get('is_active')
        ]);

        $activity->save();
    }

    public function update($activityDetails, $id)
    {
        $activity = Activities::find($id);

        $activity->title = $activityDetails->get('title');
        $activity->description = $activityDetails->get('description');
        $activity->date = $activityDetails->get('date');
        $activity->is_active = $activityDetails->get('is_active');

        $activity->save();
    }

    public function destroy($id)
    {
        $announcement = Activities::find($id);
        $announcement->delete();
    }
}