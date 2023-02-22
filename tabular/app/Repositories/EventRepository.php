<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IEvent;
use App\Models\Event;

class EventRepository implements IEvent
{
    public function fetchEvents()
    {
        return Event::all();
    }

    public function createEvent($eventDetails)
    {
        try{
            $event = new Event([
                'event_name' => $eventDetails->get('event_name'),
                'date' => $eventDetails->get('date')
            ]);

            $event->save();

            return true;
        }
        catch(Exception $e) {
            return false;
        }

    }

    public function updateEvent($eventDetails, $id)
    {
        $event = Event::find($id);

        $event->event_name = $eventDetails->get('event_name');
        $event->date = $eventDetails->get('date');
        $event->is_active = $eventDetails->get('is_active');
        $event->save();
    }

    public function showEvent($id)
    {
        // $event = Event::with('criterias', 'users', 'participants')->where('id', $id)->get();
        $event = Event::find($id);
        $event->criterias;
        $event->users;
        $event->participants;
        return $event;
    }
}