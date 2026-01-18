<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KebutuhanKorban extends Model
{
    protected $table = 'kebutuhan_korbans';
    protected $primaryKey = 'id_kebutuhan';
    
    protected $fillable = [
        'id_korban',
        'kategori',
        'nama_kebutuhan',
        'jumlah',
        'satuan',
        'prioritas',
        'status',
        'keterangan',
    ];

    protected $casts = [
        'jumlah' => 'integer',
    ];

    // Relasi ke Korban
    public function korban()
    {
        return $this->belongsTo(Korban::class, 'id_korban', 'id_korban');
    }

    // Scope berdasarkan kategori
    public function scopeKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    // Scope berdasarkan prioritas
    public function scopePrioritas($query, $prioritas)
    {
        return $query->where('prioritas', $prioritas);
    }

    // Scope untuk kebutuhan yang belum terpenuhi
    public function scopeDibutuhkan($query)
    {
        return $query->where('status', 'dibutuhkan');
    }

    // Scope untuk kebutuhan terpenuhi
    public function scopeTerpenuhi($query)
    {
        return $query->where('status', 'terpenuhi');
    }

    // Scope untuk prioritas tinggi
    public function scopePrioritasTinggi($query)
    {
        return $query->where('prioritas', 'tinggi');
    }
}
