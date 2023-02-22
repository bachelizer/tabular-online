<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['participant_id', 'criteria_id', 'score', 'user_id', 'event_id'];
}
