@extends('layouts.app')

@section('title', $info['name'] . ' - Portal Resmi Sekolah SMK')

@section('content')
<!-- ========================================== -->
<!-- 1. TOP ANNOUNCEMENT BAR (TICKER) -->
<!-- ========================================== -->
<div class="bg-gradient-to-r from-indigo-900/90 via-purple-900/90 to-slate-900/90 border-b border-indigo-500/20 py-2 px-4 text-xs">
    <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-2">
        <div class="flex items-center gap-2 overflow-hidden text-slate-300">
            <span class="bg-indigo-600 text-white font-bold px-2 py-0.5 rounded-full text-[10px] tracking-wide uppercase flex items-center gap-1 shadow-sm">
                <i class="fa-solid fa-bullhorn animate-pulse"></i> Pengumuman
            </span>
            <span class="truncate font-medium hover:text-indigo-300 transition">
                <a href="#pengumuman">{{ $announcements[0]['title'] }}</a>
            </span>
        </div>
        <div class="hidden md:flex items-center gap-4 text-slate-400">
            <span class="flex items-center gap-1.5"><i class="fa-regular fa-envelope text-indigo-400"></i> {{ $info['email'] }}</span>
            <span class="text-slate-600">|</span>
            <span class="flex items-center gap-1.5"><i class="fa-solid fa-phone text-indigo-400"></i> {{ $info['phone'] }}</span>
            <span class="text-slate-600">|</span>
            <span class="text-emerald-400 font-semibold flex items-center gap-1"><i class="fa-solid fa-circle-check text-xs"></i> {{ $info['accreditation'] }}</span>
        </div>
    </div>
</div>

<!-- ========================================== -->
<!-- 2. STICKY NAVBAR -->
<!-- ========================================== -->
<header class="sticky top-0 z-50 glass-card border-b border-slate-800/80 bg-slate-950/80 backdrop-blur-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3.5 group">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-indigo-500 via-indigo-600 to-purple-600 flex items-center justify-center text-white shadow-lg shadow-indigo-500/25 group-hover:scale-105 transition-transform duration-300">
                    <i class="fa-solid fa-graduation-cap text-2xl"></i>
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="text-lg font-extrabold text-white tracking-tight group-hover:text-indigo-300 transition">{{ $info['short_name'] }}</span>
                        <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full bg-indigo-500/20 text-indigo-300 border border-indigo-500/30">Pusat Keunggulan</span>
                    </div>
                    <p class="text-xs text-slate-400 font-medium hidden sm:block">{{ $info['name'] }}</p>
                </div>
            </a>

            <!-- Desktop Navigation Links -->
            <nav class="hidden lg:flex items-center gap-1">
                <a href="#beranda" class="px-3.5 py-2 rounded-xl text-sm font-medium text-white hover:text-indigo-300 hover:bg-slate-800/60 transition">Beranda</a>
                <a href="#sambutan" class="px-3.5 py-2 rounded-xl text-sm font-medium text-slate-300 hover:text-indigo-300 hover:bg-slate-800/60 transition">Profil</a>
                <a href="#jurusan" class="px-3.5 py-2 rounded-xl text-sm font-medium text-slate-300 hover:text-indigo-300 hover:bg-slate-800/60 transition">Jurusan</a>
                <a href="#pengumuman" class="px-3.5 py-2 rounded-xl text-sm font-medium text-slate-300 hover:text-indigo-300 hover:bg-slate-800/60 transition">Pengumuman</a>
                <a href="#berita" class="px-3.5 py-2 rounded-xl text-sm font-medium text-slate-300 hover:text-indigo-300 hover:bg-slate-800/60 transition">Berita</a>
                <a href="#fasilitas" class="px-3.5 py-2 rounded-xl text-sm font-medium text-slate-300 hover:text-indigo-300 hover:bg-slate-800/60 transition">Fasilitas &amp; Ekskul</a>
                <a href="#kontak" class="px-3.5 py-2 rounded-xl text-sm font-medium text-slate-300 hover:text-indigo-300 hover:bg-slate-800/60 transition">Kontak</a>
            </nav>

            <!-- Action Button (Login Guru / Dashboard) -->
            <div class="hidden sm:flex items-center gap-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="py-2.5 px-5 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white text-sm font-bold shadow-lg shadow-emerald-600/25 flex items-center gap-2 hover:scale-[1.02] transition">
                        <i class="fa-solid fa-gauge-high"></i>
                        <span>Buka Dashboard</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="py-2.5 px-5 rounded-xl bg-gradient-to-r from-indigo-600 via-indigo-500 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white text-sm font-bold shadow-lg shadow-indigo-600/30 flex items-center gap-2.5 hover:scale-[1.02] active:scale-[0.98] transition">
                        <div class="w-6 h-6 rounded-lg bg-white/20 flex items-center justify-center text-xs">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <span>Portal Guru &amp; Staff</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                @endauth
            </div>

            <!-- Mobile Menu Toggle Button -->
            <button type="button" onclick="toggleMobileMenu()" class="lg:hidden p-2 rounded-xl bg-slate-900 border border-slate-800 text-slate-300 hover:text-white focus:outline-none">
                <i id="mobile-menu-icon" class="fa-solid fa-bars text-xl"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation Drawer -->
    <div id="mobile-menu" class="hidden lg:hidden border-t border-slate-800/80 bg-slate-950/95 px-4 pt-3 pb-6 space-y-2">
        <a href="#beranda" onclick="toggleMobileMenu()" class="block px-3 py-2.5 rounded-xl text-sm font-medium text-white hover:bg-slate-900">Beranda</a>
        <a href="#sambutan" onclick="toggleMobileMenu()" class="block px-3 py-2.5 rounded-xl text-sm font-medium text-slate-300 hover:bg-slate-900">Profil &amp; Sambutan</a>
        <a href="#jurusan" onclick="toggleMobileMenu()" class="block px-3 py-2.5 rounded-xl text-sm font-medium text-slate-300 hover:bg-slate-900">Program Jurusan</a>
        <a href="#pengumuman" onclick="toggleMobileMenu()" class="block px-3 py-2.5 rounded-xl text-sm font-medium text-slate-300 hover:bg-slate-900">Pengumuman Terkini</a>
        <a href="#berita" onclick="toggleMobileMenu()" class="block px-3 py-2.5 rounded-xl text-sm font-medium text-slate-300 hover:bg-slate-900">Berita &amp; Prestasi</a>
        <a href="#fasilitas" onclick="toggleMobileMenu()" class="block px-3 py-2.5 rounded-xl text-sm font-medium text-slate-300 hover:bg-slate-900">Fasilitas &amp; Ekskul</a>
        <a href="#kontak" onclick="toggleMobileMenu()" class="block px-3 py-2.5 rounded-xl text-sm font-medium text-slate-300 hover:bg-slate-900">Kontak Sekolah</a>
        <div class="pt-3 border-t border-slate-800">
            @auth
                <a href="{{ route('dashboard') }}" class="w-full py-3 px-4 rounded-xl bg-emerald-600 text-white text-sm font-bold text-center flex items-center justify-center gap-2">
                    <i class="fa-solid fa-gauge-high"></i> Buka Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-sm font-bold text-center flex items-center justify-center gap-2">
                    <i class="fa-solid fa-lock"></i> Masuk Portal Guru &amp; Staff
                </a>
            @endauth
        </div>
    </div>
