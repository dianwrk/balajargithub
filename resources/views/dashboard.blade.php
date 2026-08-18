@extends('layouts.app')

@section('title', 'Dashboard Admin Sekolah - SMKN 1 Tech')

@section('content')
<div class="min-h-screen bg-slate-950 flex flex-col">

    <!-- Top Navigation Bar -->
    <header class="sticky top-0 z-50 bg-slate-900/80 backdrop-blur-xl border-b border-slate-800/80 px-4 sm:px-8 py-3.5">
        <div class="max-w-7xl mx-auto flex items-center justify-between">

            <!-- Logo Brand Admin -->
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center font-extrabold text-white text-lg shadow-md shadow-indigo-500/20 hover:scale-105 transition">
                    <i class="fa-solid fa-graduation-cap"></i>
                </a>
                <div>
                    <div class="flex items-center gap-2">
                        <h1 class="font-extrabold text-base text-white tracking-wide leading-none">Panel Admin Sekolah</h1>
                        <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full bg-indigo-500/20 text-indigo-300 border border-indigo-500/30">SMKN 1 Tech</span>
                    </div>
                    <p class="text-[11px] text-slate-400 font-medium mt-0.5">Sistem Manajemen Pengumuman, Berita &amp; Portal Vokasi</p>
                </div>
            </div>

            <!-- Profile Info & Logout -->
            <div class="flex items-center gap-4">
                
                <!-- Link Lihat Portal Sekolah Publik -->
                <a href="{{ route('home') }}" target="_blank" class="hidden sm:flex items-center gap-2 px-3.5 py-1.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 hover:text-white border border-slate-700 text-xs font-semibold transition shadow-sm">
                    <i class="fa-solid fa-earth-americas text-indigo-400"></i>
                    <span>Lihat Web Sekolah</span>
                    <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-slate-400"></i>
                </a>

                <!-- Status Badge -->
                <div class="hidden md:flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-semibold">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Admin Terhubung</span>
                </div>

                <!-- User Profile Summary -->
                <div class="flex items-center gap-3 pl-3 border-l border-slate-800">
                    <div class="w-9 h-9 rounded-xl bg-indigo-600/30 text-indigo-400 font-bold flex items-center justify-center border border-indigo-500/30 text-sm">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                    <div class="hidden md:block">
                        <p class="text-xs font-bold text-white leading-none">{{ $user->name }}</p>
                        <p class="text-[10px] text-slate-400 font-medium mt-0.5">{{ $user->email }}</p>
                    </div>
                </div>

                <!-- Form Logout -->
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" 
                            title="Keluar dari Panel Admin"
                            class="px-3.5 py-2 rounded-xl bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 border border-rose-500/20 hover:border-rose-500/40 transition-all duration-200 text-xs font-bold flex items-center gap-2">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        <span class="hidden sm:inline">Logout</span>
                    </button>
                </form>

            </div>
        </div>
    </header>

    <!-- Main Body Container -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-8 py-8 space-y-8">

        <!-- Flash Success Notification -->
        @if(session('success'))
            <div class="p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm flex items-center justify-between shadow-lg animate-fade-in">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-emerald-500/20 flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-circle-check text-base"></i>
                    </div>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-emerald-300">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        @endif

        <!-- Hero Greeting Banner -->
        <div class="relative overflow-hidden p-8 sm:p-10 rounded-3xl bg-gradient-to-r from-indigo-900/70 via-purple-950/40 to-slate-900 border border-indigo-500/20 shadow-2xl">
            <!-- Background Glow Decor -->
            <div class="absolute -top-24 -right-24 w-72 h-72 bg-indigo-500/20 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-300 text-xs font-semibold mb-3">
                        <i class="fa-solid fa-shield-halved"></i>
                        <span>Panel Manajemen Konten Sekolah</span>
                    </div>
                    <h2 class="text-2xl sm:text-4xl font-extrabold text-white tracking-tight">
                        Selamat Datang, <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400">{{ $user->name }}</span>! 👨‍🏫
                    </h2>
                    <p class="text-slate-300 text-xs sm:text-sm mt-2 max-w-2xl leading-relaxed">
                        Anda dapat mempublikasikan pengumuman sekolah, memperbarui kabar berita &amp; prestasi siswa, mengelola program jurusan, serta memantau pendaftar PPDB.
                    </p>
                </div>

                <!-- Quick Action Buttons -->
                <div class="flex flex-wrap items-center gap-3">
                    <button type="button" onclick="openModal('modal-pengumuman')" class="px-4 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold shadow-lg shadow-indigo-600/30 transition-all flex items-center gap-2">
                        <i class="fa-solid fa-plus"></i>
                        <span>Buat Pengumuman</span>
                    </button>
                    <button type="button" onclick="openModal('modal-berita')" class="px-4 py-2.5 rounded-xl bg-purple-600 hover:bg-purple-500 text-white text-xs font-bold shadow-lg shadow-purple-600/30 transition-all flex items-center gap-2">
                        <i class="fa-solid fa-pen-to-square"></i>
                        <span>Tulis Berita</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Grid Stat Cards (Statistik Sekolah) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            
            <!-- Card 1: Berita Sekolah -->
            <div class="glass-card glass-card-hover p-6 rounded-2xl flex flex-col justify-between">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Berita &amp; Artikel</span>
                    <div class="w-9 h-9 rounded-xl bg-indigo-500/10 text-indigo-400 flex items-center justify-center">
                        <i class="fa-solid fa-newspaper"></i>
                    </div>
                </div>
                <div>
                    <h3 class="text-3xl font-extrabold text-white">{{ $schoolStats['total_news'] }}</h3>
                    <p class="text-[11px] text-emerald-400 mt-2 font-medium flex items-center gap-1">
                        <i class="fa-solid fa-arrow-up"></i> 3 Berita baru bulan ini
                    </p>
                </div>
            </div>

            <!-- Card 2: Pengumuman Aktif -->
            <div class="glass-card glass-card-hover p-6 rounded-2xl flex flex-col justify-between">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Pengumuman Aktif</span>
                    <div class="w-9 h-9 rounded-xl bg-purple-500/10 text-purple-400 flex items-center justify-center">
                        <i class="fa-solid fa-bullhorn"></i>
                    </div>
                </div>
                <div>
                    <h3 class="text-3xl font-extrabold text-white">{{ $schoolStats['active_announcements'] }}</h3>
                    <p class="text-[11px] text-indigo-300 mt-2 font-medium">2 Pengumuman disematkan</p>
                </div>
            </div>

            <!-- Card 3: Pendaftar PPDB -->
            <div class="glass-card glass-card-hover p-6 rounded-2xl flex flex-col justify-between">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Pendaftar PPDB</span>
                    <div class="w-9 h-9 rounded-xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center">
                        <i class="fa-solid fa-users-line"></i>
                    </div>
                </div>
                <div>
                    <h3 class="text-3xl font-extrabold text-emerald-400">{{ $schoolStats['ppdb_applicants'] }}</h3>
                    <p class="text-[11px] text-slate-400 mt-2 font-medium">Gelombang 1 (Jalur Prestasi)</p>
                </div>
            </div>

            <!-- Card 4: Siswa Aktif -->
            <div class="glass-card glass-card-hover p-6 rounded-2xl flex flex-col justify-between">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Siswa Aktif</span>
                    <div class="w-9 h-9 rounded-xl bg-sky-500/10 text-sky-400 flex items-center justify-center">
                        <i class="fa-solid fa-user-graduate"></i>
                    </div>
                </div>
                <div>
                    <h3 class="text-3xl font-extrabold text-white">{{ $schoolStats['active_students'] }}</h3>
                    <p class="text-[11px] text-slate-400 mt-2 font-medium">5 Program Keahlian SMK</p>
                </div>
            </div>

        </div>

        <!-- Section 1: Tabel Manajemen Pengumuman Sekolah -->
        <div class="glass-card rounded-3xl p-6 sm:p-8 shadow-xl space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h3 class="text-lg font-bold text-white flex items-center gap-2">
                        <i class="fa-solid fa-bullhorn text-indigo-400"></i>
                        <span>Manajemen Pengumuman Sekolah</span>
                    </h3>
                    <p class="text-xs text-slate-400 mt-1">Daftar surat edaran dan informasi resmi yang tampil di portal publik</p>
                </div>
                <button type="button" onclick="openModal('modal-pengumuman')" class="px-3.5 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold transition flex items-center gap-1.5 self-start sm:self-auto">
                    <i class="fa-solid fa-plus text-xs"></i>
                    <span>Tambah Pengumuman</span>
                </button>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-300">
                    <thead class="text-xs uppercase bg-slate-950/60 text-slate-400 border-b border-slate-800">
                        <tr>
                            <th class="px-4 py-3 rounded-l-xl">Judul Pengumuman</th>
                            <th class="px-4 py-3">Kategori</th>
                            <th class="px-4 py-3">Penulis</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3 text-right rounded-r-xl">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/60 text-xs">
                        @foreach($managedAnnouncements as $ann)
                            <tr class="hover:bg-slate-900/50 transition">
                                <td class="px-4 py-4 font-semibold text-white">
                                    <div class="flex items-center gap-2">
                                        @if($ann['is_pinned'])
                                            <span class="text-rose-400" title="Disematkan"><i class="fa-solid fa-thumbtack"></i></span>
                                        @endif
                                        <span class="truncate max-w-xs sm:max-w-md">{{ $ann['title'] }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    <span class="bg-slate-800 text-indigo-300 px-2.5 py-1 rounded-lg border border-slate-700 font-semibold">
                                        {{ $ann['category'] }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-slate-400">
                                    {{ $ann['author'] }}
                                </td>
                                <td class="px-4 py-4">
                                    @if($ann['status'] === 'Dipublikasikan')
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 font-semibold">
                                            <i class="fa-solid fa-circle-check text-[9px]"></i> Tayang
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-amber-500/10 border border-amber-500/20 text-amber-400 font-medium">
                                            <i class="fa-solid fa-clock text-[9px]"></i> Draf
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 text-slate-400 font-mono">
                                    {{ $ann['date'] }}
                                </td>
                                <td class="px-4 py-4 text-right">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <a href="{{ route('announcement.detail', $ann['id']) }}" target="_blank" class="p-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white" title="Lihat di Web">
                                            <i class="fa-regular fa-eye"></i>
                                        </a>
                                        <button type="button" onclick="alert('Fitur edit pengumuman: {{ $ann['title'] }}')" class="p-1.5 rounded-lg bg-indigo-600/20 hover:bg-indigo-600/40 text-indigo-300" title="Edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        <button type="button" onclick="alert('Simulasi hapus pengumuman')" class="p-1.5 rounded-lg bg-rose-500/20 hover:bg-rose-500/40 text-rose-300" title="Hapus">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Section 2: Tabel Manajemen Berita Sekolah -->
        <div class="glass-card rounded-3xl p-6 sm:p-8 shadow-xl space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h3 class="text-lg font-bold text-white flex items-center gap-2">
                        <i class="fa-solid fa-newspaper text-purple-400"></i>
                        <span>Manajemen Berita &amp; Liputan Prestasi</span>
                    </h3>
                    <p class="text-xs text-slate-400 mt-1">Publikasi liputan kegiatan, prestasi siswa, dan kerjasama industri</p>
                </div>
                <button type="button" onclick="openModal('modal-berita')" class="px-3.5 py-2 rounded-xl bg-purple-600 hover:bg-purple-500 text-white text-xs font-bold transition flex items-center gap-1.5 self-start sm:self-auto">
                    <i class="fa-solid fa-plus text-xs"></i>
                    <span>Tulis Berita Baru</span>
                </button>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-300">
                    <thead class="text-xs uppercase bg-slate-950/60 text-slate-400 border-b border-slate-800">
                        <tr>
                            <th class="px-4 py-3 rounded-l-xl">Judul Berita</th>
                            <th class="px-4 py-3">Kategori</th>
                            <th class="px-4 py-3">Pembaca (Views)</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Tanggal Rilis</th>
                            <th class="px-4 py-3 text-right rounded-r-xl">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/60 text-xs">
                        @foreach($managedNews as $newsItem)
                            <tr class="hover:bg-slate-900/50 transition">
                                <td class="px-4 py-4 font-semibold text-white">
                                    <span class="truncate max-w-xs sm:max-w-md block">{{ $newsItem['title'] }}</span>
                                </td>
                                <td class="px-4 py-4">
                                    <span class="bg-purple-950/60 text-purple-300 border border-purple-800 px-2.5 py-1 rounded-lg font-semibold">
                                        {{ $newsItem['category'] }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-slate-300 font-mono">
                                    <i class="fa-regular fa-eye text-slate-500 mr-1"></i> {{ $newsItem['views'] }}x
                                </td>
                                <td class="px-4 py-4">
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 font-semibold">
                                        <i class="fa-solid fa-circle-check text-[9px]"></i> {{ $newsItem['status'] }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-slate-400 font-mono">
                                    {{ $newsItem['date'] }}
                                </td>
                                <td class="px-4 py-4 text-right">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <a href="{{ route('news.detail') }}" target="_blank" class="p-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white" title="Lihat di Web">
                                            <i class="fa-regular fa-eye"></i>
                                        </a>
                                        <button type="button" onclick="alert('Fitur edit berita: {{ $newsItem['title'] }}')" class="p-1.5 rounded-lg bg-purple-600/20 hover:bg-purple-600/40 text-purple-300" title="Edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        <button type="button" onclick="alert('Simulasi hapus berita')" class="p-1.5 rounded-lg bg-rose-500/20 hover:bg-rose-500/40 text-rose-300" title="Hapus">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Box Edukasi Live Coding Siswi -->
        <div class="p-6 rounded-3xl bg-indigo-950/40 border border-indigo-500/20 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 rounded-xl bg-indigo-600/30 text-indigo-300 flex items-center justify-center flex-shrink-0 mt-1">
                    <i class="fa-solid fa-lightbulb text-lg"></i>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-white">Panduan Materi Siswi: Alur CRUD Pengumuman &amp; Berita</h4>
                    <p class="text-xs text-slate-300 mt-1 leading-relaxed">
                        Saat ini data pengumuman dan berita di-supply melalui <code class="text-indigo-300 bg-indigo-900/60 px-1.5 py-0.5 rounded">DashboardController.php</code>. Di pertemuan berikutnya, ajak siswi membuat <strong>Migration Database</strong> dan form input <strong>POST</strong> untuk menyimpan data pengumuman ke database MySQL!
                    </p>
                </div>
            </div>
            <a href="{{ route('home') }}" class="py-2 px-4 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold whitespace-nowrap flex items-center gap-1.5 shadow-md">
                <span>Cek Web Portal</span>
                <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
        </div>

    </main>

    <!-- Footer -->
    <footer class="border-t border-slate-800/80 py-6 px-4 text-center text-xs text-slate-500">
        <p>&copy; {{ date('Y') }} SMKN 1 Informatika &amp; Teknologi. Panel Administrasi &amp; Live Coding Mentoring.</p>
    </footer>

</div>

<!-- Modal Tambah Pengumuman (Simulasi Interaktif) -->
<div id="modal-pengumuman" class="fixed inset-0 z-50 bg-black/75 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="glass-card rounded-3xl p-6 sm:p-8 max-w-lg w-full border border-indigo-500/30 shadow-2xl space-y-5 animate-scale-in">
        <div class="flex items-center justify-between border-b border-slate-800 pb-3">
            <h3 class="text-base font-bold text-white flex items-center gap-2">
                <i class="fa-solid fa-bullhorn text-indigo-400"></i>
                <span>Buat Pengumuman Sekolah Baru</span>
            </h3>
            <button type="button" onclick="closeModal('modal-pengumuman')" class="text-slate-400 hover:text-white"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <form onsubmit="event.preventDefault(); alert('Sukses! Pengumuman baru berhasil disimulasikan.'); closeModal('modal-pengumuman');" class="space-y-4 text-xs">
            <div>
                <label class="block font-semibold text-slate-300 mb-1">Judul Pengumuman</label>
                <input type="text" required placeholder="Contoh: Jadwal Ujian Akhir Semester..." class="w-full p-2.5 rounded-xl bg-slate-900 border border-slate-800 text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500">
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block font-semibold text-slate-300 mb-1">Kategori</label>
                    <select class="w-full p-2.5 rounded-xl bg-slate-900 border border-slate-800 text-white focus:outline-none focus:border-indigo-500">
                        <option>PPDB</option>
                        <option>Akademik</option>
                        <option>Magang & Hubin</option>
                        <option>Beasiswa</option>
                    </select>
                </div>
                <div>
                    <label class="block font-semibold text-slate-300 mb-1">Prioritas</label>
                    <select class="w-full p-2.5 rounded-xl bg-slate-900 border border-slate-800 text-white focus:outline-none focus:border-indigo-500">
                        <option>Normal</option>
                        <option>Sematkan (Pinned)</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block font-semibold text-slate-300 mb-1">Isi Pengumuman</label>
                <textarea rows="3" required placeholder="Tuliskan detail isi pengumuman untuk siswa dan guru..." class="w-full p-2.5 rounded-xl bg-slate-900 border border-slate-800 text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500"></textarea>
            </div>
            <div class="flex items-center justify-end gap-2 pt-2 border-t border-slate-800">
                <button type="button" onclick="closeModal('modal-pengumuman')" class="px-4 py-2 rounded-xl bg-slate-800 text-slate-300 hover:text-white font-semibold">Batal</button>
                <button type="submit" class="px-4 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-bold">Terbitkan Pengumuman</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Tambah Berita (Simulasi Interaktif) -->
<div id="modal-berita" class="fixed inset-0 z-50 bg-black/75 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="glass-card rounded-3xl p-6 sm:p-8 max-w-lg w-full border border-purple-500/30 shadow-2xl space-y-5 animate-scale-in">
        <div class="flex items-center justify-between border-b border-slate-800 pb-3">
            <h3 class="text-base font-bold text-white flex items-center gap-2">
                <i class="fa-solid fa-newspaper text-purple-400"></i>
                <span>Tulis Berita &amp; Prestasi Sekolah</span>
            </h3>
            <button type="button" onclick="closeModal('modal-berita')" class="text-slate-400 hover:text-white"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <form onsubmit="event.preventDefault(); alert('Sukses! Berita baru berhasil disimulasikan.'); closeModal('modal-berita');" class="space-y-4 text-xs">
            <div>
                <label class="block font-semibold text-slate-300 mb-1">Judul Berita</label>
                <input type="text" required placeholder="Contoh: Siswa SMK Juarai Lomba Robotik..." class="w-full p-2.5 rounded-xl bg-slate-900 border border-slate-800 text-white placeholder-slate-500 focus:outline-none focus:border-purple-500">
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block font-semibold text-slate-300 mb-1">Kategori Liputan</label>
                    <select class="w-full p-2.5 rounded-xl bg-slate-900 border border-slate-800 text-white focus:outline-none focus:border-purple-500">
                        <option>Prestasi Siswa</option>
                        <option>Kemitraan Industri</option>
                        <option>Karya Inovasi</option>
                        <option>Akademik & Workshop</option>
                    </select>
                </div>
                <div>
                    <label class="block font-semibold text-slate-300 mb-1">Estimasi Waktu Baca</label>
                    <input type="text" value="3 menit baca" class="w-full p-2.5 rounded-xl bg-slate-900 border border-slate-800 text-white focus:outline-none focus:border-purple-500">
                </div>
            </div>
            <div>
                <label class="block font-semibold text-slate-300 mb-1">Ringkasan Berita</label>
                <textarea rows="2" required placeholder="Ringkasan singkat berita..." class="w-full p-2.5 rounded-xl bg-slate-900 border border-slate-800 text-white placeholder-slate-500 focus:outline-none focus:border-purple-500"></textarea>
            </div>
            <div class="flex items-center justify-end gap-2 pt-2 border-t border-slate-800">
                <button type="button" onclick="closeModal('modal-berita')" class="px-4 py-2 rounded-xl bg-slate-800 text-slate-300 hover:text-white font-semibold">Batal</button>
                <button type="submit" class="px-4 py-2 rounded-xl bg-purple-600 hover:bg-purple-500 text-white font-bold">Publikasikan Berita</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }
    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }
</script>
@endpush
