@extends('layouts.app')

@section('title', $major['name'] . ' - Program Keahlian ' . $info['short_name'])

@section('content')
<!-- Header Bar -->
<div class="border-b border-slate-800 bg-slate-950/80 backdrop-blur-md py-4 px-4 sm:px-6 sticky top-0 z-40">
    <div class="max-w-5xl mx-auto flex items-center justify-between">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-300 hover:text-indigo-400 transition">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Beranda SMK</span>
        </a>
        <a href="{{ route('login') }}" class="text-xs font-bold text-indigo-400 hover:text-indigo-300 flex items-center gap-1.5">
            <i class="fa-solid fa-lock"></i>
            <span>Portal Masuk Guru</span>
        </a>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 sm:px-6 py-10 sm:py-14 space-y-10">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-xs text-slate-400">
        <a href="{{ route('home') }}" class="hover:text-white">Beranda</a>
        <i class="fa-solid fa-chevron-right text-[9px] text-slate-600"></i>
        <a href="{{ route('home') }}#jurusan" class="hover:text-white">Program Keahlian</a>
        <i class="fa-solid fa-chevron-right text-[9px] text-slate-600"></i>
        <span class="text-indigo-400">{{ $major['code'] }}</span>
    </nav>

    <!-- Main Major Container -->
    <div class="glass-card rounded-3xl p-6 sm:p-10 border border-slate-800 shadow-2xl space-y-8">
        
        <!-- Header -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6 border-b border-slate-800 pb-6">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-2xl bg-indigo-600/30 text-indigo-400 flex items-center justify-center text-3xl shadow-lg border border-indigo-500/30">
                    <i class="{{ $major['icon'] }}"></i>
                </div>
                <div>
                    <span class="text-xs font-extrabold uppercase tracking-wider text-indigo-400">{{ $major['code'] }}</span>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-white">{{ $major['name'] }}</h1>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <span class="px-3 py-1.5 rounded-full bg-indigo-500/10 text-indigo-300 border border-indigo-500/20 text-xs font-bold">
                    {{ $major['badge'] }}
                </span>
                <span class="px-3 py-1.5 rounded-full bg-slate-900 text-slate-300 border border-slate-800 text-xs font-medium">
                    <i class="fa-solid fa-users text-indigo-400 mr-1"></i> {{ $major['quota'] }}
                </span>
            </div>
        </div>

        <!-- Overview -->
        <div class="space-y-3">
            <h3 class="text-base font-bold text-white uppercase tracking-wider text-xs">Deskripsi Program Keahlian</h3>
            <p class="text-slate-300 text-sm sm:text-base leading-relaxed bg-slate-950/60 p-6 rounded-2xl border border-slate-900">
                {{ $major['description'] }}
            </p>
        </div>

        <!-- Two Columns: Career Prospects & Tech Stacks -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Prospek Karier -->
            <div class="p-6 rounded-2xl bg-slate-900/60 border border-slate-800 space-y-4">
                <h4 class="text-sm font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-briefcase text-emerald-400"></i>
                    <span>Peluang Karier Lulusan</span>
                </h4>
                <ul class="space-y-2.5 text-xs sm:text-sm text-slate-300">
                    @foreach($major['careers'] as $career)
                        <li class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-check text-emerald-400 text-xs"></i>
                            <span>{{ $career }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Tools & Teknologi -->
            <div class="p-6 rounded-2xl bg-slate-900/60 border border-slate-800 space-y-4">
                <h4 class="text-sm font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-screwdriver-wrench text-indigo-400"></i>
                    <span>Tools &amp; Kurikulum Industri</span>
                </h4>
                <div class="flex flex-wrap gap-2 pt-1">
                    @foreach($major['tools'] as $tool)
                        <span class="px-3 py-1.5 rounded-xl bg-slate-950 text-indigo-300 border border-indigo-500/20 text-xs font-semibold">
                            {{ $tool }}
                        </span>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- PPDB Action Callout -->
        <div class="p-6 rounded-2xl bg-gradient-to-r from-indigo-900/60 via-purple-900/60 to-slate-900 border border-indigo-500/30 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-indigo-300">Tertarik Bergabung di Jurusan Ini?</p>
                <h4 class="text-lg font-bold text-white">Daftar PPDB Sekarang &amp; Amankan Kuota Kelas</h4>
            </div>
            <a href="https://wa.me/6281234567890?text=Halo%20Panitia%20PPDB,%20saya%20tertarik%20mendaftar%20jurusan%20{{ urlencode($major['name']) }}" target="_blank" class="py-3 px-5 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-bold text-xs flex items-center gap-2 transition whitespace-nowrap shadow-lg shadow-emerald-500/20">
                <i class="fa-brands fa-whatsapp text-sm"></i>
                <span>Daftar via WhatsApp</span>
            </a>
        </div>
    </div>

    <!-- Other Majors -->
    <div class="space-y-4">
        <h3 class="text-lg font-bold text-white flex items-center gap-2">
            <i class="fa-solid fa-graduation-cap text-indigo-400"></i>
            <span>Pilihan Jurusan Lainnya</span>
        </h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($otherMajors as $other)
                <a href="{{ route('major.detail', $other['slug']) }}" class="glass-card p-4 rounded-2xl border border-slate-800 hover:border-indigo-500/40 transition block space-y-2 group">
                    <div class="w-8 h-8 rounded-lg bg-indigo-600/20 text-indigo-400 flex items-center justify-center text-sm">
                        <i class="{{ $other['icon'] }}"></i>
                    </div>
                    <h4 class="text-xs font-bold text-white group-hover:text-indigo-300 transition">
                        {{ $other['name'] }}
                    </h4>
                    <p class="text-[11px] text-slate-500">{{ $other['code'] }}</p>
                </a>
            @endforeach
        </div>
    </div>
</div>
@endsection
