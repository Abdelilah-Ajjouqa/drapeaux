<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name',
        'region',
        'flag_url',
        'currency',
        'language',
        'capital',
    ];
}
