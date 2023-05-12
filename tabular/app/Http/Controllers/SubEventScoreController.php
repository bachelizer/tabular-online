<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\ISubScore;

class SubEventScoreController extends Controller
{
    //
    private ISubScore $subScore;

    public function __construct(ISubScore $subScore)
    {
        $this->subScore = $subScore;
    }

    public function store(Request $request)
    {
        $exist = $this->subScore->existingScore($request);

        $exist != null ?  $this->subScore->updateScore($exist->id, $request->score) :  $this->subScore->createScore($request);
        return response()->json([
            'status' => true,
            'message' => "Successfully Added",
        ], 200);
        // return $request;
    }

    public function show($participantId, $userId, $subEventId)
    {
        return $this->subScore->fetchParticipantScore($participantId, $userId, $subEventId);
    }

  /*   public function getTotalPercentage($eventId)
    {
        return $this->scoreRepository->getTotalPercentage($eventId);
    } */
}
