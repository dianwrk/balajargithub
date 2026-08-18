@extends('layouts.app')

@section('title', $article['title'] . ' - ' . $info['short_name'])

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
        <a href="{{ route('home') }}#berita" class="hover:text-white">Berita &amp; Prestasi</a>
        <i class="fa-solid fa-chevron-right text-[9px] text-slate-600"></i>
        <span class="text-indigo-400 truncate max-w-[250px] sm:max-w-md">{{ $article['title'] }}</span>
    </nav>

    <!-- Main Article Container -->
    <article class="glass-card rounded-3xl p-6 sm:p-10 border border-slate-800 shadow-2xl space-y-8">
        
        <!-- Header & Category -->
        <div class="space-y-4">
            <div class="flex flex-wrap items-center gap-3">
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-indigo-500/10 text-indigo-300 border border-indigo-500/20">
                    {{ $article['category'] }}
                </span>
                <span class="text-xs text-slate-400 flex items-center gap-1">
                    <i class="fa-regular fa-clock"></i> {{ $article['read_time'] }}
                </span>
            </div>
            
            <h1 class="text-2xl sm:text-4xl font-extrabold text-white leading-tight">
                {{ $article['title'] }}
            </h1>

            <div class="flex items-center justify-between py-4 border-y border-slate-800 text-xs text-slate-400">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-indigo-600/20 text-indigo-400 flex items-center justify-center font-bold">
                        <i class="fa-solid fa-pen-nib"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-white">{{ $article['author'] }}</p>
                        <p class="text-[11px] text-slate-500">Humas &amp; Publikasi {{ $info['short_name'] }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-slate-300"><i class="fa-regular fa-calendar mr-1"></i> {{ $article['date'] }}</p>
                </div>
            </div>
        </div>

        <!-- Featured Banner Box -->
        <div class="rounded-2xl bg-gradient-to-r {{ $article['image_gradient'] ?? 'from-indigo-600 to-purple-600' }} p-8 sm:p-12 text-white flex items-center justify-center shadow-lg relative overflow-hidden">
            <div class="text-center relative z-10 space-y-2">
                <i class="{{ $article['image_icon'] ?? 'fa-solid fa-newspaper' }} text-6xl text-white/90 drop-shadow-md"></i>
                <p class="text-xs font-bold uppercase tracking-widest text-indigo-200">Dokumentasi Liputan Khusus</p>
            </div>
        </div>

        <!-- Content Body -->
        <div class="prose prose-invert max-w-none text-slate-300 leading-relaxed text-sm sm:text-base space-y-4">
            @foreach(explode("\n\n", $article['content']) as $paragraph)
                <p>{{ $paragraph }}</p>
            @endforeach
        </div>

        <!-- Share & Tags -->
        <div class="pt-6 border-t border-slate-800 flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-2 text-xs text-slate-400">
                <span class="font-semibold text-white">Bagikan Berita:</span>
                <a href="#" class="w-8 h-8 rounded-lg bg-slate-900 hover:bg-slate-800 text-slate-300 hover:text-white flex items-center justify-center transition"><i class="fa-brands fa-whatsapp"></i></a>
                <a href="#" class="w-8 h-8 rounded-lg bg-slate-900 hover:bg-slate-800 text-slate-300 hover:text-white flex items-center justify-center transition"><i class="fa-brands fa-facebook"></i></a>
                <a href="#" class="w-8 h-8 rounded-lg bg-slate-900 hover:bg-slate-800 text-slate-300 hover:text-white flex items-center justify-center transition"><i class="fa-brands fa-x-twitter"></i></a>
            </div>

            <a href="{{ route('home') }}#berita" class="py-2.5 px-4 rounded-xl bg-slate-900 hover:bg-slate-800 text-slate-200 text-xs font-bold transition flex items-center gap-2 border border-slate-800">
                <i class="fa-solid fa-layer-group"></i>
                <span>Lihat Berita Lainnya</span>
            </a>
        </div>
    </article>

    <!-- Recent News Grid -->
    @if(count($recentNews) > 0)
        <div class="space-y-4">
            <h3 class="text-lg font-bold text-white flex items-center gap-2">
                <i class="fa-solid fa-newspaper text-indigo-400"></i>
                <span>Berita Terkait Lainnya</span>
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($recentNews as $item)
                    <a href="{{ route('news.detail', $item['slug']) }}" class="glass-card p-4 rounded-2xl border border-slate-800 hover:border-indigo-500/40 transition block space-y-2 group">
                        <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-indigo-500/10 text-indigo-300 border border-indigo-500/20">
                            {{ $item['category'] }}
                        </span>
                        <h4 class="text-xs sm:text-sm font-bold text-white group-hover:text-indigo-300 transition line-clamp-2">
                            {{ $item['title'] }}
                        </h4>
                        <p class="text-[11px] text-slate-500">{{ $item['date'] }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
