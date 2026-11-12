<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AbsensiRFID')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap');
        body { font-family: 'Inter', sans-serif; background-color: #F3F4F6; color: #1F2937; }
    </style>
    
    @stack('styles')
</head>
<body class="flex h-screen overflow-hidden">

    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col justify-between">
        <div>
            <div class="h-16 flex items-center px-6 border-b border-gray-200">
                <span class="text-xl font-bold text-gray-800">Absensi<span class="text-[#2563EB]">RFID</span></span>
            </div>
            
            <nav class="p-4 space-y-2">
                <a href="{{ route('dashboard.index') }}" class="block px-4 py-2 font-medium rounded-lg {{ request()->routeIs('dashboard.index') ? 'bg-[#2563EB] text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                    Dashboard
                </a>
                <a href="{{ route('absensi.index') }}" class="block px-4 py-2 font-medium rounded-lg {{ request()->routeIs('absensi.*') ? 'bg-[#2563EB] text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                    Absensi
                </a>
                <a href="{{ route('kartu.index') }}" class="block px-4 py-2 font-medium rounded-lg {{ request()->routeIs('kartu.*') ? 'bg-[#2563EB] text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                    Kartu RFID
                </a>
            </nav>
        </div>
        
        <div class="p-4 border-t border-gray-200">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex justify-center py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50">Logout</button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col overflow-y-auto p-8">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>