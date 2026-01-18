<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    protected $table = 'donasis';
    protected $primaryKey = 'id_donasi';
    
    protected $fillable = [
        'id_donatur',
        'id_program',
        'tanggal_donasi',
        'jenis_donasi',
        'jumlah_donasi',
        'bukti_transfer',
        'status_pembayaran',
    ];

    protected $casts = [
        'tanggal_donasi' => 'date',
        'jumlah_donasi' => 'decimal:2',
    ];

    // Relasi ke Donatur
    public function donatur()
    {
        return $this->belongsTo(Donatur::class, 'id_donatur', 'id_donatur');
    }

    // Relasi ke Program Bantuan
    public function programBantuan()
    {
        return $this->belongsTo(ProgramBantuan::class, 'id_program', 'id_program');
    }

    // Scope untuk donasi berhasil
    public function scopeBerhasil($query)
    {
        return $query->where('status_pembayaran', 'berhasil');
    }

    // Scope untuk donasi pending
    public function scopePending($query)
    {
        return $query->where('status_pembayaran', 'pending');
    }

    // Scope untuk donasi gagal
    public function scopeGagal($query)
    {
        return $query->where('status_pembayaran', 'gagal');
    }

    // Event ketika status berubah menjadi berhasil
    protected static function booted()
    {
        static::updated(function ($donasi) {
            if ($donasi->isDirty('status_pembayaran') && $donasi->status_pembayaran === 'berhasil') {
                // Update dana terkumpul di program
                $donasi->programBantuan->updateDanaTerkumpul();
            }
        });

        static::created(function ($donasi) {
            if ($donasi->status_pembayaran === 'berhasil') {
                $donasi->programBantuan->updateDanaTerkumpul();
            }
        });
    }
}
