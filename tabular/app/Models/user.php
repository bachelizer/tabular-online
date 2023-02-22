<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\RoleEnum;

use App\Models\Role;

class user extends Model
{
    use HasFactory;
    protected $fillable = ['password', 'event_id', 'role_id', 'full_name', 'screen_name'];
    protected $casts = [
        'role_id' => RoleEnum::class
    ];

    public function role()
    {
        return $this->hasOne(Role::class, 'role_id', 'id');
    }
}
