<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;

class KartuRFIDController extends Controller
{
    public function index(Request $request)
    {
        $kartuAktif = Siswa::whereNotNull('rfid_code')->where('status_siswa', 'Aktif')->count();
        $kartuHilang = Siswa::where('status_siswa', 'Hilang')->count();
        $belumDipasang = Siswa::whereNull('rfid_code')->count();

        $query = Siswa::with('anggotaKelas.kelas');

        if ($request->has('search') && $request->search != '') {
            $query->where('nama_siswa', 'like', '%' . $request->search . '%')
                  ->orWhere('rfid_code', 'like', '%' . $request->search . '%');
        }

        if ($request->has('status') && $request->status != '') {
            if ($request->status == 'belum_dipasang') {
                $query->whereNull('rfid_code');
            } else {
                $query->where('status_siswa', $request->status);
            }
        }

        $siswaList = $query->paginate(10);
        $kelasList = Kelas::all();

        return view('kartu-rfid', compact('siswaList', 'kelasList', 'kartuAktif', 'kartuHilang', 'belumDipasang'));
    }

    public function simpanRFID(Request $request)
    {
        $request->validate([
            'id_siswa' => 'required',
            'rfid_code' => 'required|unique:siswa,rfid_code'
        ]);

        $siswa = Siswa::findOrFail($request->id_siswa);
        $siswa->rfid_code = $request->rfid_code;
        $siswa->status_siswa = 'Aktif'; 
        $siswa->save();

        return back()->with('success', 'Kartu RFID berhasil dipasangkan.');
    }
}