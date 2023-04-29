<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\RoleEnum;

use App\Models\Role;
use App\Models\Event;

class user extends Model
{
    use HasFactory;
    protected $fillable = ['password', 'event_id', 'role_id', 'full_name', 'screen_name'];
    protected $casts = [
        'role_id' => RoleEnum::class
    ];

    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function event()
    {
        return $this->hasOne(Event::class, 'id', 'event_id');
    }
}
