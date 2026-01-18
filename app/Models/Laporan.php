<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporans';
    protected $primaryKey = 'id_laporan';
    
    protected $fillable = [
        'jenis_laporan',
        'periode',
        'tanggal_cetak',
        'id_admin',
        'file_laporan',
    ];

    protected $casts = [
        'tanggal_cetak' => 'date',
    ];

    // Relasi ke Admin
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }

    // Scope untuk laporan donasi
    public function scopeDonasi($query)
    {
        return $query->where('jenis_laporan', 'donasi');
    }

    // Scope untuk laporan penyaluran
    public function scopePenyaluran($query)
    {
        return $query->where('jenis_laporan', 'penyaluran');
    }

    // Scope untuk laporan keuangan
    public function scopeKeuangan($query)
    {
        return $query->where('jenis_laporan', 'keuangan');
    }
}
