<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

    protected $appends = ['image_url'];

    public function getImageUrlAttribute(): string
    {
        if (!$this->image) return '';
        return str_starts_with($this->image, 'http') ? $this->image : asset('storage/' . $this->image);
    }
}
