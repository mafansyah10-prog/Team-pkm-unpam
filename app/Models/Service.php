<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'icon',
        'short_description',
        'description',
        'image',
        'features',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'features' => 'array',
        'is_featured' => 'boolean',
    ];
}
