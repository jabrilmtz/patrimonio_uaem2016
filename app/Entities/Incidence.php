<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class Incidence extends Model
{
    protected $table = 'incidences';
    protected $fillable = [
        'id',
        'image',
        'comment',
        'status',
        'incidence_type_id',
        'asset_id',
        'created_at',
        'updated_at'
    ];

    public function getCreatedAtAttribute($date)
    {
        return new Date($date);
    }
}
