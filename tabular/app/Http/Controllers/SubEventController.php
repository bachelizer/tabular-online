<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\ISubEvent;

class SubEventController extends Controller
{
    //
    private ISubEvent $subEvent;

    public function __construct(ISubEvent $subEvent)
    {
        $this->subEvent = $subEvent;
    }

   /*  public function index()
    {
        return $this->eventRepository->fetchEvents();
    } */

    public function fetch($eventId)
    {
        return $this->subEvent->fetchSubEvents($eventId);
    }

    public function store(Request $request)
    {
        $store = $this->subEvent->createSubEvent($request);
        return response()->json([
            'status' => $store ? true : false,
            'message' => $store ? "Successfully Added" : "ERROR",
        ], $store ? 200 : 500);
        // return $request;
    }

    public function update($id, Request $request)
    {
        $this->subEvent->updateSubEvent($request, $id);
    }

    public function show($id)
    {
        $event = $this->subEvent->showSubEvent($id);
        return response()->json($event);
    }
}
