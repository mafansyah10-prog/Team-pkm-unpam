<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'short_description',
        'description',
        'image',
        'specifications',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'specifications' => 'array',
        'is_featured' => 'boolean',
    ];
}
