<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Binnacle extends Model
{
    protected $table = 'binnacles';
    protected $fillable = [
        'id',
        'asset_id',
        'year',
        'anual_depreciation',
        'accumulated_depreciation',
        'value'
    ];
}
