<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IAnnouncement;
use App\Models\Announcement;

class AnnouncementRepository implements IAnnouncement
{
    public function index()
    {
        return Announcement::all();
    }
    public function store($announcementDetails)
    {
        $announcement = new Announcement([
            'title' => $announcementDetails->get('title'),
            'details' => $announcementDetails->get('details'),
            'is_active' => true// $announcementDetails->get('is_active'),
        ]);

        $announcement->save();
    }
    public function update($announcementDetails, $id)
    {
        $announcement = Announcement::find($id);

        $announcement->title = $announcementDetails->get('title');
        $announcement->details = $announcementDetails->get('details');
        $announcement->is_active = $announcementDetails->get('is_active');

        $announcement->save();
    }

    public function destroy($id)
    {
        $announcement = Announcement::find($id);
        $announcement->delete();
    }
}