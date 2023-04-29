<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\IScore;

class ScoreController extends Controller
{
    //
    private IScore $scoreRepository;

    public function __construct(IScore $scoreRepository)
    {
        $this->scoreRepository = $scoreRepository;
    }

    public function store(Request $request)
    {
        $exist = $this->scoreRepository->existingScore($request);

        $exist != null ?  $this->scoreRepository->updateScore($exist->id, $request->score) :  $this->scoreRepository->createScore($request);
        return response()->json([
            'status' => true,
            'message' => "Successfully Added",
        ], 200);
    }

    public function show($participantId, $userId)
    {
        return $this->scoreRepository->fetchParticipantScore($participantId, $userId);
    }

    public function getTotalPercentage($eventId)
    {
        return $this->scoreRepository->getTotalPercentage($eventId);
    }
}
