@extends('layouts.app')

@section('title', 'Dashboard | Sistem Informasi Akreditasi POLINES')

@section('content')
<div class="min-h-screen bg-slate-50 text-slate-800 flex flex-col">
    <!-- Navbar -->
    <header class="border-b border-slate-200 bg-white sticky top-0 z-50 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <!-- Brand -->
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center text-white shadow-md shadow-blue-600/20">
                    <i data-lucide="award" class="w-5 h-5"></i>
                </div>
                <div>
                    <h1 class="font-extrabold text-base text-slate-900 tracking-wide">SIAKRETI</h1>
                    <p class="text-[11px] text-slate-500 font-medium">Semarang</p>
                </div>
            </div>

            <!-- User Menu & Logout -->
            <div class="flex items-center gap-4">
                <div class="hidden sm:flex items-center gap-3 text-right">
                    <div>
                        <div class="text-sm font-bold text-slate-900">{{ $user->name }}</div>
                        <div class="text-xs text-slate-500">{{ $user->email }}</div>
                    </div>
                </div>

                <!-- Role Badge -->
                @php
                    $roleColors = [
                        'SUPERADMIN' => 'bg-purple-100 text-purple-700 border-purple-200',
                        'DOSEN' => 'bg-blue-100 text-blue-700 border-blue-200',
                        'KAPRODI' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                        'ASESOR' => 'bg-amber-100 text-amber-700 border-amber-200',
                        'EKSTERNAL' => 'bg-rose-100 text-rose-700 border-rose-200',
                    ];
                    $badgeClass = $roleColors[$user->role->value] ?? 'bg-slate-100 text-slate-700 border-slate-200';
                @endphp
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold border {{ $badgeClass }}">
                    {{ $user->role->value }}
                </span>

                <!-- Logout Form -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button 
                        type="submit" 
                        class="p-2 rounded-xl bg-slate-100 hover:bg-red-50 text-slate-600 hover:text-red-600 border border-slate-200 hover:border-red-200 transition-all flex items-center gap-2 text-xs font-semibold"
                        title="Keluar"
                    >
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                        <span class="hidden md:inline">Keluar</span>
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Main Body Content -->
    <main class="flex-1 max-w-7xl w-full mx-auto p-4 sm:p-6 lg:p-8 space-y-8">
        <!-- Welcome Hero -->
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-blue-900 via-indigo-900 to-slate-900 text-white shadow-lg p-6 sm:p-8">
            <div class="relative z-10 max-w-2xl space-y-3">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-500/20 text-emerald-300 border border-emerald-400/30">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    Sesi Aktif
                </span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-white">
                    Selamat Datang, {{ $user->name }}!
                </h2>
                <p class="text-sm text-blue-100/80 leading-relaxed">
                    Anda berhasil masuk sebagai <span class="font-semibold text-white">{{ $user->role->value }}</span> dalam Sistem Informasi Akreditasi Program Studi Politeknik Negeri Semarang.
                </p>
            </div>
        </div>

        <!-- Account Profile Details Card -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-xs space-y-4">
                <div class="flex items-center gap-3 text-slate-500 text-xs font-semibold uppercase tracking-wider">
                    <i data-lucide="user" class="w-4 h-4 text-blue-600"></i>
                    <span>Nama Pengguna</span>
                </div>
                <div class="text-lg font-bold text-slate-900">{{ $user->name }}</div>
            </div>

            <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-xs space-y-4">
                <div class="flex items-center gap-3 text-slate-500 text-xs font-semibold uppercase tracking-wider">
                    <i data-lucide="mail" class="w-4 h-4 text-blue-600"></i>
                    <span>Alamat Email</span>
                </div>
                <div class="text-lg font-bold text-slate-900 break-all">{{ $user->email }}</div>
            </div>

            <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-xs space-y-4">
                <div class="flex items-center gap-3 text-slate-500 text-xs font-semibold uppercase tracking-wider">
                    <i data-lucide="shield" class="w-4 h-4 text-blue-600"></i>
                    <span>Peran (Role)</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold border {{ $badgeClass }}">
                        {{ $user->role->value }}
                    </span>
                </div>
            </div>
        </div>
    </main>

    <footer class="border-t border-slate-200 py-6 text-center text-xs text-slate-500">
        &copy; {{ date('Y') }} TI-A 2025. Hak Cipta Dilindungi.
    </footer>
</div>
@endsection
