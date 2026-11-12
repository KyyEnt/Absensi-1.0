@extends('layouts.app')

@section('title', 'Absensi Hari Ini - AbsensiRFID')

@section('content')
    <!-- Judul Halaman -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 uppercase tracking-wide">Absensi Hari Ini</h1>
    </div>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden flex flex-col">
        
        <!-- Baris Filter / Pencarian -->
        <div class="p-4 border-b border-gray-200 bg-gray-50">
            <form method="GET" action="{{ route('absensi.index') }}" class="flex flex-wrap gap-4 items-center">
                
                <!-- Filter Hari (Tanggal) -->
                <div>
                    <input type="date" name="tanggal" value="{{ request('tanggal', date('Y-m-d')) }}" class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#2563EB]">
                </div>

                <!-- Filter Kelas -->
                <div>
                    <select name="id_kelas" class="px-4 py-2 border border-gray-300 rounded-lg text-sm bg-white focus:outline-none focus:ring-2 focus:ring-[#2563EB]">
                        <option value="">Semua Kelas</option>
                        @foreach($kelasList as $kelas)
                            <option value="{{ $kelas->id_kelas }}" {{ request('id_kelas') == $kelas->id_kelas ? 'selected' : '' }}>
                                {{ $kelas->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Jurusan -->
                <div>
                    <select name="id_jurusan" class="px-4 py-2 border border-gray-300 rounded-lg text-sm bg-white focus:outline-none focus:ring-2 focus:ring-[#2563EB]">
                        <option value="">Semua Jurusan</option>
                        @foreach($jurusanList as $jurusan)
                            <option value="{{ $jurusan->id_jurusan }}" {{ request('id_jurusan') == $jurusan->id_jurusan ? 'selected' : '' }}>
                                {{ $jurusan->nama_jurusan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Search by NIS / Nama -->
                <div class="flex-1 min-w-[200px]">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by NIS / Nama..." class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#2563EB]">
                </div>

                <!-- Tombol Cari -->
                <button type="submit" class="px-5 py-2 bg-[#2563EB] text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
                    Terapkan
                </button>
                <a href="{{ route('absensi.index') }}" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition">
                    Reset
                </a>
            </form>
        </div>

        <!-- Tabel Absensi -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-white border-b-2 border-gray-800 text-gray-700 uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Siswa</th>
                        <th class="px-6 py-4 font-semibold">Kelas</th>
                        <th class="px-6 py-4 font-semibold">Masuk</th>
                        <th class="px-6 py-4 font-semibold">Pulang</th>
                        <th class="px-6 py-4 font-semibold">Status</th>
                        <th class="px-4 py-4 text-center font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($absensiData as $row)
                        @php
                            // Logika mengambil tap pertama (Masuk) dan tap terakhir (Pulang)
                            $tapMasuk = $row->absensi->first();
                            $tapPulang = $row->absensi->count() > 1 ? $row->absensi->last() : null;
                        @endphp
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <p class="font-medium text-gray-900">{{ $row->siswa->nama_siswa ?? '-' }}</p>
                                <p class="text-xs text-gray-500">NIS: {{ $row->siswa->nis ?? '-' }}</p>
                            </td>
                            <td class="px-6 py-4 text-gray-700">
                                {{ $row->kelas->nama_kelas ?? '-' }}
                            </td>
                            
                            <!-- Kolom Masuk -->
                            <td class="px-6 py-4 font-mono text-gray-600">
                                {{ $tapMasuk ? \Carbon\Carbon::parse($tapMasuk->waktu_absensi)->format('H:i') : '--:--' }}
                            </td>
                            
                            <!-- Kolom Pulang -->
                            <td class="px-6 py-4 font-mono text-gray-600">
                                {{ $tapPulang ? \Carbon\Carbon::parse($tapPulang->waktu_absensi)->format('H:i') : '--:--' }}
                            </td>
                            
                            <!-- Kolom Status -->
                            <td class="px-6 py-4">
                                @if($tapMasuk)
                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-[#16434A]/10 text-[#16434A] border border-[#16434A]/20">Hadir</span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700 border border-red-200">Belum Tap</span>
                                @endif
                            </td>
                            
                            <!-- Tombol Aksi 3 Titik -->
                            <td class="px-4 py-4 text-center">
                                <button class="text-gray-400 hover:text-gray-800 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">Tidak ada data siswa / absensi yang ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="p-4 border-t border-gray-200">
            {{ $absensiData->links() }}
        </div>
    </div>
@endsection