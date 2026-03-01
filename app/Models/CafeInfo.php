<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CafeInfo extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'opening_hours',
        'map_url',
    ];
}
