<?php

namespace App\Repositories\Interfaces;

interface ISubEventCriteria
{
    public function fetchSubEventCriteria($subEventId);
    
    public function createSubCriteria($criteriaDetails);
    public function updateSubCriteria($criteriaDetails, $id);
    public function removeSubCriteria($id);
}