@extends('layouts.app')

@section('title', 'Login - Bootcamp Live Coding Laravel')

@section('content')
<div class="min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-8">
    <div class="w-full max-w-md">

        <!-- Navigasi Kembali ke Website Sekolah -->
        <div class="mb-5 text-left">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-400 hover:text-indigo-300 transition py-1.5 px-3.5 rounded-xl bg-slate-900/80 border border-slate-800 shadow-sm">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Kembali ke Website Portal SMK</span>
            </a>
        </div>

        <!-- Glass Card Form Login -->
        <div class="glass-card p-8 sm:p-10 rounded-3xl shadow-2xl relative overflow-hidden">
            <!-- Accent Top Line Gradient -->
            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>

            <!-- Brand Logo & Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 text-white shadow-lg shadow-indigo-500/30 mb-4 animate-float">
                    <i class="fa-solid fa-graduation-cap text-2xl"></i>
                </div>
                <h1 class="text-2xl font-extrabold text-white tracking-tight">Portal Guru &amp; Staff</h1>
                <p class="text-xs sm:text-sm text-slate-400 mt-1">Panel Administrasi Web SMKN 1 Tech</p>
            </div>

            <!-- Flash Success Notification -->
            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm flex items-center gap-3 animate-fade-in">
                    <i class="fa-solid fa-circle-check text-lg flex-shrink-0"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Form Autentikasi -->
            <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
                {{-- TOKEN KEAMANAN CSFR (MANDATORI LARAVEL) --}}
                @csrf

                <!-- Input Email -->
                <div>
                    <label for="email" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Alamat Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                            <i class="fa-regular fa-envelope"></i>
                        </div>
                        <input type="email" 
                               name="email" 
                               id="email" 
                               value="{{ old('email') }}" 
                               required 
                               placeholder="nama@domain.com"
                               class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-950/70 border @error('email') border-rose-500/80 focus:ring-rose-500/30 @else border-slate-800 focus:border-indigo-500 focus:ring-indigo-500/30 @enderror text-white placeholder-slate-500 focus:outline-none focus:ring-4 transition duration-200 text-sm font-medium">
                    </div>
                    @error('email')
                        <p class="mt-1.5 text-xs text-rose-400 flex items-center gap-1 font-medium">
                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Input Password -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider">Kata Sandi</label>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <input type="password" 
                               name="password" 
                               id="password" 
                               required 
                               placeholder="••••••••"
                               class="w-full pl-10 pr-10 py-3 rounded-xl bg-slate-950/70 border @error('password') border-rose-500/80 focus:ring-rose-500/30 @else border-slate-800 focus:border-indigo-500 focus:ring-indigo-500/30 @enderror text-white placeholder-slate-500 focus:outline-none focus:ring-4 transition duration-200 text-sm font-medium">
                        
                        <!-- Toggle Show/Hide Password -->
                        <button type="button" 
                                onclick="togglePasswordVisibility()" 
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-500 hover:text-slate-300 transition">
                            <i id="eye-icon" class="fa-regular fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-1.5 text-xs text-rose-400 flex items-center gap-1 font-medium">
                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Remember Me Checkbox -->
                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center gap-2.5 cursor-pointer group">
                        <input type="checkbox" 
                               name="remember" 
                               class="w-4 h-4 rounded bg-slate-950 border-slate-800 text-indigo-600 focus:ring-indigo-500/30 focus:ring-offset-slate-900">
                        <span class="text-xs text-slate-400 group-hover:text-slate-300 transition font-medium">Ingat Saya di Perangkat Ini</span>
                    </label>
                </div>

                <!-- Tombol Submit Login -->
                <button type="submit" 
                        class="w-full py-3.5 px-4 bg-gradient-to-r from-indigo-600 via-indigo-500 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-bold rounded-xl shadow-lg shadow-indigo-600/30 focus:outline-none focus:ring-4 focus:ring-indigo-500/40 active:scale-[0.98] transition-all duration-200 flex items-center justify-center gap-2 text-sm">
                    <span>Masuk ke Dashboard</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </button>
            </form>

            <!-- Footer Meta -->
            <!-- Footer Meta -->
            <div class="mt-8 pt-6 border-t border-slate-800/80 text-center">
                <p class="text-xs text-slate-500">
                    &copy; {{ date('Y') }} SMKN 1 Informatika &amp; Teknologi. Panel Administrasi.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Fungsi Toggle Password Visibility
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    }
</script>
@endpush