</header>

<!-- ========================================== -->
<!-- 3. HERO SECTION -->
<!-- ========================================== -->
<section id="beranda" class="relative pt-12 pb-20 lg:pt-20 lg:pb-28 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Left Column: Headline & Action -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                <!-- Badges -->
                <div class="inline-flex flex-wrap items-center gap-2 px-3.5 py-1.5 rounded-full bg-indigo-950/70 border border-indigo-500/30 backdrop-blur-md shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                    <span class="text-xs font-semibold text-indigo-300">PPDB 2026/2027 Telah Dibuka</span>
                    <span class="text-slate-600">•</span>
                    <span class="text-xs font-medium text-slate-400">SMK Pusat Keunggulan Nasional</span>
                </div>

                <!-- Main Heading -->
                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-white tracking-tight leading-tight">
                    Mencetak Generasi <br class="hidden sm:inline">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400">
                        Terampil &amp; Siap Kerja
                    </span>
                    <br>di Era Digital
                </h1>

                <!-- Sub-heading -->
                <p class="text-base sm:text-lg text-slate-300 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                    Selamat datang di Portal Resmi <strong class="text-white">{{ $info['name'] }}</strong>. Kami menghadirkan pendidikan vokasi modern berstandar industri dengan penguasaan teknologi terdepan, teaching factory, dan sertifikasi keahlian berstandar global.
                </p>

                <!-- Action Buttons -->
                <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4 pt-2">
                    <a href="#jurusan" class="py-3.5 px-6 rounded-2xl bg-gradient-to-r from-indigo-600 via-indigo-500 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-bold text-sm shadow-xl shadow-indigo-600/30 flex items-center gap-2.5 hover:scale-105 active:scale-95 transition-all">
                        <i class="fa-solid fa-graduation-cap"></i>
                        <span>Jelajahi Program Jurusan</span>
                    </a>
                    <a href="#pengumuman" class="py-3.5 px-6 rounded-2xl glass-card text-slate-200 hover:text-white hover:border-indigo-500/50 font-bold text-sm flex items-center gap-2 hover:bg-slate-900/60 transition-all">
                        <i class="fa-solid fa-bullhorn text-indigo-400"></i>
                        <span>Info Pengumuman PPDB</span>
                    </a>
                </div>

                <!-- Secondary Link to Teacher Login -->
                <div class="pt-2 flex items-center justify-center lg:justify-start gap-2 text-xs text-slate-400">
                    <span>Apakah Anda Guru atau Tenaga Pendidik?</span>
                    <a href="{{ route('login') }}" class="text-indigo-400 hover:text-indigo-300 font-semibold underline flex items-center gap-1">
                        Masuk Portal Guru di sini <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>
            </div>

            <!-- Right Column: Interactive School Showcase Card -->
            <div class="lg:col-span-5">
                <div class="relative">
                    <!-- Glow Behind Showcase Card -->
                    <div class="absolute -inset-1 bg-gradient-to-r from-indigo-500 via-purple-600 to-pink-500 rounded-3xl blur-xl opacity-30 animate-pulse-slow"></div>

                    <!-- Main Showcase Card -->
                    <div class="relative glass-card rounded-3xl p-6 sm:p-8 border border-white/10 shadow-2xl space-y-6">
                        
                        <!-- Header Card -->
                        <div class="flex items-center justify-between border-b border-slate-800 pb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-indigo-600/30 text-indigo-400 flex items-center justify-center">
                                    <i class="fa-solid fa-school text-lg"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-white">{{ $info['short_name'] }}</p>
                                    <p class="text-[11px] text-slate-400">NPSN: {{ $info['npsn'] }} • Didirikan {{ $info['established_year'] }}</p>
                                </div>
                            </div>
                            <span class="px-2.5 py-1 rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 text-[11px] font-bold">
                                {{ $info['accreditation'] }}
                            </span>
                        </div>

                        <!-- Mini Code & Teaching Factory Preview -->
                        <div class="rounded-2xl bg-slate-950 p-4 border border-slate-800 font-mono text-xs text-slate-300 space-y-2">
                            <div class="flex items-center justify-between text-[11px] text-slate-500 border-b border-slate-900 pb-2">
                                <div class="flex items-center gap-1.5">
                                    <span class="w-2.5 h-2.5 rounded-full bg-rose-500/80"></span>
                                    <span class="w-2.5 h-2.5 rounded-full bg-amber-500/80"></span>
                                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500/80"></span>
                                    <span class="ml-1 text-slate-400">vokasi-smk-tech.php</span>
                                </div>
                                <span class="text-indigo-400 font-semibold">Laravel 11</span>
                            </div>
                            <div class="space-y-1 text-[11px] leading-relaxed pt-1">
                                <p><span class="text-purple-400">&lt;?php</span></p>
                                <p><span class="text-sky-400">$kurikulum</span> = <span class="text-emerald-300">'Standard Industri &amp; AI Ready'</span>;</p>
                                <p><span class="text-sky-400">$lulusan</span> = <span class="text-indigo-300">SiswaSMK</span>::<span class="text-amber-300">siapKerja</span>([</p>
                                <p class="pl-4 text-slate-400">'keterampilan' => <span class="text-emerald-300">'Tinggi'</span>,</p>
                                <p class="pl-4 text-slate-400">'karakter' => <span class="text-emerald-300">'Disiplin &amp; Unggul'</span>,</p>
                                <p class="pl-4 text-slate-400">'sertifikasi' => <span class="text-emerald-300">'BNSP &amp; Global'</span></p>
                                <p>]);</p>
                            </div>
                        </div>

                        <!-- Interactive Quick Links Inside Card -->
                        <div class="grid grid-cols-2 gap-3 pt-1">
                            <a href="#pengumuman" class="p-3 rounded-xl bg-slate-900/80 hover:bg-slate-800/80 border border-slate-800 transition flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-indigo-500/20 text-indigo-400 flex items-center justify-center flex-shrink-0">
                                    <i class="fa-solid fa-bullhorn text-xs"></i>
                                </div>
                                <div class="text-left overflow-hidden">
                                    <p class="text-xs font-bold text-white truncate">4 Pengumuman</p>
                                    <p class="text-[10px] text-slate-400">Terbaru &amp; Aktif</p>
                                </div>
                            </a>
                            <a href="#berita" class="p-3 rounded-xl bg-slate-900/80 hover:bg-slate-800/80 border border-slate-800 transition flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-purple-500/20 text-purple-400 flex items-center justify-center flex-shrink-0">
                                    <i class="fa-solid fa-newspaper text-xs"></i>
                                </div>
                                <div class="text-left overflow-hidden">
                                    <p class="text-xs font-bold text-white truncate">Prestasi &amp; Berita</p>
                                    <p class="text-[10px] text-slate-400">LKS Juara 1</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Metric Statistics Bar -->
        <div class="mt-16 grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
            @foreach($stats as $stat)
                <div class="glass-card p-5 rounded-2xl border border-slate-800 hover:border-indigo-500/40 transition-all duration-300 group">
                    <div class="flex items-center gap-3.5 mb-2">
                        <div class="w-10 h-10 rounded-xl bg-slate-900 flex items-center justify-center {{ $stat['color'] }} group-hover:scale-110 transition-transform">
                            <i class="{{ $stat['icon'] }} text-lg"></i>
                        </div>
                        <span class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">{{ $stat['number'] }}</span>
                    </div>
                    <p class="text-xs sm:text-sm text-slate-400 font-medium">{{ $stat['label'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ========================================== -->
<!-- 4. SAMBUTAN KEPALA SEKOLAH & PROFIL -->
<!-- ========================================== -->
<section id="sambutan" class="py-16 bg-slate-950/60 border-y border-slate-900 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="glass-card p-8 sm:p-12 rounded-3xl border border-slate-800/80 relative overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                
                <!-- Foto/Avatar Kepala Sekolah -->
                <div class="lg:col-span-4 text-center">
                    <div class="relative inline-block">
                        <div class="w-36 h-36 sm:w-44 sm:h-44 rounded-3xl bg-gradient-to-br from-indigo-500 via-purple-600 to-pink-600 p-1 shadow-2xl shadow-indigo-600/30">
                            <div class="w-full h-full rounded-[22px] bg-slate-900 flex flex-col items-center justify-center text-white p-4">
                                <i class="fa-solid fa-user-tie text-5xl sm:text-6xl text-indigo-400 mb-2"></i>
                                <span class="text-[10px] uppercase font-bold tracking-widest text-slate-400">Kepala Sekolah</span>
                            </div>
                        </div>
                        <div class="absolute -bottom-2 -right-2 bg-emerald-500 text-white text-[11px] font-bold px-3 py-1 rounded-full shadow-md flex items-center gap-1">
                            <i class="fa-solid fa-circle-check"></i> Terverifikasi
                        </div>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-lg font-extrabold text-white">{{ $info['principal']['name'] }}</h3>
                        <p class="text-xs text-indigo-400 font-medium">{{ $info['principal']['title'] }}</p>
                    </div>
                </div>

                <!-- Pesan Sambutan -->
                <div class="lg:col-span-8 space-y-4">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-indigo-500/10 text-indigo-400 text-xs font-semibold">
                        <i class="fa-solid fa-quote-left"></i> Sambutan Resmi
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                        Membangun Masa Depan Gemilang Melalui Kejuruan Unggul
                    </h2>
                    <blockquote class="text-sm sm:text-base text-slate-300 italic leading-relaxed border-l-4 border-indigo-500 pl-4 py-1">
                        "{{ $info['principal']['quote'] }}"
                    </blockquote>
                    <p class="text-xs sm:text-sm text-slate-400 leading-relaxed">
                        {{ $info['description'] }} Kami berfokus pada pembentukan soft-skill dan hard-skill siswa melalui kemitraan strategis bersama industri kelas dunia, program magang intensif, serta pembekalan kewirausahaan kreatif.
                    </p>

                    <!-- Key Pillars -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 pt-2">
                        <div class="p-3 rounded-xl bg-slate-900/90 border border-slate-800 text-center">
                            <i class="fa-solid fa-lightbulb text-indigo-400 mb-1"></i>
                            <p class="text-xs font-bold text-white">Inovatif</p>
                        </div>
                        <div class="p-3 rounded-xl bg-slate-900/90 border border-slate-800 text-center">
                            <i class="fa-solid fa-award text-purple-400 mb-1"></i>
                            <p class="text-xs font-bold text-white">Kompeten</p>
                        </div>
                        <div class="p-3 rounded-xl bg-slate-900/90 border border-slate-800 text-center">
                            <i class="fa-solid fa-handshake-simple text-sky-400 mb-1"></i>
                            <p class="text-xs font-bold text-white">Berkarakter</p>
                        </div>
                        <div class="p-3 rounded-xl bg-slate-900/90 border border-slate-800 text-center">
                            <i class="fa-solid fa-earth-americas text-emerald-400 mb-1"></i>
                            <p class="text-xs font-bold text-white">Global Ready</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================== -->
<!-- 5. PROGRAM KEAHLIAN / JURUSAN SMK -->
<!-- ========================================== -->
<section id="jurusan" class="py-20 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-14 space-y-3">
            <span class="text-xs font-bold uppercase tracking-wider px-3.5 py-1.5 rounded-full bg-indigo-500/10 text-indigo-400 border border-indigo-500/20">
                Pilihan Masa Depan
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
                Program Keahlian &amp; Jurusan Unggulan
            </h2>
            <p class="text-sm sm:text-base text-slate-400">
                Pilih jalur keahlian vokasi terbaik sesuai minat dan passion Anda dengan fasilitas laboratorium modern serta sertifikasi kompetensi industri.
            </p>
        </div>

        <!-- Majors Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            @foreach($majors as $major)
                <div class="glass-card rounded-3xl p-6 sm:p-7 border border-slate-800/80 hover:border-indigo-500/40 hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group shadow-xl">
                    <div>
                        <!-- Header Card with Icon & Badge -->
                        <div class="flex items-start justify-between gap-4 mb-5">
                            <div class="w-14 h-14 rounded-2xl bg-slate-900 border border-slate-800 flex items-center justify-center text-indigo-400 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300 shadow-md">
                                <i class="{{ $major['icon'] }} text-2xl"></i>
                            </div>
                            <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-indigo-500/10 text-indigo-300 border border-indigo-500/20">
                                {{ $major['badge'] }}
                            </span>
                        </div>

                        <!-- Code & Title -->
                        <div class="mb-3">
                            <span class="text-xs font-bold uppercase tracking-wider text-indigo-400">{{ $major['code'] }}</span>
                            <h3 class="text-lg font-extrabold text-white group-hover:text-indigo-300 transition mt-0.5">
                                {{ $major['name'] }}
                            </h3>
                        </div>

                        <!-- Description -->
                        <p class="text-xs sm:text-sm text-slate-400 leading-relaxed mb-5">
                            {{ $major['short_desc'] }}
                        </p>

                        <!-- Tech Stack / Tools Tags -->
                        <div class="space-y-2 mb-5">
                            <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Materi &amp; Tools Utama:</p>
                            <div class="flex flex-wrap gap-1.5">
                                @foreach(array_slice($major['tools'], 0, 3) as $tool)
                                    <span class="text-[11px] px-2 py-0.5 rounded-md bg-slate-900 text-slate-300 border border-slate-800">
                                        {{ $tool }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Card Footer: Link Detail -->
                    <div class="pt-4 border-t border-slate-800/80 flex items-center justify-between">
                        <span class="text-[11px] text-slate-500"><i class="fa-solid fa-users text-indigo-400 mr-1"></i> {{ $major['quota'] }}</span>
                        <a href="{{ route('major.detail', $major['slug']) }}" class="text-xs font-bold text-indigo-400 hover:text-indigo-300 flex items-center gap-1.5 group/link">
                            <span>Detail Jurusan</span>
                            <i class="fa-solid fa-arrow-right text-[10px] group-hover/link:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ========================================== -->
<!-- 6. FITUR PENGUMUMAN SEKOLAH -->
<!-- ========================================== -->
<section id="pengumuman" class="py-20 bg-slate-950/80 border-t border-slate-900 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div class="space-y-2">
                <span class="text-xs font-bold uppercase tracking-wider px-3.5 py-1.5 rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                    Papan Informasi
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
                    Pengumuman Resmi Sekolah
                </h2>
                <p class="text-sm text-slate-400">
                    Informasi penting terkait akademik, pendaftaran siswa baru (PPDB), ujian, dan agenda kegiatan sekolah.
                </p>
            </div>

            <!-- Filter Buttons (JavaScript Filtering) -->
            <div class="flex flex-wrap items-center gap-2">
                <button type="button" onclick="filterAnnouncements('all')" class="announcement-btn active-ann-btn px-3 py-1.5 rounded-xl text-xs font-semibold bg-indigo-600 text-white transition">
                    Semua
                </button>
                <button type="button" onclick="filterAnnouncements('PPDB')" class="announcement-btn px-3 py-1.5 rounded-xl text-xs font-semibold bg-slate-900 text-slate-400 hover:text-white border border-slate-800 transition">
                    PPDB
                </button>
                <button type="button" onclick="filterAnnouncements('Akademik')" class="announcement-btn px-3 py-1.5 rounded-xl text-xs font-semibold bg-slate-900 text-slate-400 hover:text-white border border-slate-800 transition">
                    Akademik
                </button>
                <button type="button" onclick="filterAnnouncements('Magang & Hubin')" class="announcement-btn px-3 py-1.5 rounded-xl text-xs font-semibold bg-slate-900 text-slate-400 hover:text-white border border-slate-800 transition">
                    Magang PKL
                </button>
                <button type="button" onclick="filterAnnouncements('Beasiswa')" class="announcement-btn px-3 py-1.5 rounded-xl text-xs font-semibold bg-slate-900 text-slate-400 hover:text-white border border-slate-800 transition">
                    Beasiswa
                </button>
            </div>
        </div>

        <!-- Announcements List -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6" id="announcements-container">
            @foreach($announcements as $ann)
                <div class="announcement-item glass-card p-6 sm:p-7 rounded-3xl border border-slate-800/80 hover:border-indigo-500/40 transition-all duration-200 flex flex-col justify-between" data-category="{{ $ann['category'] }}">
                    <div>
                        <!-- Header with Date Badge & Category -->
                        <div class="flex items-center justify-between gap-4 mb-4">
                            <div class="flex items-center gap-2">
                                <span class="px-2.5 py-1 rounded-lg text-[11px] font-bold border {{ $ann['category_badge'] }}">
                                    {{ $ann['category'] }}
                                </span>
                                @if($ann['is_pinned'])
                                    <span class="px-2 py-0.5 rounded-md bg-rose-500/10 text-rose-400 border border-rose-500/20 text-[10px] font-bold flex items-center gap-1">
                                        <i class="fa-solid fa-thumbtack text-[9px]"></i> PENTING
                                    </span>
                                @endif
                            </div>
                            <span class="text-xs text-slate-500 font-medium">
                                <i class="fa-regular fa-calendar text-slate-400 mr-1"></i> {{ $ann['date'] }}
                            </span>
                        </div>

                        <!-- Title -->
                        <h3 class="text-base sm:text-lg font-bold text-white hover:text-indigo-300 transition mb-2">
                            <a href="{{ route('announcement.detail', $ann['id']) }}">{{ $ann['title'] }}</a>
                        </h3>

                        <!-- Summary -->
                        <p class="text-xs sm:text-sm text-slate-400 leading-relaxed mb-4">
                            {{ $ann['summary'] }}
                        </p>
                    </div>

                    <!-- Footer Details -->
                    <div class="pt-4 border-t border-slate-800/80 flex items-center justify-between text-xs">
                        <span class="text-slate-500 flex items-center gap-1.5 truncate max-w-[200px]">
                            <i class="fa-solid fa-user-pen text-indigo-400"></i> {{ $ann['author'] }}
                        </span>
                        <a href="{{ route('announcement.detail', $ann['id']) }}" class="text-indigo-400 hover:text-indigo-300 font-bold flex items-center gap-1">
                            <span>Baca Lengkap</span>
                            <i class="fa-solid fa-chevron-right text-[10px]"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ========================================== -->
<!-- 7. FITUR BERITA & ARTIKEL TERKINI -->
<!-- ========================================== -->
<section id="berita" class="py-20 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-14 space-y-3">
            <span class="text-xs font-bold uppercase tracking-wider px-3.5 py-1.5 rounded-full bg-purple-500/10 text-purple-400 border border-purple-500/20">
                Kabar Terkini
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
                Berita &amp; Prestasi Sekolah
            </h2>
            <p class="text-sm sm:text-base text-slate-400">
                Update terkini mengenai kegiatan siswa, prestasi kompetisi, kunjungan industri, dan inovasi karya teknologi.
            </p>
        </div>

        <!-- News Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Featured Headline (Large Column) -->
            @if(isset($news[0]))
                @php $headline = $news[0]; @endphp
                <div class="lg:col-span-7">
                    <div class="glass-card rounded-3xl overflow-hidden border border-slate-800/80 hover:border-indigo-500/40 transition-all duration-300 h-full flex flex-col justify-between group">
                        
                        <!-- Visual Image Header Banner -->
                        <div class="h-64 sm:h-80 bg-gradient-to-tr {{ $headline['image_gradient'] }} p-8 flex flex-col justify-between relative overflow-hidden">
                            <div class="absolute -right-10 -bottom-10 opacity-20 text-white text-9xl">
                                <i class="{{ $headline['image_icon'] }}"></i>
                            </div>
                            <div class="flex items-center justify-between relative z-10">
                                <span class="px-3 py-1 rounded-full bg-black/40 backdrop-blur-md text-white text-xs font-bold border border-white/20">
                                    ★ Berita Utama
                                </span>
                                <span class="px-2.5 py-1 rounded-full bg-black/30 text-white text-xs font-medium backdrop-blur-md">
                                    {{ $headline['read_time'] }}
                                </span>
                            </div>
                            <div class="relative z-10">
                                <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center text-white text-2xl mb-3 shadow-lg">
                                    <i class="{{ $headline['image_icon'] }}"></i>
                                </div>
                                <span class="text-xs uppercase font-bold tracking-wider text-indigo-200">{{ $headline['category'] }}</span>
                            </div>
                        </div>

                        <!-- Content Body -->
                        <div class="p-6 sm:p-8 space-y-4 flex-1 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center gap-3 text-xs text-slate-500 mb-2">
                                    <span><i class="fa-regular fa-calendar mr-1"></i> {{ $headline['date'] }}</span>
                                    <span>•</span>
                                    <span><i class="fa-solid fa-user-pen mr-1"></i> {{ $headline['author'] }}</span>
                                </div>
                                <h3 class="text-xl sm:text-2xl font-black text-white group-hover:text-indigo-300 transition leading-snug">
                                    <a href="{{ route('news.detail', $headline['slug']) }}">{{ $headline['title'] }}</a>
                                </h3>
                                <p class="text-sm text-slate-400 mt-3 leading-relaxed">
                                    {{ $headline['summary'] }}
                                </p>
                            </div>

                            <div class="pt-4 border-t border-slate-800 flex items-center justify-between">
                                <span class="text-xs font-semibold text-indigo-400 flex items-center gap-1">
                                    <i class="fa-solid fa-trophy"></i> Prestasi Tingkat Nasional
                                </span>
                                <a href="{{ route('news.detail', $headline['slug']) }}" class="py-2 px-4 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold flex items-center gap-2 transition shadow-md shadow-indigo-600/30">
                                    <span>Baca Berita</span>
                                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- News List (Small Column) -->
            <div class="lg:col-span-5 space-y-5">
                @foreach(array_slice($news, 1) as $item)
                    <div class="glass-card p-5 sm:p-6 rounded-3xl border border-slate-800/80 hover:border-indigo-500/40 transition-all duration-300 group flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between text-xs text-slate-500 mb-2">
                                <span class="px-2.5 py-0.5 rounded-full bg-slate-900 text-indigo-300 border border-slate-800 text-[11px] font-semibold">
                                    {{ $item['category'] }}
                                </span>
                                <span><i class="fa-regular fa-clock mr-1"></i> {{ $item['read_time'] }}</span>
                            </div>
                            <h4 class="text-base font-bold text-white group-hover:text-indigo-300 transition leading-snug">
                                <a href="{{ route('news.detail', $item['slug']) }}">{{ $item['title'] }}</a>
                            </h4>
                            <p class="text-xs text-slate-400 mt-2 line-clamp-2 leading-relaxed">
                                {{ $item['summary'] }}
                            </p>
                        </div>
                        <div class="mt-4 pt-3 border-t border-slate-800/60 flex items-center justify-between text-xs">
                            <span class="text-slate-500">{{ $item['date'] }}</span>
                            <a href="{{ route('news.detail', $item['slug']) }}" class="text-indigo-400 hover:text-indigo-300 font-bold flex items-center gap-1 group/btn">
                                <span>Selengkapnya</span>
                                <i class="fa-solid fa-chevron-right text-[10px] group-hover/btn:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- ========================================== -->
<!-- 8. FASILITAS & EKSTRAKURIKULER -->
<!-- ========================================== -->
<section id="fasilitas" class="py-20 bg-slate-950/60 border-y border-slate-900 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
        
        <!-- Fasilitas Sekolah -->
        <div>
            <div class="text-center max-w-3xl mx-auto mb-12 space-y-2">
                <span class="text-xs font-bold uppercase tracking-wider px-3.5 py-1.5 rounded-full bg-sky-500/10 text-sky-400 border border-sky-500/20">
                    Sarana &amp; Prasarana
                </span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                    Fasilitas Pembelajaran Modern
                </h2>
                <p class="text-xs sm:text-sm text-slate-400">
                    Didukung sarana mutakhir untuk menciptakan atmosfer pembelajaran yang menyerupai lingkungan kerja industri nyata.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($facilities as $fac)
                    <div class="glass-card p-6 rounded-2xl border border-slate-800 hover:border-sky-500/40 transition group">
                        <div class="w-12 h-12 rounded-xl bg-slate-900 text-sky-400 flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition-transform">
                            <i class="{{ $fac['icon'] }}"></i>
                        </div>
                        <h3 class="text-base font-bold text-white mb-1.5">{{ $fac['name'] }}</h3>
                        <p class="text-xs text-slate-400 leading-relaxed">{{ $fac['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Ekstrakurikuler -->
        <div class="pt-8 border-t border-slate-800/80">
            <div class="text-center max-w-3xl mx-auto mb-12 space-y-2">
                <span class="text-xs font-bold uppercase tracking-wider px-3.5 py-1.5 rounded-full bg-pink-500/10 text-pink-400 border border-pink-500/20">
                    Bakat &amp; Minat
                </span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                    Ekstrakurikuler &amp; Komunitas Siswa
                </h2>
                <p class="text-xs sm:text-sm text-slate-400">
                    Asah jiwa kepemimpinan, kreativitas, dan minat khusus melalui puluhan klub siswa berprestasi.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($extracurriculars as $ekskul)
                    <div class="glass-card p-6 rounded-2xl border border-slate-800 hover:border-pink-500/40 transition group flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 rounded-xl bg-slate-900 text-pink-400 flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                                    <i class="{{ $ekskul['icon'] }}"></i>
                                </div>
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-pink-500/10 text-pink-300 border border-pink-500/20">
                                    {{ $ekskul['badge'] }}
                                </span>
                            </div>
                            <h3 class="text-base font-bold text-white mb-1.5">{{ $ekskul['name'] }}</h3>
                            <p class="text-xs text-slate-400 leading-relaxed">{{ $ekskul['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- ========================================== -->
<!-- 9. TESTIMONI ALUMNI & MITRA INDUSTRI -->
<!-- ========================================== -->
<section class="py-20 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-14 space-y-3">
            <span class="text-xs font-bold uppercase tracking-wider px-3.5 py-1.5 rounded-full bg-amber-500/10 text-amber-400 border border-amber-500/20">
                Kisah Sukses
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
                Apa Kata Alumni &amp; Mitra Industri?
            </h2>
            <p class="text-sm text-slate-400">
                Bukti nyata kualitas lulusan yang berkarier di perusahaan ternama dan diterima dengan bangga di dunia kerja.
            </p>
        </div>

        <!-- Testimonial Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
            @foreach($testimonials as $testi)
                <div class="glass-card p-6 sm:p-8 rounded-3xl border border-slate-800/80 hover:border-amber-500/40 transition flex flex-col justify-between space-y-6">
                    <div class="space-y-4">
                        <div class="text-amber-400 text-sm flex gap-1">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-300 italic leading-relaxed">
                            "{{ $testi['message'] }}"
                        </p>
                    </div>

                    <div class="pt-4 border-t border-slate-800 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center flex-shrink-0">
                            <i class="{{ $testi['avatar'] }}"></i>
                        </div>
                        <div class="overflow-hidden">
                            <h4 class="text-xs sm:text-sm font-bold text-white truncate">{{ $testi['name'] }}</h4>
                            <p class="text-[11px] text-slate-400 truncate">{{ $testi['role'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Partner Industry Logos Bar -->
        <div class="mt-16 p-6 sm:p-8 rounded-3xl bg-slate-900/50 border border-slate-800 text-center space-y-4">
            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Telah Bekerjasama dengan Lebih dari 48+ Mitra Industri Terkemuka</p>
            <div class="flex flex-wrap items-center justify-center gap-6 sm:gap-12 opacity-70 grayscale hover:grayscale-0 transition-all text-slate-400 font-bold text-sm sm:text-base">
                <span class="flex items-center gap-2"><i class="fa-brands fa-google text-lg"></i> Google for Education</span>
                <span class="flex items-center gap-2"><i class="fa-brands fa-aws text-lg"></i> AWS Academy</span>
                <span class="flex items-center gap-2"><i class="fa-brands fa-microsoft text-lg"></i> Microsoft Learn</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-car text-lg"></i> Astra Group</span>
                <span class="flex items-center gap-2"><i class="fa-solid fa-tower-broadcast text-lg"></i> Telkom Indonesia</span>
            </div>
        </div>
    </div>
</section>

<!-- ========================================== -->
<!-- 10. PPDB CTA BANNER -->
<!-- ========================================== -->
<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative rounded-3xl p-8 sm:p-12 overflow-hidden bg-gradient-to-r from-indigo-900 via-purple-900 to-slate-900 border border-indigo-500/30 shadow-2xl">
            <!-- Glow Accent -->
            <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-indigo-500/20 rounded-full blur-3xl pointer-events-none"></div>
            
            <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-8 space-y-3 text-center lg:text-left">
                    <span class="px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 text-xs font-bold uppercase tracking-wider">
                        Pendaftaran Siswa Baru TA 2026/2027
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-extrabold text-white tracking-tight">
                        Siap Menjadi Bagian dari Generasi Juara?
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-300 max-w-2xl">
                        Dapatkan kuota terbatas jalur beasiswa prestasi bebas biaya SPP dan fasilitas pendidikan vokasi terbaik di Indonesia. Hubungi panitia PPDB sekarang.
                    </p>
                </div>
                
                <div class="lg:col-span-4 flex flex-col sm:flex-row lg:flex-col gap-3 justify-center">
                    <a href="https://wa.me/6281234567890?text=Halo%20Panitia%20PPDB%20SMKN%201%20Tech,%20saya%20ingin%20bertanya%20tentang%20pendaftaran" target="_blank" class="py-3.5 px-6 rounded-2xl bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-extrabold text-sm flex items-center justify-center gap-2 shadow-lg shadow-emerald-500/20 hover:scale-105 transition">
                        <i class="fa-brands fa-whatsapp text-lg"></i>
                        <span>Konsultasi PPDB WhatsApp</span>
                    </a>
                    <a href="#pengumuman" class="py-3.5 px-6 rounded-2xl glass-card text-white font-bold text-sm flex items-center justify-center gap-2 hover:bg-slate-900/80 transition">
                        <i class="fa-solid fa-file-arrow-down text-indigo-400"></i>
                        <span>Download Brosur PPDB</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================== -->
<!-- 11. FAQ & KONTAK SEKOLAH -->
<!-- ========================================== -->
<section id="kontak" class="py-20 bg-slate-950/80 border-t border-slate-900 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <!-- Left Column: FAQs -->
            <div class="lg:col-span-7 space-y-6">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider px-3.5 py-1.5 rounded-full bg-indigo-500/10 text-indigo-400 border border-indigo-500/20">
                        Pertanyaan Umum
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight mt-3">
                        Frequently Asked Questions (FAQ)
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-400 mt-1">
                        Pertanyaan yang sering diajukan seputar pendaftaran, kurikulum, dan magang industri.
                    </p>
                </div>

                <div class="space-y-4">
                    @foreach($faqs as $index => $faq)
                        <div class="glass-card rounded-2xl p-5 border border-slate-800/80">
                            <h4 class="text-sm font-bold text-white flex items-start gap-2.5">
                                <span class="w-6 h-6 rounded-full bg-indigo-600/30 text-indigo-400 text-xs flex items-center justify-center flex-shrink-0 mt-0.5">
                                    Q
                                </span>
                                <span>{{ $faq['q'] }}</span>
                            </h4>
                            <p class="text-xs sm:text-sm text-slate-400 mt-2.5 pl-8 leading-relaxed">
                                {{ $faq['a'] }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Right Column: Info Kontak & Alamat -->
            <div class="lg:col-span-5 space-y-6">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider px-3.5 py-1.5 rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                        Hubungi Kami
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight mt-3">
                        Informasi &amp; Lokasi Kampus
                    </h2>
                </div>

                <div class="glass-card p-6 sm:p-8 rounded-3xl border border-slate-800 space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-indigo-600/20 text-indigo-400 flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-400 uppercase">Alamat Kampus Utama</p>
                            <p class="text-sm text-white font-medium mt-0.5">{{ $info['address'] }}</p>
                            <p class="text-xs text-slate-400">{{ $info['city'] }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-purple-600/20 text-purple-400 flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-400 uppercase">Telepon &amp; WhatsApp Humas</p>
                            <p class="text-sm text-white font-medium mt-0.5">{{ $info['phone'] }}</p>
                            <p class="text-xs text-slate-400">WA: {{ $info['whatsapp'] }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-sky-600/20 text-sky-400 flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-400 uppercase">Surat Elektronik (Email)</p>
                            <p class="text-sm text-white font-medium mt-0.5">{{ $info['email'] }}</p>
                            <p class="text-xs text-slate-400">PPDB: {{ $info['ppdb_email'] }}</p>
                        </div>
                    </div>

                    <!-- Jam Operasional -->
                    <div class="p-4 rounded-2xl bg-slate-900/90 border border-slate-800 text-xs text-slate-300 space-y-1">
                        <div class="flex items-center justify-between font-semibold text-white">
                            <span><i class="fa-regular fa-clock text-indigo-400 mr-1.5"></i> Jam Layanan Kantor</span>
                            <span class="text-emerald-400">Aktif</span>
                        </div>
                        <p class="text-slate-400">Senin – Jumat: 07.00 – 16.00 WIB</p>
                        <p class="text-slate-400">Sabtu (Khusus Layanan PPDB): 08.00 – 13.00 WIB</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================== -->
<!-- 12. FOOTER -->
<!-- ========================================== -->
<footer class="bg-slate-950 border-t border-slate-800/80 pt-16 pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-8 pb-12 border-b border-slate-800">
            
            <!-- Brand Column -->
            <div class="lg:col-span-5 space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white shadow-lg">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <span class="text-lg font-extrabold text-white">{{ $info['short_name'] }}</span>
                </div>
                <p class="text-xs sm:text-sm text-slate-400 leading-relaxed max-w-sm">
                    {{ $info['tagline'] }}. Lembaga pendidikan kejuruan berstandar internasional yang mencetak lulusan siap kerja, berkarakter, dan berdaya saing global.
                </p>
                <div class="flex items-center gap-3 text-slate-400 text-sm">
                    <a href="{{ $info['socials']['youtube'] }}" target="_blank" class="w-8 h-8 rounded-xl bg-slate-900 border border-slate-800 hover:text-rose-400 hover:border-rose-500/40 flex items-center justify-center transition"><i class="fa-brands fa-youtube"></i></a>
                    <a href="{{ $info['socials']['instagram'] }}" target="_blank" class="w-8 h-8 rounded-xl bg-slate-900 border border-slate-800 hover:text-pink-400 hover:border-pink-500/40 flex items-center justify-center transition"><i class="fa-brands fa-instagram"></i></a>
                    <a href="{{ $info['socials']['facebook'] }}" target="_blank" class="w-8 h-8 rounded-xl bg-slate-900 border border-slate-800 hover:text-indigo-400 hover:border-indigo-500/40 flex items-center justify-center transition"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="{{ $info['socials']['github'] }}" target="_blank" class="w-8 h-8 rounded-xl bg-slate-900 border border-slate-800 hover:text-white hover:border-white/40 flex items-center justify-center transition"><i class="fa-brands fa-github"></i></a>
                </div>
            </div>

            <!-- Program Keahlian Links -->
            <div class="lg:col-span-3 space-y-3">
                <h4 class="text-xs font-bold uppercase tracking-wider text-slate-300">Program Keahlian</h4>
                <ul class="space-y-2 text-xs text-slate-400">
                    @foreach($majors as $m)
                        <li><a href="{{ route('major.detail', $m['slug']) }}" class="hover:text-indigo-300 transition">{{ $m['name'] }}</a></li>
                    @endforeach
                </ul>
            </div>

            <!-- Tautan Penting & Portal Staff -->
            <div class="lg:col-span-4 space-y-3">
                <h4 class="text-xs font-bold uppercase tracking-wider text-slate-300">Akses Cepat &amp; Portal</h4>
                <ul class="space-y-2 text-xs text-slate-400">
                    <li><a href="#pengumuman" class="hover:text-indigo-300 transition">Papan Pengumuman &amp; Jadwal</a></li>
                    <li><a href="#berita" class="hover:text-indigo-300 transition">Berita &amp; Galeri Prestasi Siswa</a></li>
                    <li><a href="#sambutan" class="hover:text-indigo-300 transition">Profil &amp; Visi Misi Sekolah</a></li>
                </ul>

                <div class="pt-3">
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-indigo-950/80 border border-indigo-500/30 text-indigo-300 hover:text-white text-xs font-bold hover:bg-indigo-900/60 transition shadow-sm">
                        <i class="fa-solid fa-lock text-[11px]"></i>
                        <span>Login Guru &amp; Tenaga Pendidik</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
            <p>&copy; {{ date('Y') }} {{ $info['name'] }}. Hak Cipta Dilindungi.</p>
            <p>Dibuat untuk Sesi Bootcamp Live Coding Siswi SMK.</p>
        </div>
    </div>
</footer>

@endsection

@push('scripts')
<script>
    // Toggle Menu Mobile
    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        const icon = document.getElementById('mobile-menu-icon');
        menu.classList.toggle('hidden');
        if (menu.classList.contains('hidden')) {
            icon.classList.remove('fa-xmark');
            icon.classList.add('fa-bars');
        } else {
            icon.classList.remove('fa-bars');
            icon.classList.add('fa-xmark');
        }
    }

    // Filter Pengumuman Interaktif
    function filterAnnouncements(category) {
        const items = document.querySelectorAll('.announcement-item');
        const buttons = document.querySelectorAll('.announcement-btn');

        // Update Button Active State
        buttons.forEach(btn => {
            btn.classList.remove('bg-indigo-600', 'text-white');
            btn.classList.add('bg-slate-900', 'text-slate-400', 'border', 'border-slate-800');
        });
        event.target.classList.remove('bg-slate-900', 'text-slate-400', 'border', 'border-slate-800');
        event.target.classList.add('bg-indigo-600', 'text-white');

        // Filter Items
        items.forEach(item => {
            const itemCat = item.getAttribute('data-category');
            if (category === 'all' || itemCat.toLowerCase().includes(category.toLowerCase())) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });
    }
</script>
@endpush
