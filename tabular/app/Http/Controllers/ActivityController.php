<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\IActivity;

class ActivityController extends Controller
{
    //
    private IActivity $activity;

    public function __construct(IActivity $activity)
    {
        $this->activity = $activity;
    }

    public function index()
    {
        return $this->activity->index();
    }
    public function store(Request $request)
    {
        $this->activity->store($request);
        return response()->json([
            'status' => true,
            'message' => "Successfully Added",
        ], 200);
    }
    public function update(Request $request, $id)
    {
        $this->activity->update($request, $id);
    }
    public function destroy($id)
    {
        $this->activity->destroy($id);
    }
}
