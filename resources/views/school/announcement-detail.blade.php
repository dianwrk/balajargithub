@extends('layouts.app')

@section('title', $announcement['title'] . ' - ' . $info['short_name'])

@section('content')
<!-- Header Bar -->
<div class="border-b border-slate-800 bg-slate-950/80 backdrop-blur-md py-4 px-4 sm:px-6 sticky top-0 z-40">
    <div class="max-w-5xl mx-auto flex items-center justify-between">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-300 hover:text-indigo-400 transition">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Papan Pengumuman</span>
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
        <a href="{{ route('home') }}#pengumuman" class="hover:text-white">Pengumuman</a>
        <i class="fa-solid fa-chevron-right text-[9px] text-slate-600"></i>
        <span class="text-emerald-400 truncate max-w-[250px] sm:max-w-md">{{ $announcement['title'] }}</span>
    </nav>

    <!-- Main Announcement Container -->
    <div class="glass-card rounded-3xl p-6 sm:p-10 border border-slate-800 shadow-2xl space-y-8">
        
        <!-- Header & Category -->
        <div class="space-y-4">
            <div class="flex flex-wrap items-center gap-3">
                <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $announcement['category_badge'] }}">
                    {{ $announcement['category'] }}
                </span>
                @if($announcement['is_pinned'])
                    <span class="px-2.5 py-1 rounded-full bg-rose-500/10 text-rose-400 border border-rose-500/20 text-xs font-bold flex items-center gap-1">
                        <i class="fa-solid fa-thumbtack text-[10px]"></i> Pengumuman Penting
                    </span>
                @endif
            </div>
            
            <h1 class="text-2xl sm:text-3xl font-extrabold text-white leading-tight">
                {{ $announcement['title'] }}
            </h1>

            <div class="flex flex-wrap items-center justify-between py-4 border-y border-slate-800 text-xs text-slate-400 gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-emerald-600/20 text-emerald-400 flex items-center justify-center font-bold">
                        <i class="fa-solid fa-bullhorn"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-white">Diterbitkan oleh: {{ $announcement['author'] }}</p>
                        <p class="text-[11px] text-slate-500">Sekretariat Resmi {{ $info['short_name'] }}</p>
                    </div>
                </div>
                <div>
                    <span class="px-3 py-1.5 rounded-xl bg-slate-900 border border-slate-800 text-slate-300 font-medium">
                        <i class="fa-regular fa-calendar text-emerald-400 mr-1.5"></i> Tanggal Rilis: {{ $announcement['date'] }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Content Body -->
        <div class="prose prose-invert max-w-none text-slate-300 leading-relaxed text-sm sm:text-base space-y-4 bg-slate-950/60 p-6 rounded-2xl border border-slate-900">
            <p class="font-semibold text-white text-base">{{ $announcement['summary'] }}</p>
            <p>{{ $announcement['content'] }}</p>
        </div>

        <!-- Attachment Download Box -->
        @if(isset($announcement['file_attachment']))
            <div class="p-5 rounded-2xl bg-indigo-950/40 border border-indigo-500/30 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-3.5">
                    <div class="w-12 h-12 rounded-xl bg-rose-500/20 text-rose-400 flex items-center justify-center text-xl flex-shrink-0">
                        <i class="fa-solid fa-file-pdf"></i>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-indigo-300 uppercase">Dokumen Lampiran Resmi</p>
                        <p class="text-sm font-bold text-white">{{ $announcement['file_attachment'] }}</p>
                        <p class="text-[11px] text-slate-400">Ukuran: 1.4 MB • Format Dokumen PDF Terverifikasi</p>
                    </div>
                </div>
                <button type="button" onclick="alert('Simulasi download dokumen: {{ $announcement['file_attachment'] }}')" class="py-2.5 px-5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold flex items-center gap-2 transition shadow-md shadow-indigo-600/30 w-full sm:w-auto justify-center">
                    <i class="fa-solid fa-download"></i>
                    <span>Unduh Dokumen</span>
                </button>
            </div>
        @endif

        <!-- Action Back -->
        <div class="pt-4 flex items-center justify-between">
            <a href="{{ route('home') }}#pengumuman" class="text-xs font-bold text-slate-400 hover:text-white flex items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Kembali ke Daftar Pengumuman</span>
            </a>

            <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Sekolah,%20saya%20ingin%20bertanya%20mengenai%20pengumuman%20{{ urlencode($announcement['title']) }}" target="_blank" class="text-xs font-bold text-emerald-400 hover:text-emerald-300 flex items-center gap-1.5">
                <i class="fa-brands fa-whatsapp"></i>
                <span>Tanyakan ke Humas</span>
            </a>
        </div>
    </div>
</div>
@endsection
