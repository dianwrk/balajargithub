# 🏫 Modul Master Live Coding: Web Portal Sekolah SMK & Panel Manajemen Admin (Berita, Pengumuman, & Autentikasi Guru)

Dokumen ini adalah **panduan lengkap & script live coding interaktif** antara Anda (Mentor) dan siswi Anda. Panduan ini menggabungkan pembuatan **Portal Web Resmi Sekolah SMK** (Landing Page, Profil Jurusan, Pengumuman, Berita Prestasi) dengan sistem **Panel Admin & Autentikasi Manual Guru/Staff** tanpa menggunakan starter-kit pihak ketiga.

---

## 🎯 Peta Arsitektur & Alur Belajar Siswi

```
                                    🌐 PENGUNJUNG / CALON SISWA
                                                │
                                                ▼
                                   [ Route '/' (GET) ]
                                                │
                                                ▼
                                    [ SchoolController@index ]
                                                │
                                                ▼
                            [ Tampilan Portal Web Sekolah SMK ]
                     • Banner Hero & Sambutan Kepala Sekolah
                     • 5 Program Jurusan (PPLG, TJKT, DKV, TO, AKL)
                     • Papan Pengumuman (PPDB, Akademik, PKL, Beasiswa)
                     • Berita Prestasi & Liputan Sekolah
                     • Fasilitas & Ekstrakurikuler
                                                │
                        ┌───────────────────────┴───────────────────────┐
                        │ (Klik "Portal Guru & Staff")                  │ (Klik Baca Berita/Pengumuman)
                        ▼                                               ▼
            [ Route '/login' (guest) ]                     [ /berita & /pengumuman ]
                        │
             (Input Email & Password)
                        │
                        ▼
            [ AuthController@login ]
                        │
            ┌───────────┴───────────┐
     (Gagal)│                       │(Sukses)
            ▼                       ▼
   Pesan Error Validasi     Regenerasi Session ID
                                    │
                                    ▼
                     [ Route '/dashboard' (auth) ]
                                    │
                                    ▼
                    [ Dashboard Admin Panel Sekolah ]
                     • Statistik Total Berita & Pengumuman
                     • Pantau Jumlah Pendaftar PPDB
                     • Tabel Manajemen Pengumuman
                     • Tabel Manajemen Berita & Prestasi
```

---

## 📋 Checklist Modul Pembelajaran

- [x] **MODUL 1**: Database Seeder Akun Admin & Guru (`DatabaseSeeder.php`)
- [x] **MODUL 2**: Controller Portal Sekolah (`SchoolController.php`)
- [x] **MODUL 3**: Controller Autentikasi & Dashboard (`AuthController.php` & `DashboardController.php`)
- [x] **MODUL 4**: Routing & Middleware Proteksi Guard (`routes/web.php`)
- [x] **MODUL 5**: Master Layout Dark Glassmorphism (`resources/views/layouts/app.blade.php`)
- [x] **MODUL 6**: Tampilan Portal Web Sekolah SMK (`resources/views/school/index.blade.php`)
- [x] **MODUL 7**: Halaman Detail Berita & Pengumuman (`news-detail.blade.php` & `announcement-detail.blade.php`)
- [x] **MODUL 8**: Form Login Guru & Staff (`resources/views/auth/login.blade.php`)
- [x] **MODUL 9**: Dashboard Manajemen Konten Sekolah (`resources/views/dashboard.blade.php`)
- [x] **MODUL 10**: Skenario Pengujian Live Coding & Tantangan Siswi

---

## 📑 MODUL 1: Menyiapkan Akun Guru & Admin di Database

Sebelum membuat form login, siapkan user administrator sekolah di database agar siap diuji saat live coding.

### 1. Buka File [database/seeders/DatabaseSeeder.php](file:///d:/Dev/8.%20Bootcamp/laravel/testlaravel/database/seeders/DatabaseSeeder.php)

```php
<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Admin Utama
        User::updateOrCreate(
            ['email' => 'salsa@gmail.com'],
            [
                'name' => 'Salsa (Admin Web SMK)',
                'password' => Hash::make('salsatinggibgt'),
            ]
        );

        // 2. Akun Guru / Staff Praktek
        User::updateOrCreate(
            ['email' => 'siswi@gmail.com'],
            [
                'name' => 'Siswi Belajar (Guru/Staff)',
                'password' => Hash::make('password123'),
            ]
        );
    }
}
```

