@extends('layouts.app')

@section('title', 'Masuk | Sistem Informasi Akreditasi POLINES')

@section('content')
<div class="min-h-screen w-full flex items-center justify-center relative overflow-hidden bg-gradient-to-br from-slate-100 via-blue-50/40 to-indigo-50/50 p-4 sm:p-6 md:p-10">
    <!-- Background Decor Elements -->
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-blue-400/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-indigo-400/15 rounded-full blur-3xl pointer-events-none"></div>

    <!-- Main Container -->
    <div class="w-full max-w-4xl grid grid-cols-1 lg:grid-cols-12 bg-white border border-slate-200/80 rounded-3xl shadow-xl shadow-slate-200/80 overflow-hidden z-10">
        
        <!-- Left Branding Panel (Hidden on mobile) -->
        <div class="hidden lg:flex lg:col-span-5 flex-col justify-between p-10 bg-gradient-to-br from-blue-900 via-indigo-900 to-slate-900 text-white relative">
            <!-- Background Glow inside panel -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-blue-500/10 rounded-full blur-2xl pointer-events-none"></div>
            
            <div class="space-y-6 relative z-10">
                <!-- Logo & Badge -->
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-2xl bg-white/10 backdrop-blur-md p-0.5 border border-white/20 shadow-lg">
                        <div class="w-full h-full bg-blue-600 rounded-[14px] flex items-center justify-center">
                            <i data-lucide="award" class="w-6 h-6 text-white"></i>
                        </div>
                    </div>
                    <div>
                        <h2 class="font-extrabold text-lg text-white tracking-wide">SIAKRETI</h2>
                        <p class="text-xs text-blue-200/80 font-medium">Politeknik Negeri Semarang</p>
                    </div>
                </div>

                <!-- Hero Section -->
                <div class="pt-8 space-y-4">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-blue-500/20 text-blue-200 border border-blue-400/30">
                        <i data-lucide="shield-check" class="w-3.5 h-3.5"></i>
                        Portal Resmi Akreditasi
                    </span>
                    <h1 class="text-2xl font-extrabold text-white leading-tight">
                        Manajemen & Evaluasi Diri Akreditasi Program Studi
                    </h1>
                    <p class="text-sm text-blue-100/70 leading-relaxed">
                        Platform terintegrasi untuk pengolahan dokumen borang, evaluasi kriteria akreditasi, dan validasi asesor internal & eksternal.
                    </p>
                </div>
            </div>

            <!-- Footer Logo Branding -->
            <div class="pt-8 border-t border-white/10 text-xs text-blue-200/60 font-medium relative z-10">
                Politeknik Negeri Semarang
            </div>
        </div>

        <!-- Right Form Panel -->
        <div class="lg:col-span-7 p-6 sm:p-10 flex flex-col justify-between bg-white">
            
            <div>
                <!-- Mobile Logo Header -->
                <div class="flex lg:hidden items-center gap-3 mb-8">
                    <div class="w-10 h-10 rounded-xl bg-blue-600 p-0.5 flex items-center justify-center text-white shadow-md">
                        <i data-lucide="award" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h2 class="font-bold text-base text-slate-900">SI-AKREDITASI</h2>
                        <p class="text-xs text-slate-500">Politeknik Negeri Semarang</p>
                    </div>
                </div>

                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Selamat Datang Kembali</h2>
                    <p class="text-sm text-slate-500 mt-1">Silakan masukkan email dan kata sandi Anda untuk mengakses akun.</p>
                </div>

                <!-- Flash Session Status Message -->
                @if (session('status'))
                    <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 flex items-start gap-3 text-emerald-800 text-sm">
                        <i data-lucide="check-circle-2" class="w-5 h-5 shrink-0 mt-0.5 text-emerald-600"></i>
                        <div>{{ session('status') }}</div>
                    </div>
                @endif

                <!-- Error Validation Summary -->
                @if ($errors->any())
                    <div class="mb-6 p-4 rounded-2xl bg-red-50 border border-red-200 flex items-start gap-3 text-red-800 text-sm">
                        <i data-lucide="alert-circle" class="w-5 h-5 shrink-0 mt-0.5 text-red-600"></i>
                        <ul class="space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-5">
                    @csrf

                    <!-- Email Input -->
                    <div class="space-y-2">
                        <label for="email" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider">
                            Alamat Email
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i data-lucide="mail" class="w-5 h-5"></i>
                            </div>
                            <input 
                                type="email" 
                                name="email" 
                                id="email" 
                                value="{{ old('email') }}" 
                                required 
                                autofocus 
                                placeholder="nama@polines.ac.id" 
                                class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 transition duration-200"
                            >
                        </div>
                    </div>

                    <!-- Password Input -->
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <label for="password" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider">
                                Kata Sandi
                            </label>
                            <a href="#" class="text-xs text-blue-600 hover:text-blue-700 transition-colors font-medium">
                                Lupa sandi?
                            </a>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i data-lucide="lock" class="w-5 h-5"></i>
                            </div>
                            <input 
                                type="password" 
                                name="password" 
                                id="password" 
                                required 
                                placeholder="••••••••" 
                                class="w-full pl-11 pr-11 py-3 bg-slate-50 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20 transition duration-200"
                            >
                            <button 
                                type="button" 
                                id="togglePassword" 
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 transition-colors"
                            >
                                <i data-lucide="eye" id="eyeIcon" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me Checkbox -->
                    <div class="flex items-center justify-between pt-1">
                        <label class="flex items-center gap-2.5 cursor-pointer group">
                            <input 
                                type="checkbox" 
                                name="remember" 
                                id="remember" 
                                class="w-4 h-4 rounded border-slate-300 bg-slate-50 text-blue-600 focus:ring-blue-500 focus:ring-offset-white"
                            >
                            <span class="text-sm text-slate-600 group-hover:text-slate-800 transition-colors">Ingat saya di perangkat ini</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full py-3.5 px-4 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl text-sm shadow-md shadow-blue-600/20 flex items-center justify-center gap-2 transition duration-200 active:scale-[0.99]"
                    >
                        <span>Masuk ke Akun</span>
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </button>
                </form>
            </div>

            <!-- Footer -->
            <div class="mt-10 pt-4 border-t border-slate-100 text-center text-xs text-slate-400">
                &copy; {{ date('Y') }} TI-A 2025. Hak Cipta Dilindungi.
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    // Password Visibility Toggle
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', function() {
            const isPassword = passwordInput.getAttribute('type') === 'password';
            passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
            eyeIcon.setAttribute('data-lucide', isPassword ? 'eye-off' : 'eye');
            if (window.lucide) {
                lucide.createIcons();
            }
        });
    }
</script>
@endpush
