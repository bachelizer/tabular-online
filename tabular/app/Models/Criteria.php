<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Event;

class Criteria extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['event_id', 'criteria', 'percentage'];

    public function event()
    {
        return $this->hasOne(Event::class, 'id', 'event_id');
    }
}