Jalankan perintah ini di terminal:

```bash
php artisan migrate:fresh --seed
```

💡 **Poin Penjelasan untuk Siswi:**

- **`Hash::make()`**: Password tidak boleh disimpan berupa teks biasa (plain-text) di database, melainkan wajib dienkripsi dengan algoritma _Bcrypt_ demi standar keamanan data sekolah.
- **`updateOrCreate()`**: Mencegah error duplikasi data jika seeder dijalankan lebih dari satu kali.

---

## 🛠️ MODUL 2: Membuat Controller Portal Sekolah (Public)

Jalankan perintah berikut di terminal:

```bash
php artisan make:controller SchoolController
```

### Buka File [app/Http/Controllers/SchoolController.php](file:///d:/Dev/8.%20Bootcamp/laravel/testlaravel/app/Http/Controllers/SchoolController.php)

Controller ini bertugas menyediakan data master sekolah (profil, statistik, program keahlian, pengumuman, berita, ekstrakurikuler, dan fasilitas):

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SchoolController extends Controller
{
    private function getSchoolData()
    {
        return [
            'info' => [
                'name' => 'SMK Negeri 1 Informatika & Teknologi',
                'short_name' => 'SMKN 1 Tech',
                'tagline' => 'Mencetak Generasi Terampil, Unggul, dan Siap Kerja di Era Digital',
                'description' => 'SMK Pusat Keunggulan berbasis teknologi informasi dan industri kreatif dengan kurikulum berstandar internasional.',
                'accreditation' => 'Akreditasi A (Unggul)',
                'npsn' => '20109876',
                'established_year' => '2008',
                'address' => 'Jl. Pendidikan Digital No. 45, Kawasan Sains & Edukasi',
                'city' => 'Jakarta Selatan, DKI Jakarta 12560',
                'phone' => '+62 21 7890 1234',
                'whatsapp' => '+62 812 3456 7890',
                'email' => 'info@smkn1tech.sch.id',
                'ppdb_email' => 'ppdb@smkn1tech.sch.id',
                'principal' => [
                    'name' => 'Dr. H. Ahmad Fauzi, M.T.',
                    'title' => 'Kepala Sekolah SMKN 1 Tech',
                    'quote' => 'Pendidikan vokasi bukan hanya mentransfer ilmu, tetapi menanamkan etos kerja, daya kreasi, dan kemandirian teknologi.',
                ],
                'socials' => [
                    'youtube' => 'https://youtube.com/@smkn1tech',
                    'instagram' => 'https://instagram.com/smkn1tech',
                    'facebook' => 'https://facebook.com/smkn1tech',
                    'github' => 'https://github.com/smkn1tech',
                ]
            ],
            'stats' => [
                ['number' => '1.250+', 'label' => 'Siswa Aktif', 'icon' => 'fa-solid fa-user-graduate', 'color' => 'text-indigo-400'],
                ['number' => '65+', 'label' => 'Guru & Praktisi Industri', 'icon' => 'fa-solid fa-chalkboard-user', 'color' => 'text-purple-400'],
                ['number' => '48+', 'label' => 'Mitra Perusahaan & DUDI', 'icon' => 'fa-solid fa-handshake', 'color' => 'text-sky-400'],
                ['number' => '98.4%', 'label' => 'Keterserapan Kerja & Wirausaha', 'icon' => 'fa-solid fa-briefcase', 'color' => 'text-emerald-400'],
            ],
            'majors' => [
                [
                    'id' => 1,
                    'slug' => 'pplg',
                    'code' => 'PPLG / RPL',
                    'name' => 'Pengembangan Perangkat Lunak & Gim',
                    'icon' => 'fa-solid fa-code',
                    'badge' => 'Pusat Unggulan',
                    'short_desc' => 'Pemrograman Web modern (Laravel), Mobile Apps (Flutter), Artificial Intelligence, dan Game Development.',
                    'description' => 'Membekali siswa dengan keahlian rekayasa software dari analisis sistem, arsitektur database, coding fullstack, hingga integrasi AI.',
                    'careers' => ['Fullstack Web Developer', 'Mobile App Engineer', 'Game Programmer', 'Database Administrator'],
                    'tools' => ['Laravel & PHP', 'JavaScript & React', 'Flutter & Dart', 'MySQL & Docker'],
                    'quota' => '108 Siswa (3 Kelas)',
                ],
                [
                    'id' => 2,
                    'slug' => 'tjkt',
                    'code' => 'TJKT / TKJ',
                    'name' => 'Teknik Jaringan Komputer & Telekomunikasi',
                    'icon' => 'fa-solid fa-network-wired',
                    'badge' => 'Cisco & Mikrotik Academy',
                    'short_desc' => 'Infrastruktur cloud server, routing mikrotik/cisco, keamanan siber (Cybersecurity), dan fiber optik.',
                    'description' => 'Merancang, mengkonfigurasi, dan mengamankan jaringan enterprise dan cloud infrastructure (AWS/GCP).',
                    'careers' => ['Network Engineer', 'Cyber Security Analyst', 'Cloud Specialist', 'System Administrator'],
                    'tools' => ['Cisco Router', 'MikroTik RouterOS', 'Linux Server', 'Wireshark'],
                    'quota' => '72 Siswa (2 Kelas)',
                ],
                [
                    'id' => 3,
                    'slug' => 'dkv',
                    'code' => 'DKV',
                    'name' => 'Desain Komunikasi Visual & Multimedia',
                    'icon' => 'fa-solid fa-palette',
                    'badge' => 'Creative Hub',
                    'short_desc' => 'UI/UX Design, Video Editing, Motion Graphic, 3D Animation, dan Branding Komersial.',
                    'description' => 'Menuangkan ide visual kreatif ke media digital komersial, periklanan, dan animasi modern.',
                    'careers' => ['UI/UX Designer', 'Motion Graphic Designer', 'Video Editor', '3D Animator'],
                    'tools' => ['Figma', 'Adobe Premiere & After Effects', 'Blender 3D', 'Photoshop'],
                    'quota' => '72 Siswa (2 Kelas)',
                ],
                [
                    'id' => 4,
                    'slug' => 'to',
                    'code' => 'TO / TKR',
                    'name' => 'Teknik Otomotif & Kendaraan Listrik',
                    'icon' => 'fa-solid fa-car-side',
                    'badge' => 'EV Tech Ready',
                    'short_desc' => 'Teknologi injeksi (EFI), kelistrikan modern, dan Electric Vehicle (EV).',
                    'description' => 'Mekanika otomotif modern dengan fasilitas bengkel standar ATPM industri.',
                    'careers' => ['Automotive Diagnostic Technician', 'EV Specialist', 'Service Advisor'],
                    'tools' => ['Engine Scanner', 'Wheel Alignment 3D', 'EV Battery Kit'],
                    'quota' => '72 Siswa (2 Kelas)',
                ],
                [
                    'id' => 5,
                    'slug' => 'akl',
                    'code' => 'AKL',
                    'name' => 'Akuntansi & Keuangan Lembaga (Fintech)',
                    'icon' => 'fa-solid fa-calculator',
                    'badge' => 'Digital Banking Lab',
                    'short_desc' => 'Akuntansi perpajakan digital, Accurate/MYOB, audit, dan financial technology.',
                    'description' => 'Mempersiapkan tenaga ahli akuntansi digital, spreadsheet keuangan kompleks, dan e-faktur perpajakan.',
                    'careers' => ['Staff Akuntan Publik', 'Tax Consultant Assistant', 'Junior Financial Analyst'],
                    'tools' => ['Accurate Online', 'MYOB Accounting', 'Microsoft Excel Specialist'],
                    'quota' => '72 Siswa (2 Kelas)',
                ]
            ],
            'announcements' => [
                [
                    'id' => 1,
                    'title' => 'Pembukaan Pendaftaran Peserta Didik Baru (PPDB) Jalur Prestasi & Reguler TA 2026/2027',
                    'category' => 'PPDB',
                    'category_badge' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/30',
                    'is_pinned' => true,
                    'date' => '15 Agustus 2026',
                    'author' => 'Panitia PPDB SMKN 1 Tech',
                    'summary' => 'Pendaftaran online resmi dibuka. Dapatkan beasiswa prestasi bebas biaya SPP bagi pemegang sertifikat kejuaraan.',
                    'content' => 'Pendaftaran PPDB SMKN 1 Tech dibuka untuk Jalur Prestasi dan Jalur Reguler. Calon siswa dimohon menyiapkan dokumen SKL, nilai rapor semester 1-5, dan sertifikat prestasi.',
                    'file_attachment' => 'Panduan_Resmi_PPDB_2026.pdf',
                ],
                [
                    'id' => 2,
                    'title' => 'Jadwal Asesmen Sumatif Tengah Semester & Uji Kompetensi Kejuruan (UKK)',
                    'category' => 'Akademik',
                    'category_badge' => 'bg-indigo-500/10 text-indigo-400 border-indigo-500/30',
                    'is_pinned' => true,
                    'date' => '12 Agustus 2026',
                    'author' => 'Wakasek Kurikulum',
                    'summary' => 'Seluruh siswa kelas X, XI, dan XII wajib memeriksa jadwal pelaksanaan ujian CBT daring dan praktikum laboratorium.',
                    'content' => 'Pelaksanaan Asesmen Tengah Semester Ganjil akan dimulai secara serentak menggunakan platform CBT sekolah.',
                    'file_attachment' => 'Jadwal_Asesmen_Ganjil_2026.pdf',
                ],
                [
                    'id' => 3,
                    'title' => 'Sosialisasi & Penempatan Praktik Kerja Lapangan (PKL) / Magang Industri',
                    'category' => 'Magang & Hubin',
                    'category_badge' => 'bg-purple-500/10 text-purple-400 border-purple-500/30',
                    'is_pinned' => false,
                    'date' => '08 Agustus 2026',
                    'author' => 'Humas Hubin',
                    'summary' => 'Daftar penempatan 140 siswa ke 35 mitra industri teknologi dan otomotif nasional untuk program magang 6 bulan.',
                    'content' => 'Bagi siswa kelas XII, pembekalan pra-PKL akan diselenggarakan pada hari Senin di Aula Utama.',
                    'file_attachment' => 'Daftar_Mitra_Industri_PKL_2026.pdf',
                ],
                [
                    'id' => 4,
                    'title' => 'Penerimaan Beasiswa Industri Bootcamp & Sertifikasi Internasional AWS Cloud',
                    'category' => 'Beasiswa',
                    'category_badge' => 'bg-amber-500/10 text-amber-400 border-amber-500/30',
                    'is_pinned' => false,
                    'date' => '05 Agustus 2026',
                    'author' => 'Lab Komputer',
                    'summary' => 'Program beasiswa voucher ujian sertifikasi internasional senilai Rp 50.000.000 bagi 25 siswa terpilih.',
                    'content' => 'Kerjasama SMKN 1 Tech dan AWS Educate memberikan voucher sertifikasi cloud resmi.',
                    'file_attachment' => 'Syarat_Beasiswa_AWS_2026.pdf',
                ]
            ],
            'news' => [
                [
                    'id' => 1,
                    'slug' => 'juara-1-lks-nasional-web-technologies-2026',
                    'title' => 'Tim PPLG SMKN 1 Tech Raih Juara 1 Lomba Kompetensi Siswa (LKS) Nasional 2026',
                    'category' => 'Prestasi Siswa',
                    'date' => '14 Agustus 2026',
                    'read_time' => '3 menit baca',
                    'author' => 'Redaksi Humas',
                    'image_icon' => 'fa-solid fa-trophy',
                    'image_gradient' => 'from-indigo-600 via-purple-600 to-pink-600',
                    'summary' => 'Prestasi membanggakan ditorehkan siswa jurusan PPLG yang berhasil meraih Medali Emas LKS Nasional Bidang Web Technologies.',
                    'content' => "Prestasi membanggakan kembali ditorehkan oleh kontingen SMKN 1 Tech. Ananda Rizky Pratama menyabet Juara 1 LKS Nasional Bidang Web Technologies.\n\nKompetisi menguji perancangan arsitektur REST API dengan Laravel dan automated testing. Rizky berpeluang mewakili Indonesia pada WorldSkills ASEAN mendatang.",
                ],
                [
                    'id' => 2,
                    'slug' => 'mou-kerjasama-15-perusahaan-teknologi-otomotif',
                    'title' => 'Perkuat Link and Match: SMKN 1 Tech Teken MoU Kerjasama dengan 15 Perusahaan Industri',
                    'category' => 'Kemitraan Industri',
                    'date' => '10 Agustus 2026',
                    'read_time' => '4 menit baca',
                    'author' => 'Biro Hubin',
                    'image_icon' => 'fa-solid fa-handshake-angle',
                    'image_gradient' => 'from-sky-600 via-blue-600 to-indigo-700',
                    'summary' => 'Komitmen menyelaraskan kurikulum sekolah dengan kebutuhan industri nyata melalui program kelas industri dan rekrutmen kerja.',
                    'content' => "SMKN 1 Tech menandatangani MoU bersama 15 perusahaan teknologi & manufaktur otomotif untuk penyelarasan kurikulum dan penyaluran kerja.",
                ],
            ],
            'extracurriculars' => [
                ['name' => 'Robotik & IoT Club', 'icon' => 'fa-solid fa-robot', 'badge' => 'Juara Nasional', 'desc' => 'Perakitan drone, mikrokontroler, dan sensor IoT.'],
                ['name' => 'Cyber Security & CTF', 'icon' => 'fa-solid fa-shield-virus', 'badge' => 'Spesialis', 'desc' => 'Penetration testing legal dan pertahanan server.'],
                ['name' => 'Game Development', 'icon' => 'fa-solid fa-gamepad', 'badge' => 'Kreatif', 'desc' => 'Perancangan aset game 2D/3D dan Unity Engine.'],
                ['name' => 'Pramuka & PMR', 'icon' => 'fa-solid fa-campground', 'badge' => 'Karakter', 'desc' => 'Kedisiplinan, kepemimpinan, dan kepedulian sosial.'],
            ],
            'facilities' => [
                ['name' => '5 Lab Komputer GPU & Core i7', 'icon' => 'fa-solid fa-desktop', 'desc' => 'Workstation high-end untuk koding dan rendering 3D.'],
                ['name' => 'Bengkel Otomotif Standar ATPM', 'icon' => 'fa-solid fa-wrench', 'desc' => 'Car lift, scanner injeksi digital, dan charging EV.'],
                ['name' => 'Studio Foto & Podcast 4K', 'icon' => 'fa-solid fa-microphone', 'desc' => 'Ruang kedap suara dengan green screen profesional.'],
                ['name' => 'Perpustakaan Digital', 'icon' => 'fa-solid fa-book-open-reader', 'desc' => 'Ribuan e-book, jurnal, dan WiFi berkecepatan tinggi.'],
            ],
            'testimonials' => [
                ['name' => 'Fadhil Ramadhan', 'role' => 'Software Engineer di Unicorn Tech (Alumni PPLG)', 'message' => 'Skill coding Laravel di SMK membuat saya langsung direkrut sebelum wisuda!', 'avatar' => 'fa-solid fa-user-tie'],
                ['name' => 'Sarah Putri', 'role' => 'UI/UX Designer di Startup (Alumni DKV)', 'message' => 'Kurikulum berbasis portofolio membuat karya saya bersaing di level internasional.', 'avatar' => 'fa-solid fa-user-astronaut'],
            ],
            'faqs' => [
                ['q' => 'Kapan pendaftaran siswa baru (PPDB) dibuka?', 'a' => 'PPDB dibuka 2 gelombang: Gelombang 1 (Prestasi) bulan Agustus–Desember, Gelombang 2 (Reguler) mulai Januari.'],
                ['q' => 'Apakah lulusan bisa kuliah ke PTN?', 'a' => 'Sangat bisa! Kurikulum kami memadukan kompetensi vokasi dan akademik untuk jalur Bekerja, Melanjutkan Kuliah, atau Berwirausaha (BMW).'],
            ]
        ];
    }

    public function index()
    {
        $data = $this->getSchoolData();
        return view('school.index', $data);
    }

    public function newsDetail($slug = null)
    {
        $data = $this->getSchoolData();
        $newsList = $data['news'];
        $info = $data['info'];
        $article = collect($newsList)->firstWhere('slug', $slug) ?? $newsList[0];
        $recentNews = collect($newsList)->where('slug', '!=', $article['slug'])->take(3);

        return view('school.news-detail', compact('article', 'recentNews', 'info'));
    }

    public function announcementDetail($id = null)
    {
        $data = $this->getSchoolData();
        $announcements = $data['announcements'];
        $info = $data['info'];
        $announcement = collect($announcements)->firstWhere('id', (int)$id) ?? $announcements[0];
        $otherAnnouncements = collect($announcements)->where('id', '!=', $announcement['id'])->take(3);

        return view('school.announcement-detail', compact('announcement', 'otherAnnouncements', 'info'));
    }

    public function majorDetail($slug = null)
    {
        $data = $this->getSchoolData();
        $majors = $data['majors'];
        $info = $data['info'];
        $major = collect($majors)->firstWhere('slug', $slug) ?? $majors[0];
        $otherMajors = collect($majors)->where('slug', '!=', $major['slug']);

        return view('school.major-detail', compact('major', 'otherMajors', 'info'));
    }
}
```

---

## 🔐 MODUL 3: Controller Autentikasi & Dashboard Admin

Jalankan perintah pembuatan controller:

```bash
php artisan make:controller AuthController
php artisan make:controller DashboardController
```

### 1. Edit [app/Http/Controllers/AuthController.php](file:///d:/Dev/8.%20Bootcamp/laravel/testlaravel/app/Http/Controllers/AuthController.php)

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan Form Login Guru/Staff
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Memproses Autentikasi Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required'    => 'Alamat email tidak boleh kosong.',
            'email.email'       => 'Format email tidak valid (contoh: guru@smkn1tech.sch.id).',
            'password.required' => 'Kata sandi tidak boleh kosong.',
        ]);

        $remember = $request->boolean('remember');

        // Percobaan Login dengan Auth::attempt()
        if (Auth::attempt($credentials, $remember)) {
            // Mencegah Session Fixation Attack
            $request->session()->regenerate();

            return redirect()->intended('/dashboard')
                             ->with('success', 'Selamat datang kembali, ' . Auth::user()->name . '! 👋');
        }

        // Jika Gagal
        return back()->withErrors([
            'email' => 'Email atau kata sandi yang Anda masukkan tidak sesuai.',
        ])->onlyInput('email');
    }

    // Memproses Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
                         ->with('success', 'Anda telah berhasil keluar dari Panel Admin.');
    }
}
```

