<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\RoleEnum;
use App\Models\User;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['role'];
    
    public function users()
    {
        return $this->hasMany(User::class, 'role_id','id');
    }
}
