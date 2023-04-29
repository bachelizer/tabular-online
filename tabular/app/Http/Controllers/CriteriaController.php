<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\ICriteria;

class CriteriaController extends Controller
{
    //
    private ICriteria $criteriaRepository;

    public function __construct(ICriteria $criteriaRepository)
    {
        $this->criteriaRepository = $criteriaRepository;
    }

    public function fetchEventCriteria($eventId)
    {
        return $this->criteriaRepository->fetchEventCriteria($eventId);
    }

    public function store(Request $request)
    {
        $this->criteriaRepository->createCriteria($request);
        return response()->json([
            'status' => true,
            'message' => "Successfully Added",
        ], 200);

    }

    public function update(Request $request, $id)
    {
        $this->criteriaRepository->updateCriteria($request, $id);
        // return $request;
    }

    public function destroy($id)
    {
        $this->criteriaRepository->removeCriteria($id);
    }
}
