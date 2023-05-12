<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ISubEvent;
use App\Models\SubEvent;

use DB;

class SubEventRepository implements ISubEvent
{
    public function fetchSubEvents($eventId)
    {
        return SubEvent::with('criterias')->where('event_id', '=', $eventId)->get();
    }

    public function fetchEventCriteria($eventId)
    {
        $result = DB::select("select * from sub_event_criterias where event_id = '$eventId';");
        // return SubEvent::all();
        return $result;
    }

    public function createSubEvent($eventDetails)
    {
        try{
            $event = new SubEvent([
                'event_id' => $eventDetails->get('event_id'),
                'sub_event_name' => $eventDetails->get('sub_event_name'),
                'percentage' => $eventDetails->get('percentage'),
                // 'is_active' => $eventDetails->get('is_active')
            ]);

            $event->save();

            return true;
        }
        catch(Exception $e) {
            return false;
        }

    }

    public function updateSubEvent($eventDetails, $id)
    {
        $event = SubEvent::find($id);

        $event->sub_event_name = $eventDetails->get('sub_event_name');
        $event->percentage = $eventDetails->get('percentage');
        $event->save();
    }

    public function showSubEvent($id)
    {
        // $event = Event::with('criterias', 'users', 'participants')->where('id', $id)->get();
        $event = SubEvent::find($id);
        $event->criterias;
        // $event->users;
        // $event->participants;
        return $event;
    }
    public function showSubEvents($eventId)
    {
        return SubEvent::where('event_id', '=', $eventId)->get();
    }
}