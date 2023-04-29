<?php

namespace App\Repositories\Interfaces;

interface ICriteria
{
    public function fetchEventCriteria($eventId);

    public function createCriteria($criteriaDetails);

    public function updateCriteria($criteriaDetails, $id);

    public function removeCriteria($id);
}