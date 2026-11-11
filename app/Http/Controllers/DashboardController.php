<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Absensi;
use App\Models\Izin;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $hariIni = Carbon::today()->toDateString();

        $totalSiswa = Siswa::where('status_siswa', 'Aktif')->count();
        
        $jumlahHadir = Absensi::whereDate('waktu_absensi', $hariIni)
                               ->distinct('id_anggota_kelas')
                               ->count();
                               
        $jumlahIzin = Izin::count(); 
        
        $belumHadir = $totalSiswa - $jumlahHadir - $jumlahIzin;
        if ($belumHadir < 0) $belumHadir = 0;

        $liveAbsen = Absensi::with(['anggotaKelas.siswa', 'anggotaKelas.kelas'])
                            ->whereDate('waktu_absensi', $hariIni)
                            ->orderBy('waktu_absensi', 'desc')
                            ->take(10)
                            ->get();

        return view('dashboard', compact('totalSiswa', 'jumlahHadir', 'jumlahIzin', 'belumHadir', 'liveAbsen'));
    }
}