<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    protected $fillable = [
        'id',
        'name',
        'surname',
        'code',
        'email'
    ];
}
