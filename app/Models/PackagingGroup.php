<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PackagingGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'icon',
        'desc',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(PackagingItem::class, 'group_id')->orderBy('sort_order');
    }

    public function activeItems(): HasMany
    {
        return $this->hasMany(PackagingItem::class, 'group_id')->where('is_active', true)->orderBy('sort_order');
    }
}
