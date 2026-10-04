<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'client',
        'route',
        'cargo_type',
        'description',
        'image',
        'completion_date',
        'sort_order',
    ];

    protected $casts = [
        'completion_date' => 'date',
    ];
}
