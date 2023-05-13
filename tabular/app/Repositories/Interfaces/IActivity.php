<?php

namespace App\Repositories\Interfaces;

interface IActivity
{
    public function index();
    public function update($activityDetails, $id);
    public function destroy($id);
}