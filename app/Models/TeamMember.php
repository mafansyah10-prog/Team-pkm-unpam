<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'department',
        'bio',
        'image',
        'email',
        'linkedin',
        'sort_order',
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute(): string
    {
        if (!$this->image) return '';
        return str_starts_with($this->image, 'http') ? $this->image : asset('storage/' . $this->image);
    }
}
