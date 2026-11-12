<?php

namespace App\Http\Controllers;

use App\Models\Kelas;

class KelasController extends Controller
{
    public function index()
    {
        // Mengambil semua data kelas dari database
        $kelasList = Kelas::all();

        // Nantinya Anda bisa membuat file view resources/views/kelas.blade.php
        // return view('kelas', compact('kelasList'));

        return 'Ini adalah halaman Kelas (Tampilan/View belum dibuat).';
    }
}
