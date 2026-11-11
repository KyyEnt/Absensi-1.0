<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';
    public $timestamps = false;

    protected $fillable = [
        'nis', 'nisn', 'nama_siswa', 'email', 'tgl_lahir', 
        'alamat_siswa', 'no_telp', 'status_siswa', 'jenis_kelamin', 
        'id_sekolah', 'id_ortu', 'rfid_code'
    ];

    public function anggotaKelas()
    {
        return $this->hasOne(AnggotaKelas::class, 'id_siswa', 'id_siswa');
    }
}