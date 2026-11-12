<?php

namespace App\Http\Controllers;

use App\Models\AnggotaKelas;
use App\Models\Jurusan;
use App\Models\Kelas;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'tanggal' => ['nullable', 'date_format:Y-m-d'],
            'id_kelas' => ['nullable', 'integer', 'exists:kelas,id_kelas'],
            'id_jurusan' => ['nullable', 'integer', 'exists:jurusan,id_jurusan'],
            'search' => ['nullable', 'string', 'max:100'],
        ]);

        $tanggal = $filters['tanggal'] ?? Carbon::today()->toDateString();
        $kelasList = Kelas::query()->orderBy('nama_kelas')->get();
        $jurusanList = Jurusan::query()->orderBy('nama_jurusan')->get();

        $query = AnggotaKelas::with(['siswa', 'kelas', 'absensi' => function ($q) use ($tanggal) {
            $q->whereDate('waktu_absensi', $tanggal)->orderBy('waktu_absensi', 'asc');
        }]);

        if (! empty($filters['id_kelas'])) {
            $query->where('id_kelas', $filters['id_kelas']);
        }

        if (! empty($filters['id_jurusan'])) {
            $query->where('id_jurusan', $filters['id_jurusan']);
        }

        if (! empty($filters['search'])) {
            $search = $filters['search'];

            $query->whereHas('siswa', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('nis', 'like', "%{$search}%")
                        ->orWhere('nama_siswa', 'like', "%{$search}%");
                });
            });
        }

        $absensiData = $query->paginate(15)->withQueryString();

        return view('absensi', compact('absensiData', 'kelasList', 'jurusanList', 'tanggal'));
    }
}
