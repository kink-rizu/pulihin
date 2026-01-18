<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penyaluran extends Model
{
    protected $table = 'penyalurans';
    protected $primaryKey = 'id_penyaluran';
    
    protected $fillable = [
        'id_program',
        'id_korban',
        'id_volunteer',
        'tanggal_penyaluran',
        'jumlah_disalurkan',
        'keterangan',
        'foto_bukti',
    ];

    protected $casts = [
        'tanggal_penyaluran' => 'date',
        'jumlah_disalurkan' => 'decimal:2',
    ];

    // Relasi ke Program Bantuan
    public function programBantuan()
    {
        return $this->belongsTo(ProgramBantuan::class, 'id_program', 'id_program');
    }

    // Relasi ke Korban
    public function korban()
    {
        return $this->belongsTo(Korban::class, 'id_korban', 'id_korban');
    }

    // Relasi ke Volunteer
    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class, 'id_volunteer', 'id_volunteer');
    }

    // Scope untuk penyaluran hari ini
    public function scopeHariIni($query)
    {
        return $query->whereDate('tanggal_penyaluran', today());
    }

    // Scope untuk penyaluran bulan ini
    public function scopeBulanIni($query)
    {
        return $query->whereMonth('tanggal_penyaluran', now()->month)
                    ->whereYear('tanggal_penyaluran', now()->year);
    }
}
