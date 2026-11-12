<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    // Menentukan nama tabel yang digunakan
    protected $table = 'jurusan';

    // Menentukan primary key
    protected $primaryKey = 'id_jurusan';

    // Menonaktifkan timestamps karena tabel jurusan tidak memiliki kolom created_at & updated_at
    public $timestamps = false;

    // Kolom yang boleh diisi (mass assignable)
    protected $fillable = [
        'nama_jurusan',
        'id_sekolah',
    ];

    // Relasi ke tabel sekolah (Opsional)
    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'id_sekolah', 'id_sekolah');
    }
}
