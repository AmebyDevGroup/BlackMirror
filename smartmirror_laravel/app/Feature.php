<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'active',
        'icon',
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
