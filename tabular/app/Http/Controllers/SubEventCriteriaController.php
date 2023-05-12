<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\ISubEventCriteria;

class SubEventCriteriaController extends Controller
{
    //
    private ISubEventCriteria $subCriteria;

    public function __construct(ISubEventCriteria $subCriteria)
    {
        $this->subCriteria = $subCriteria;
    }

    public function fetch($subEventId)
    {
        return $this->subCriteria->fetchSubEventCriteria($subEventId);
    }

    public function store(Request $request)
    {
        $this->subCriteria->createSubCriteria($request);
        return response()->json([
            'status' => true,
            'message' => "Successfully Added",
        ], 200);

    }

    public function update(Request $request, $id)
    {
        $this->subCriteria->updateSubCriteria($request, $id);
        // return $request;
    }

    public function destroy($id)
    {
        $this->subCriteria->removeSubCriteria($id);
    }
}
