<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubEventScore extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['event_id', 'sub_event_id', 'participant_id', 'sub_criteria_id', 'score', 'user_id'];
}
