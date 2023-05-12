<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* use App\Models\Criteria;
use App\Models\User;
use App\Models\Participant; */
use App\Models\SubEventCriteria;

class SubEvent extends Model
{
    use HasFactory;
    protected $fillable = ['event_id', 'sub_event_name', 'percentage'];

    public function criterias()
    {
        return $this->hasMany(SubEventCriteria::class, 'sub_event_id', 'id');
    }

   /*  public function criterias()
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
    }*/
}
