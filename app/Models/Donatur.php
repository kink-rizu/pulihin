<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Donatur extends Authenticatable
{
    use Notifiable;

    protected $table = 'donaturs';
    protected $primaryKey = 'id_donatur';
    
    protected $fillable = [
        'nama_donatur',
        'alamat',
        'no_hp',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    // Relasi ke Donasi
    public function donasis()
    {
        return $this->hasMany(Donasi::class, 'id_donatur', 'id_donatur');
    }

    // Get total donasi donatur
    public function getTotalDonasiAttribute()
    {
        return $this->donasis()
            ->where('status_pembayaran', 'berhasil')
            ->sum('jumlah_donasi');
    }

    // Get jumlah donasi
    public function getJumlahDonasiAttribute()
    {
        return $this->donasis()
            ->where('status_pembayaran', 'berhasil')
            ->count();
    }
}
