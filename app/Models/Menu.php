<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'category',
        'is_available'
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'price' => 'integer'
    ];
}
