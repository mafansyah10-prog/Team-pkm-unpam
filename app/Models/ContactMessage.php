<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'subject',
        'service_type',
        'message',
        'is_read',
        'status',
        'resolution_notes',
        'resolved_at',
        'handled_by',
        'deleted_reason',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'resolved_at' => 'datetime',
        'deleted_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeResolved($query)
    {
        return $query->where('status', 'resolved');
    }

    public function scopeArchived($query)
    {
        return $query->where('status', 'deleted');
    }

    public function scopeStatusDeleted($query)
    {
        return $query->where('status', 'deleted');
    }

    public function scopeHistory($query)
    {
        return $query->whereIn('status', ['resolved', 'deleted']);
    }

    /**
     * Waktu selesai penanganan dalam format lengkap Indonesia
     */
    public function getFormattedResolvedAtAttribute(): string
    {
        if (!$this->resolved_at) return '-';
        $wib = $this->resolved_at->timezone('Asia/Jakarta')->locale('id');
        return $wib->translatedFormat('l, d F Y') . ' - Pukul ' . $wib->format('H:i') . ' WIB';
    }

    /**
     * Waktu penghapusan/pemindahan ke riwayat dalam format lengkap Indonesia
     */
    public function getFormattedDeletedAtAttribute(): string
    {
        if (!$this->deleted_at) return '-';
        $wib = $this->deleted_at->timezone('Asia/Jakarta')->locale('id');
        return $wib->translatedFormat('l, d F Y') . ' - Pukul ' . $wib->format('H:i') . ' WIB';
    }

    /**
     * Nama hari dalam bahasa Indonesia (e.g. "Senin", "Selasa", dll)
     */
    public function getFormattedDayAttribute(): string
    {
        return $this->created_at ? $this->created_at->timezone('Asia/Jakarta')->locale('id')->translatedFormat('l') : '-';
    }

    /**
     * Tanggal lengkap format Indonesia (e.g. "19 Oktober 2026")
     */
    public function getFormattedDateAttribute(): string
    {
        return $this->created_at ? $this->created_at->timezone('Asia/Jakarta')->locale('id')->translatedFormat('d F Y') : '-';
    }

    /**
     * Waktu jam:menit WIB (e.g. "21:05 WIB")
     */
    public function getFormattedTimeAttribute(): string
    {
        return $this->created_at ? $this->created_at->timezone('Asia/Jakarta')->format('H:i') . ' WIB' : '-';
    }

    /**
     * Waktu presisi jam:menit:detik WIB secara real-time (e.g. "21:05:45 WIB")
     */
    public function getFormattedTimeSecondsAttribute(): string
    {
        return $this->created_at ? $this->created_at->timezone('Asia/Jakarta')->format('H:i:s') . ' WIB' : '-';
    }

    /**
     * Format gabungan Hari, Tanggal, dan Jam Pengiriman Real
     * Contoh: "Senin, 19 Oktober 2026 - Pukul 21:05:45 WIB"
     */
    public function getFullDateTimeAttribute(): string
    {
        if (!$this->created_at) return '-';
        $wib = $this->created_at->timezone('Asia/Jakarta')->locale('id');
        return $wib->translatedFormat('l, d F Y') . ' - Pukul ' . $wib->format('H:i:s') . ' WIB';
    }

    /**
     * Waktu relatif Indonesia (e.g. "Baru saja", "5 menit yang lalu")
     */
    public function getTimeAgoAttribute(): string
    {
        return $this->created_at ? $this->created_at->timezone('Asia/Jakarta')->locale('id')->diffForHumans() : '';
    }
}
