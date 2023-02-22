<?php

namespace App\Repositories\Interfaces;

interface ICriteria
{
    public function createCriteria($criteriaDetails);

    public function updateCriteria($criteriaDetails, $id);

    public function removeCriteria($criteria);
}