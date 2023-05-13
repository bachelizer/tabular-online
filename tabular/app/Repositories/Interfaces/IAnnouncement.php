<?php

namespace App\Repositories\Interfaces;

interface IAnnouncement
{
    public function index();
    public function update($announcementDetails, $id);
    public function destroy($id);
}