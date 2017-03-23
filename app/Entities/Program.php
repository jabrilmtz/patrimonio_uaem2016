<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'programs';
    protected $fillable = [
        'id',
        'name',
        'branch',
        'modality',
        'description'
    ];
}
