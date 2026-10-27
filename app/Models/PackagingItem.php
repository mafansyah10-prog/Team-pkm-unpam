<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PackagingItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'code',
        'ceisa',
        'title',
        'desc',
        'example',
        'image',
        'tips',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active'   => 'boolean',
        'sort_order'  => 'integer',
    ];

    protected $appends = ['image_url', 'display_image'];

    public function group(): BelongsTo
    {
        return $this->belongsTo(PackagingGroup::class, 'group_id');
    }

    /**
     * Get image URL for admin & public views
     */
    public function getImageUrlAttribute(): string
    {
        if (!$this->image) {
            return asset('images/ctl-logo.svg');
        }

        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }

        if (str_starts_with($this->image, 'images/')) {
            return asset($this->image);
        }

        return asset('storage/' . $this->image);
    }

    /**
     * Path compatible with asset(...) in public packaging guide
     */
    public function getDisplayImageAttribute(): string
    {
        if (!$this->image) {
            return 'images/ctl-logo.svg';
        }

        if (str_starts_with($this->image, 'http') || str_starts_with($this->image, 'images/')) {
            return $this->image;
        }

        return 'storage/' . $this->image;
    }

    /**
     * Format into public catalog card structure
     */
    public function toCard(): array
    {
        return [
            'id'      => $this->id,
            'code'    => strtoupper($this->code),
            'ceisa'   => $this->ceisa,
            'title'   => $this->title,
            'desc'    => $this->desc,
            'example' => $this->example ?: '10 ' . strtoupper($this->code),
            'image'   => $this->display_image,
            'tips'    => $this->tips ?: '',
        ];
    }
}
