<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    protected $table = 'izin';
    protected $primaryKey = 'id_izin';
    
    // Nonaktifkan timestamps karena di tabel izin tidak ada created_at & updated_at
    public $timestamps = false; 

    protected $fillable = [
        'id_anggota_kelas',
        'catatan'
    ];

    public function anggotaKelas()
    {
        return $this->belongsTo(AnggotaKelas::class, 'id_anggota_kelas', 'id_anggota_kelas');
    }
}