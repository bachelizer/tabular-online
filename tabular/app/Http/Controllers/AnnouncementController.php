<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\IAnnouncement;

class AnnouncementController extends Controller
{
    //
    private IAnnouncement $announcement;

    public function __construct(IAnnouncement $announcement)
    {
        $this->announcement = $announcement;
    }

    public function index()
    {
        return $this->announcement->index();
    }

    public function store(Request $request)
    {
        $this->announcement->store($request);
        return response()->json([
            'status' => true,
            'message' => "Successfully Added",
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $this->announcement->update($request, $id);
    }
    public function destroy($id)
    {
        $this->announcement->destroy($id);
    }
}
