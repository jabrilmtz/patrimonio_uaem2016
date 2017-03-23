<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'units';
    protected $fillable = [
        'id',
        'code',
        'name',
        'location',
        'employee_id'
    ];
}
