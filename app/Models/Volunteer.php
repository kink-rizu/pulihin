<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Volunteer extends Authenticatable
{
    use Notifiable;

    protected $table = 'volunteers';
    protected $primaryKey = 'id_volunteer';
    
    protected $fillable = [
        'nama_volunteer',
        'alamat',
        'no_hp',
        'email',
        'password',
        'status',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    // Relasi ke Penyaluran
    public function penyalurans()
    {
        return $this->hasMany(Penyaluran::class, 'id_volunteer', 'id_volunteer');
    }

    // Get jumlah penyaluran yang ditangani
    public function getJumlahPenyaluranAttribute()
    {
        return $this->penyalurans()->count();
    }

    // Get total bantuan yang disalurkan
    public function getTotalBantuanDisalurkanAttribute()
    {
        return $this->penyalurans()->sum('jumlah_disalurkan');
    }

    // Scope untuk volunteer aktif
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }
}
