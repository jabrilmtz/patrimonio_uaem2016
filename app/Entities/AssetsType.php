<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class AssetsType extends Model
{
    protected $table = 'assets_types';
    protected $fillable = [
        'id',
        'name',
        'percentage',
        'useful_life'
    ];
}
