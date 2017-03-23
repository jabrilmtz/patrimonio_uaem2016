<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class IncidencesType extends Model
{
    protected $table = 'incidences_types';
    protected $fillable = [
        'id',
        'name'
    ];
}
