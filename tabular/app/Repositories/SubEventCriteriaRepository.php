<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ISubEventCriteria;
use App\Models\SubEventCriteria;

class SubEventCriteriaRepository implements ISubEventCriteria
{
    public function fetchSubEventCriteria($subEventId)
    {
        return SubEventCriteria::where('sub_event_id', '=', $subEventId)->get();
    }

    public function createSubCriteria($criteriaDetails)
    {
        $criteria = new SubEventCriteria([
            'event_id' => $criteriaDetails->get('event_id'),
            'sub_event_id' => $criteriaDetails->get('sub_event_id'),
            'criteria' => $criteriaDetails->get('criteria'),
            'percentage' => $criteriaDetails->get('percentage')
        ]);

        $criteria->save();
    }

    public function updateSubCriteria($criteriaDetails, $id)
    {
        $criteria = SubEventCriteria::find($id);

        $criteria->criteria = $criteriaDetails->get('criteria');
        $criteria->percentage = $criteriaDetails->get('percentage');

        $criteria->save();
    }

    public function removeSubCriteria($id)
    {
        $criteria =  SubEventCriteria::find($id);
        $criteria->delete();
    }

  
}