<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\IParticipant;
class ParticipantController extends Controller
{
    //
    private IParticipant $participantRepository;

    public function __construct(IParticipant $participantRepository)
    {
        $this->participantRepository = $participantRepository;
    }

    public function store(Request $request)
    {
        $participant = $this->participantRepository->createParticipant($request);
        return response()->json([
            'status' =>  true ,
            'message' =>"Successfully Added" ,
        ],  200 );
    }

    public function show($id)
    {
        return $this->participantRepository->getParticipant($id);
    }

    public function update(Request $request, $id)
    {
        $this->participantRepository->updateParticipant($request, $id);
    }

    public function destroy($id)
    {
        $this->participantRepository->removeParticipant($id);
    }
}
