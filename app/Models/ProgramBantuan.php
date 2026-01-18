<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramBantuan extends Model
{
    protected $table = 'program_bantuans';
    protected $primaryKey = 'id_program';
    
    protected $fillable = [
        'nama_program',
        'jenis_bantuan',
        'tanggal_mulai',
        'tanggal_selesai',
        'keterangan',
        'target_dana',
        'dana_terkumpul',
        'status',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'target_dana' => 'decimal:2',
        'dana_terkumpul' => 'decimal:2',
    ];

    // Relasi ke Donasi
    public function donasis()
    {
        return $this->hasMany(Donasi::class, 'id_program', 'id_program');
    }

    // Relasi ke Penyaluran
    public function penyalurans()
    {
        return $this->hasMany(Penyaluran::class, 'id_program', 'id_program');
    }

    // Get persentase dana terkumpul
    public function getPersentaseDanaTerkumpulAttribute()
    {
        if ($this->target_dana == 0) {
            return 0;
        }
        return ($this->dana_terkumpul / $this->target_dana) * 100;
    }

    // Get total dana dari donasi berhasil
    public function updateDanaTerkumpul()
    {
        $total = $this->donasis()
            ->where('status_pembayaran', 'berhasil')
            ->sum('jumlah_donasi');
        
        $this->update(['dana_terkumpul' => $total]);
        return $total;
    }

    // Get total bantuan tersalurkan
    public function getTotalTersalurkanAttribute()
    {
        return $this->penyalurans()->sum('jumlah_disalurkan');
    }

    // Scope untuk program aktif
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    // Scope untuk program selesai
    public function scopeSelesai($query)
    {
        return $query->where('status', 'selesai');
    }
}
