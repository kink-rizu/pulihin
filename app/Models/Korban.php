<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Korban extends Authenticatable
{
    use Notifiable;

    protected $table = 'korbans';
    protected $primaryKey = 'id_korban';
    
    protected $fillable = [
        'nama_korban',
        'alamat',
        'email',
        'jenis_bencana',
        'keterangan',
        'no_hp',
        'password',
        'status_verifikasi',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    // Relasi ke Kebutuhan Korban (Fitur Tambahan)
    public function kebutuhanKorbans()
    {
        return $this->hasMany(KebutuhanKorban::class, 'id_korban', 'id_korban');
    }

    // Relasi ke Penyaluran
    public function penyalurans()
    {
        return $this->hasMany(Penyaluran::class, 'id_korban', 'id_korban');
    }

    // Get total bantuan yang diterima
    public function getTotalBantuanAttribute()
    {
        return $this->penyalurans()->sum('jumlah_disalurkan');
    }

    // Scope untuk korban yang terverifikasi
    public function scopeTerverifikasi($query)
    {
        return $query->where('status_verifikasi', 'terverifikasi');
    }

    // Scope untuk korban pending
    public function scopePending($query)
    {
        return $query->where('status_verifikasi', 'pending');
    }
}
