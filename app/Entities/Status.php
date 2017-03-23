<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'statuses';
    protected $fillable = [
        'id',
        'name'
    ];
}
