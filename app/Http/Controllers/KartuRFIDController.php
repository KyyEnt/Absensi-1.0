<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class KartuRFIDController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', 'in:Aktif,Hilang,belum_dipasang'],
        ]);

        $kartuAktif = Siswa::whereNotNull('rfid_code')->where('status_siswa', 'Aktif')->count();
        $kartuHilang = Siswa::where('status_siswa', 'Hilang')->count();
        $belumDipasang = Siswa::whereNull('rfid_code')->count();

        $query = Siswa::with('anggotaKelas.kelas');

        if (! empty($filters['search'])) {
            $search = $filters['search'];

            $query->where(function ($query) use ($search) {
                $query->where('nama_siswa', 'like', "%{$search}%")
                    ->orWhere('rfid_code', 'like', "%{$search}%");
            });
        }

        if (! empty($filters['status'])) {
            if ($filters['status'] === 'belum_dipasang') {
                $query->whereNull('rfid_code');
            } else {
                $query->where('status_siswa', $filters['status']);
            }
        }

        $siswaList = $query->paginate(10)->withQueryString();

        return view('kartu-rfid', compact('siswaList', 'kartuAktif', 'kartuHilang', 'belumDipasang'));
    }

    public function simpanRFID(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'id_siswa' => ['required', 'integer', 'exists:siswa,id_siswa'],
            'rfid_code' => ['required', 'string', 'max:50', 'unique:siswa,rfid_code'],
        ]);

        $siswa = Siswa::findOrFail($data['id_siswa']);
        $siswa->rfid_code = $data['rfid_code'];
        $siswa->status_siswa = 'Aktif';
        $siswa->save();

        return back()->with('success', 'Kartu RFID berhasil dipasangkan.');
    }
}