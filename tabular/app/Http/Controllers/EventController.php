<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\IEvent;

class EventController extends Controller
{
    //
    private IEvent $eventRepository;

    public function __construct(IEvent $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function index()
    {
        return $this->eventRepository->fetchEvents();
    }

    public function store(Request $request)
    {
        $store = $this->eventRepository->createEvent($request);
        return response()->json([
            'status' => $store ? true : false,
            'message' => $store ? "Successfully Added" : "ERROR",
        ], $store ? 200 : 500);
    }

    public function update(Request $request, $id)
    {
        $this->eventRepository->updateEvent($request, $id);
    }

    public function show($id)
    {
        $event = $this->eventRepository->showEvent($id);
        return response()->json($event);
    }
}
