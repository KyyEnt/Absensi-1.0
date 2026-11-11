@extends('layouts.app')

@section('title', 'Dashboard Kehadiran - AbsensiRFID')

@section('content')
    <div class="flex justify-between items-end mb-6">
        <div>
            <h1 class="text-2xl font-semibold">Dashboard Kehadiran</h1>
            <p class="text-sm text-gray-500 mt-1">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }} - Data real-time</p>
        </div>
        <div class="flex gap-2">
            <button class="px-4 py-2 bg-[#2563EB] text-white text-sm font-medium rounded-lg shadow-sm">1 Hari</button>
            <button class="px-4 py-2 bg-white border border-gray-300 text-gray-600 text-sm font-medium rounded-lg hover:bg-gray-50">1 Minggu</button>
            <button class="px-4 py-2 bg-white border border-gray-300 text-gray-600 text-sm font-medium rounded-lg hover:bg-gray-50">1 Bulan</button>
            <button class="px-4 py-2 bg-white border border-gray-300 text-gray-600 text-sm font-medium rounded-lg hover:bg-gray-50 ml-2">Ekspor</button>
        </div>
    </div>

    <div class="grid grid-cols-4 gap-6 mb-6">
        <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
            <p class="text-sm text-gray-500 font-medium">Card Total Siswa</p>
            <p class="text-3xl font-bold mt-2 text-gray-800">{{ $totalSiswa }}</p>
        </div>
        <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm border-l-4 border-l-[#16434A]">
            <p class="text-sm text-gray-500 font-medium">Card Jumlah Hadir</p>
            <p class="text-3xl font-bold mt-2 text-[#16434A]">{{ $jumlahHadir }}</p>
        </div>
        <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm border-l-4 border-l-[#DC2626]">
            <p class="text-sm text-gray-500 font-medium">Card Belum Hadir / Alfa</p>
            <p class="text-3xl font-bold mt-2 text-[#DC2626]">{{ $belumHadir }}</p>
        </div>
        <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm border-l-4 border-l-[#2563EB]">
            <p class="text-sm text-gray-500 font-medium">Card Izin / Sakit</p>
            <p class="text-3xl font-bold mt-2 text-[#2563EB]">{{ $jumlahIzin }}</p>
        </div>
    </div>

    <div class="flex gap-6 mb-6">
        <div class="flex-[2] bg-white p-5 border border-gray-200 rounded-xl shadow-sm">
            <h3 class="text-md font-semibold mb-4">Grafik Kehadiran (Tap Masuk)</h3>
            <div class="h-64 w-full">
                <canvas id="kehadiranChart"></canvas>
            </div>
        </div>

        <div class="flex-1 bg-white p-5 border border-gray-200 rounded-xl shadow-sm overflow-y-auto" style="max-height: 330px;">
            <h3 class="text-md font-semibold mb-4">Absen Kelas</h3>
            <div class="space-y-4">
                <div>
                    <div class="flex justify-between text-sm mb-1"><span>X RPL 1</span> <span class="font-medium">95%</span></div>
                    <div class="w-full bg-gray-200 rounded-full h-2"><div class="bg-[#16434A] h-2 rounded-full" style="width: 95%"></div></div>
                </div>
                <div>
                    <div class="flex justify-between text-sm mb-1"><span>XI TKJ 1</span> <span class="font-medium">88%</span></div>
                    <div class="w-full bg-gray-200 rounded-full h-2"><div class="bg-[#16434A] h-2 rounded-full" style="width: 88%"></div></div>
                </div>
                <div>
                    <div class="flex justify-between text-sm mb-1"><span>XII AKL 2</span> <span class="font-medium">70%</span></div>
                    <div class="w-full bg-gray-200 rounded-full h-2"><div class="bg-[#DC2626] h-2 rounded-full" style="width: 70%"></div></div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden flex flex-col flex-1 min-h-[300px]">
        <div class="p-4 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
            <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-green-500 animate-pulse"></span>
                Live Absen Kehadiran
            </h3>
        </div>
        
        <div class="overflow-y-auto flex-1 p-2">
            <table class="w-full text-left text-sm">
                <tbody class="divide-y divide-gray-100">
                    @forelse($liveAbsen as $absen)
                    <tr class="hover:bg-gray-50 transition group">
                        <td class="px-4 py-3">
                            <p class="font-medium text-gray-900">{{ $absen->anggotaKelas->siswa->nama_siswa ?? 'Tidak Diketahui' }}</p>
                            <p class="text-xs text-gray-500">{{ $absen->anggotaKelas->kelas->nama_kelas ?? '-' }}</p>
                        </td>
                        <td class="px-4 py-3 text-right font-mono text-gray-600">
                            {{ \Carbon\Carbon::parse($absen->waktu_absensi)->format('H:i:s') }}
                        </td>
                        <td class="px-4 py-3 text-right">
                            <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-[#16434A]/10 text-[#16434A] border border-[#16434A]/20">
                                Hadir
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-4 py-8 text-center text-gray-500">Belum ada data tap masuk hari ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    const ctx = document.getElementById('kehadiranChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['06:00', '06:15', '06:30', '06:45', '07:00', '07:15', '07:30'],
            datasets: [{
                label: 'Kedatangan',
                data: [20, 10, 25, 30, 10, 20, 5],
                borderColor: '#2563EB',
                backgroundColor: 'rgba(37, 99, 235, 0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });
</script>
@endpush