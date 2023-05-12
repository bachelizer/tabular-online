<?php

namespace App\Repositories\Interfaces;

interface ISubEvent
{
    public function fetchSubEvents($eventId);
    public function createSubEvent($eventDetails);
    public function updateSubEvent($eventDetails, $id);
    public function showSubEvent($id);
    public function fetchEventCriteria($eventId);
}