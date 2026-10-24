<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'leader_name',
        'leader_title',
        'slug',
        'is_executive',
        'sort_order',
        'color',
    ];

    protected $casts = [
        'is_executive' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected $appends = [
        'header_style',
    ];

    public function members()
    {
        return $this->hasMany(TeamMember::class, 'department_id')->orderBy('sort_order');
    }

    public function getManagerAttribute()
    {
        if (!empty($this->leader_name)) {
            $matched = $this->members->first(function ($m) {
                return strtolower(trim($m->name)) === strtolower(trim($this->leader_name));
            });
            if ($matched) {
                return $matched;
            }
        }

        return $this->members->first(function ($m) {
            $pos = strtolower($m->position);
            return str_contains($pos, 'manager') || str_contains($pos, 'pimpinan') || str_contains($pos, 'head') || str_contains($pos, 'lead') || str_contains($pos, 'direktur');
        });
    }

    public function getStaffAttribute()
    {
        $manager = $this->manager;
        return $this->members->filter(function ($m) use ($manager) {
            return !$manager || $m->id !== $manager->id;
        });
    }

    /**
     * Resolves display styling based on the selected color (supports all colors)
     */
    public function getHeaderStyleAttribute(): array
    {
        $raw = trim($this->color ?? '#b91c1c');

        // Map any legacy named colors to hex
        $colorMap = [
            'red'      => '#b91c1c',
            'navy'     => '#1e293b',
            'slate'    => '#1e293b',
            'blue'     => '#1d4ed8',
            'sky'      => '#0284c7',
            'emerald'  => '#047857',
            'green'    => '#047857',
            'amber'    => '#d97706',
            'orange'   => '#ea580c',
            'purple'   => '#7c3aed',
            'pink'     => '#e11d48',
            'black'    => '#0f172a',
            'dark'     => '#0f172a',
        ];

        $lower = strtolower($raw);
        $hex = $colorMap[$lower] ?? (str_starts_with($raw, '#') ? $raw : '#' . ltrim($raw, '#'));

        if (!preg_match('/^#[a-f0-9]{3,8}$/i', $hex)) {
            $hex = '#b91c1c';
        }

        return [
            'hex'     => $hex,
            'style'   => "background-color: {$hex} !important; color: #ffffff !important;",
            'badge'   => "background-color: {$hex}15; color: {$hex}; border-color: {$hex}40;",
            'dot'     => $hex,
            'name'    => strtoupper($hex),
        ];
    }
}
