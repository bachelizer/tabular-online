<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ICriteria;
use App\Models\Criteria;

class CriteriaRepository implements ICriteria
{
    public function createCriteria($criteriaDetails)
    {
        $criteria = new Criteria([
            'event_id' => $criteriaDetails->get('event_id'),
            'criteria' => $criteriaDetails->get('criteria'),
            'percentage' => $criteriaDetails->get('percentage')
        ]);

        $criteria->save();
    }

    public function updateCriteria($criteriaDetails, $id)
    {
        $criteria = Criteria::find($id);

        $criteria->criteria = $criteriaDetails->get('criteria');
        $criteria->percentage = $criteriaDetails->get('percentage');

        $criteria->save();
    }

    public function removeCriteria($criteria)
    {
        $criteria->delete();
    }
}