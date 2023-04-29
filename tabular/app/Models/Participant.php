<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Score;

class Participant extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['screen_name', 'full_name','gender', 'number', 'event_id'];

    public function scores()
    {
        return $this->hasMany(Score::class, 'participant_id', 'id');
    }
}