---

### 2. Edit [app/Http/Controllers/DashboardController.php](file:///d:/Dev/8.%20Bootcamp/laravel/testlaravel/app/Http/Controllers/DashboardController.php)

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Tampilkan Halaman Dashboard Admin / Guru Sekolah
     */
    public function index()
    {
        $user = Auth::user();

        $schoolStats = [
            'total_news'          => 14,
            'active_announcements'=> 4,
            'ppdb_applicants'     => 348,
            'active_students'     => '1.250',
        ];

        $managedAnnouncements = [
            ['id' => 1, 'title' => 'Pembukaan PPDB Jalur Prestasi & Reguler TA 2026/2027', 'category' => 'PPDB', 'author' => 'Panitia PPDB', 'status' => 'Dipublikasikan', 'is_pinned' => true, 'date' => '15 Agu 2026'],
            ['id' => 2, 'title' => 'Jadwal Asesmen Sumatif Tengah Semester & UKK Mandiri', 'category' => 'Akademik', 'author' => 'Wakasek Kurikulum', 'status' => 'Dipublikasikan', 'is_pinned' => true, 'date' => '12 Agu 2026'],
            ['id' => 3, 'title' => 'Sosialisasi & Penempatan PKL / Magang Industri', 'category' => 'Magang & Hubin', 'author' => 'Humas Hubin', 'status' => 'Dipublikasikan', 'is_pinned' => false, 'date' => '08 Agu 2026'],
        ];

        $managedNews = [
            ['id' => 1, 'title' => 'Tim PPLG SMKN 1 Tech Raih Juara 1 LKS Nasional Web Technologies', 'category' => 'Prestasi Siswa', 'views' => '1.420', 'status' => 'Tayang', 'date' => '14 Agu 2026'],
            ['id' => 2, 'title' => 'SMKN 1 Tech Teken MoU Kerjasama dengan 15 Perusahaan Industri', 'category' => 'Kemitraan Industri', 'views' => '890', 'status' => 'Tayang', 'date' => '10 Agu 2026'],
        ];

        return view('dashboard', compact('user', 'schoolStats', 'managedAnnouncements', 'managedNews'));
    }
}
```

---

## 🚦 MODUL 4: Mengatur Routes & Middleware Guard

### Edit File [routes/web.php](file:///d:/Dev/8.%20Bootcamp/laravel/testlaravel/routes/web.php)

```php
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SchoolController;
use Illuminate\Support\Facades\Route;

