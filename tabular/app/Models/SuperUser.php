<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;

class SuperUser extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['full_name', 'password', 'role_id'];

    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }
}
