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
        'department_id',
        'bio',
        'responsibilities',
        'authorities',
        'image',
        'email',
        'linkedin',
        'sort_order',
    ];

    protected $appends = ['image_url'];

    public function departmentModel()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function getImageUrlAttribute(): string
    {
        if (!$this->image) return '';
        return str_starts_with($this->image, 'http') ? $this->image : asset('storage/' . $this->image);
    }
}