// -------------------------------------------------------------
// 1. PORTAL WEB SEKOLAH SMK (PUBLIC ROUTES)
// -------------------------------------------------------------
Route::get('/', [SchoolController::class, 'index'])->name('home');
Route::get('/berita/{slug?}', [SchoolController::class, 'newsDetail'])->name('news.detail');
Route::get('/pengumuman/{id?}', [SchoolController::class, 'announcementDetail'])->name('announcement.detail');
Route::get('/jurusan/{slug?}', [SchoolController::class, 'majorDetail'])->name('major.detail');

// -------------------------------------------------------------
// 2. GUEST ROUTES (Hanya untuk pengunjung yang BELUM LOGIN)
// -------------------------------------------------------------
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// -------------------------------------------------------------
// 3. AUTH ROUTES (Hanya untuk GURU/ADMIN yang SUDAH LOGIN)
// -------------------------------------------------------------
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
```

💡 **Poin Penjelasan untuk Siswi:**

- Route `/` dapat diakses bebas oleh masyarakat umum.
- Middleware `guest` mengalihkan user yang sudah login langsung ke `/dashboard` saat mencoba mengakses `/login`.
- Middleware `auth` mengunci `/dashboard` dari orang yang belum memasukkan kredensial login.

---

## 🎨 MODUL 5: Master Layout Blade

### File [resources/views/layouts/app.blade.php](file:///d:/Dev/8.%20Bootcamp/laravel/testlaravel/resources/views/layouts/app.blade.php)

```blade
<!DOCTYPE html>
<html lang="id" class="dark h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SMKN 1 Tech - Portal Sekolah')</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        .glass-card {
            background: rgba(15, 23, 42, 0.75);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
    </style>
