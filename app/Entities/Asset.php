<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $table = 'assets';
    protected $fillable = [
        'id',
        'asset_code',
        'name',
        'description',
        'serial_number',
        'model',
        'original_cost',
        'actual_cost',
        'image',
        'assign_date',
        'comment',
        'category',
        'brand_id',
        'program_id',
        'provider_id',
        'status_id',
        'unit_id',
        'user_id',
        'asset_type_id'
    ];

}
