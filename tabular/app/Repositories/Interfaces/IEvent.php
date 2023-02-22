<?php

namespace App\Repositories\Interfaces;

interface IEvent
{
    public function fetchEvents();

    public function createEvent($eventDetails);

    public function updateEvent($eventDetails, $id);

    public function showEvent($id);
}