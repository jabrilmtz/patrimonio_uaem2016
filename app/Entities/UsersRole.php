<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class UsersRole extends Model
{
    protected $table = 'users_roles';
    protected $fillable = [
        'id',
        'phone',
        'role_id',
        'user_id'
    ];
}
