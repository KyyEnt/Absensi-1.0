@extends('layouts.app')

@section('title', 'Kartu RFID - AbsensiRFID')

@section('content')
    <h1 class="text-2xl font-semibold mb-6">Kartu RFID</h1>

    <div class="grid grid-cols-3 gap-6 mb-6">
        <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
            <p class="text-sm text-gray-500 font-medium">Kartu Aktif</p>
            <p class="text-3xl font-bold mt-2">{{ $kartuAktif }}</p>
        </div>
        <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
            <p class="text-sm text-gray-500 font-medium">Diblokir / Hilang</p>
            <p class="text-3xl font-bold mt-2">{{ $kartuHilang }}</p>
        </div>
        <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
            <p class="text-sm text-gray-500 font-medium">Belum Dipasangkan</p>
            <p class="text-3xl font-bold mt-2">{{ $belumDipasang }}</p>
        </div>
    </div>

    <div class="flex gap-6">
        <div class="flex-1 bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden flex flex-col">
            
            <div class="p-4 border-b border-gray-200 bg-gray-50 flex gap-4">
                <form method="GET" action="{{ route('kartu.index') }}" class="w-full flex gap-4">
                    <input type="text" name="search" placeholder="Cari kode kartu / nama siswa..." class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2563EB]">
                    
                    <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg bg-white">
                        <option value="">Status: Semua</option>
                        <option value="Aktif">Aktif</option>
                        <option value="belum_dipasang">Belum Dipasangkan</option>
                        <option value="Hilang">Hilang / Diblokir</option>
                    </select>

                    <button type="submit" class="px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg hover:bg-gray-200">Filter</button>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 font-medium text-gray-500">Kode Kartu</th>
                            <th class="px-6 py-3 font-medium text-gray-500">Siswa</th>
                            <th class="px-6 py-3 font-medium text-gray-500">Kelas</th>
                            <th class="px-6 py-3 font-medium text-gray-500">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($siswaList as $siswa)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-mono">{{ $siswa->rfid_code ?? '-' }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $siswa->nama_siswa }}</td>
                            <td class="px-6 py-4">{{ $siswa->anggotaKelas->kelas->nama_kelas ?? 'Belum ada kelas' }}</td>
                            <td class="px-6 py-4">
                                @if($siswa->status_siswa == 'Aktif')
                                    <span class="text-[#097706] font-medium flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-[#097706]"></span> Aktif</span>
                                @elseif(!$siswa->rfid_code)
                                    <span class="text-yellow-600 font-medium flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-yellow-500"></span> Belum Dipasangkan</span>
                                @else
                                    <span class="text-[#DC2626] font-medium flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-[#DC2626]"></span> {{ $siswa->status_siswa }}</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t border-gray-200">
                {{ $siswaList->links() }}
            </div>
        </div>

        <div class="w-1/3">
            <div class="bg-white p-6 border border-gray-200 rounded-xl shadow-sm sticky top-8">
                <h3 class="text-lg font-semibold mb-4">Form Input Data Kartu Siswa</h3>
                
                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('kartu.simpan') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Siswa</label>
                        <select name="id_siswa" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2563EB]" required>
                            <option value="">-- Pilih Siswa --</option>
                            @foreach($siswaList as $s)
                                @if(!$s->rfid_code)
                                    <option value="{{ $s->id_siswa }}">{{ $s->nama_siswa }} ({{ $s->nis }})</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tap/Scan Kartu (Kode UID)</label>
                        <input type="text" name="rfid_code" placeholder="Tempelkan kartu pada reader..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2563EB]" required autofocus>
                    </div>

                    <div class="pt-4 border-t border-gray-100 flex gap-2">
                        <button type="submit" class="flex-1 bg-[#2563EB] text-white py-2 rounded-lg font-medium hover:bg-blue-700 transition">Simpan</button>
                        <button type="reset" class="flex-1 bg-white border border-gray-300 text-gray-700 py-2 rounded-lg font-medium hover:bg-gray-50 transition">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection