<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensi';
    protected $primaryKey = 'id_absensi';
    public $timestamps = false; // Karena menggunakan default timestamp di DB

    public function anggotaKelas()
    {
        return $this->belongsTo(AnggotaKelas::class, 'id_anggota_kelas', 'id_anggota_kelas');
    }
}