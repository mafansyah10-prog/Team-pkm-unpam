<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
        'is_featured'    => 'boolean',
    ];

    public function getImageUrlAttribute(): string
    {
        if (!$this->image) return '';
        return str_starts_with($this->image, 'http') ? $this->image : Storage::url($this->image);
    }
}