</head>
<body class="h-full bg-[#090d16] text-slate-100 antialiased relative">
    @yield('content')
    @stack('scripts')
</body>
</html>
```

---

## 🏫 MODUL 6: Form Login Guru & Staff

### File [resources/views/auth/login.blade.php](file:///d:/Dev/8.%20Bootcamp/laravel/testlaravel/resources/views/auth/login.blade.php)

```blade
@extends('layouts.app')

@section('title', 'Login Guru & Staff - SMKN 1 Tech')

@section('content')
<div class="min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-8">
    <div class="w-full max-w-md">

        <!-- Tombol Kembali ke Portal Sekolah -->
        <div class="mb-5 text-left">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-400 hover:text-indigo-300 transition py-1.5 px-3.5 rounded-xl bg-slate-900/80 border border-slate-800 shadow-sm">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Kembali ke Website Portal SMK</span>
            </a>
        </div>

        <!-- Glass Card Form Login -->
        <div class="glass-card p-8 sm:p-10 rounded-3xl shadow-2xl relative overflow-hidden">
            <!-- Accent Top Line -->
            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>

            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 text-white shadow-lg shadow-indigo-500/30 mb-4 animate-float">
                    <i class="fa-solid fa-graduation-cap text-2xl"></i>
                </div>
                <h1 class="text-2xl font-extrabold text-white tracking-tight">Portal Guru &amp; Staff</h1>
                <p class="text-xs sm:text-sm text-slate-400 mt-1">Panel Administrasi Web SMKN 1 Tech</p>
            </div>

            <!-- Form Autentikasi -->
            <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Input Email -->
                <div>
                    <label for="email" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Alamat Email Guru / Admin</label>
                    <div class="relative">
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required placeholder="guru@smkn1tech.sch.id"
                               class="w-full pl-4 pr-4 py-3 rounded-xl bg-slate-950/70 border border-slate-800 focus:border-indigo-500 text-white placeholder-slate-500 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-indigo-500/40 transition">
                    </div>
                    @error('email')
                        <p class="mt-1.5 text-xs text-rose-400 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Input Password -->
                <div>
                    <label for="password" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Kata Sandi</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" required placeholder="••••••••"
                               class="w-full pl-4 pr-10 py-3 rounded-xl bg-slate-950/70 border border-slate-800 focus:border-indigo-500 text-white text-sm font-medium focus:outline-none focus:ring-2 focus:ring-indigo-500/40 transition">
                        <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-500 hover:text-slate-300">
                            <i id="eye-icon" class="fa-regular fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded bg-slate-950 border-slate-800 text-indigo-600">
                        <span class="text-xs text-slate-400">Ingat Saya di Perangkat Ini</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-3.5 px-4 bg-gradient-to-r from-indigo-600 via-indigo-500 to-purple-600 text-white font-bold rounded-xl shadow-lg flex items-center justify-center gap-2 text-sm hover:scale-[1.02] active:scale-[0.98] transition">
                    <span>Masuk ke Panel Admin</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </button>
            </form>

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
```

---

## 📊 MODUL 7: Dashboard Admin Sekolah

### File [resources/views/dashboard.blade.php](file:///d:/Dev/8.%20Bootcamp/laravel/testlaravel/resources/views/dashboard.blade.php)

Halaman ini menyediakan:

1. **Navigasi Atas**: Tombol pintas **"Lihat Web Sekolah"**, avatar user, dan tombol **"Logout"**.
2. **Hero Greeting Banner**: Ucapan selamat datang interaktif untuk Admin/Guru.
3. **4 Kartu Metrik Statistik**: Total Berita Terbit, Pengumuman Aktif, Pendaftar PPDB, dan Jumlah Siswa Aktif.
4. **Tabel Manajemen Pengumuman**: Daftar pengumuman dengan status publikasi dan tombol aksi (_Lihat di Web_, _Edit_, _Hapus_).
5. **Tabel Manajemen Berita & Prestasi**: Jumlah pembaca (_views_), tanggal rilis, dan tombol aksi.
6. **Modal Interaktif Tambah Pengumuman & Berita**: Form popup untuk simulasi pembuatan konten.

---

## 🧪 MODUL 8: Skenario Live Coding & Praktik Bersama Siswi

Ajak siswi menjalankan skenario interaktif langkah demi langkah:

### Skenario 1: Menjalankan Server & Menjelajah Web Sekolah

1. Jalankan perintah: `php artisan serve`
2. Buka `http://127.0.0.1:8000` di browser.
3. Tunjukkan kepada siswi bagaimana data di `SchoolController.php` tampil di `index.blade.php` menggunakan directive `@foreach($majors as $major)` dan `@foreach($announcements as $ann)`.

