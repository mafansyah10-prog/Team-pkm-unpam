<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'company',
        'position',
        'avatar',
        'content',
        'rating',
        'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'rating' => 'integer',
    ];
}
