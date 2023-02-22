<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Criteria;
use App\Models\User;
use App\Models\Participant;
use App\Models\Score;

class Event extends Model
{
    use HasFactory;
    protected $fillable = ['event_name', 'date', 'is_active'];

    public function criterias()
    {
        return $this->hasMany(Criteria::class, 'event_id', 'id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'event_id', 'id');
    }

    public function participants()
    {
        return $this->hasMany(Participant::class, 'event_id', 'id');
    }

    public function scores()
    {
        return $this->hasMany(Score::class, 'event_id', 'id');
    }
}