### Skenario 2: Masuk ke Panel Guru / Admin

1. Klik tombol **"Portal Guru & Staff"** di pojok kanan atas navbar.
2. Coba klik tombol submit tanpa mengisi email untuk mendemonstrasikan **validasi form Laravel**.
3. Masukkan email: `siswi@gmail.com` dan password: `password123`.
4. Amati pengalihan otomatis ke `/dashboard` dengan pesan flash notification.

### Skenario 3: Menguji Proteksi Middleware Guard

1. Di halaman dashboard, buka tab baru dan coba akses `http://127.0.0.1:8000/login`.
    - _Hasil:_ Laravel otomatis mengalihkan kembali ke `/dashboard` berkat middleware `guest`.
2. Klik tombol **"Logout"**.
3. Coba akses langsung `http://127.0.0.1:8000/dashboard`.
    - _Hasil:_ Laravel otomatis memblokir akses dan mengalihkan ke `/login` berkat middleware `auth`.

---

## 💡 Tantangan Mandiri untuk Siswi (Tugas Praktek):

1. **Ubah Identitas Sekolah**:
    - Buka `SchoolController.php` dan sesuaikan nama sekolah, alamat, serta logo sesuai sekolah impian siswi.
2. **Tambah Jurusan Baru**:
    - Tambahkan 1 jurusan baru pada array `$majors` (misal: _Teknik Mekatronika_ atau _Broadcasting_).
3. **Tambah Pengumuman Baru**:
    - Tambahkan 1 data pengumuman baru pada array `$announcements` di `SchoolController.php` dan `DashboardController.php`.
