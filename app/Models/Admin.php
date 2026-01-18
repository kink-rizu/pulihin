<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admins';
    protected $primaryKey = 'id_admin';
    
    protected $fillable = [
        'nama_admin',
        'username',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    // Relasi ke Laporan
    public function laporans()
    {
        return $this->hasMany(Laporan::class, 'id_admin', 'id_admin');
    }
}
