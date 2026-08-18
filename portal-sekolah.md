# 🏫 Panduan Live Coding: Pembuatan Portal Web Sekolah SMK (Landing Page, Berita, & Pengumuman)

Modul ini adalah **panduan live coding dan referensi mengajar** untuk mendampingi siswi dalam mengembangkan **Portal Web Sekolah SMK** berbasis Laravel 11. Modul ini melengkapi sistem autentikasi [login.md](file:///d:/Dev/8.%20Bootcamp/laravel/testlaravel/login.md) yang telah dibuat sebelumnya.

---

## 🎯 Arsitektur Alur Sistem (Flow)

```
Pengunjung / Calon Siswa (PPDB) / Siswa
              │
              ▼
   [ Route '/' (GET) ]  ──────────>  [ SchoolController@index ]
                                                │
                                    ┌───────────┴───────────┐
                                    ▼                       ▼
                              Array Data              View Blade
                           (Info, Berita,        (resources/views/school/
                           Pengumuman, dll)            index.blade.php)
                                                │
                                                ▼
                                    [ Halaman Portal SMK ]
                                                │
               ┌────────────────────────────────┴────────────────────────────────┐
               ▼                                                                 ▼
   [ Klik Baca Berita / Pengumuman ]                                 [ Klik "Portal Masuk Guru" ]
               │                                                                 │
               ▼                                                                 ▼
[ /berita/{slug} & /pengumuman/{id} ]                                   [ /login (AuthController) ]
                                                                                 │
                                                                                 ▼
                                                                        [ /dashboard (Staff) ]
```

---

## 📑 Struktur File yang Telah Dibuat

1. **Controller Master Data**:
   - [`app/Http/Controllers/SchoolController.php`](file:///d:/Dev/8.%20Bootcamp/laravel/testlaravel/app/Http/Controllers/SchoolController.php)
2. **Routing Web**:
   - [`routes/web.php`](file:///d:/Dev/8.%20Bootcamp/laravel/testlaravel/routes/web.php)
3. **Tampilan Blade (Views)**:
   - Beranda Portal: [`resources/views/school/index.blade.php`](file:///d:/Dev/8.%20Bootcamp/laravel/testlaravel/resources/views/school/index.blade.php)
   - Detail Berita: [`resources/views/school/news-detail.blade.php`](file:///d:/Dev/8.%20Bootcamp/laravel/testlaravel/resources/views/school/news-detail.blade.php)
   - Detail Pengumuman: [`resources/views/school/announcement-detail.blade.php`](file:///d:/Dev/8.%20Bootcamp/laravel/testlaravel/resources/views/school/announcement-detail.blade.php)
   - Detail Jurusan: [`resources/views/school/major-detail.blade.php`](file:///d:/Dev/8.%20Bootcamp/laravel/testlaravel/resources/views/school/major-detail.blade.php)

---

## 🧭 Langkah Praktik Live Coding untuk Siswi

### 1. Memahami Alur Data Controller ke Blade
Tunjukkan kepada siswi bagaimana data dioper dari `SchoolController.php` ke file view blade:

```php
// Di SchoolController.php
public function index()
{
    $data = $this->getSchoolData();
    $news = $data['news'];
    $announcements = $data['announcements'];
    
    // Fungsi compact() mengoper variabel $news dan $announcements ke view
    return view('school.index', compact('news', 'announcements'));
}
```

### 2. Menampilkan Data dengan Perulangan `@foreach` di Blade
Jelaskan cara menampilkan daftar berita secara dinamis di `index.blade.php`:

```blade
@foreach($news as $item)
    <div class="glass-card p-5 rounded-3xl">
        <span class="badge">{{ $item['category'] }}</span>
        <h3>{{ $item['title'] }}</h3>
        <p>{{ $item['summary'] }}</p>
        <a href="{{ route('news.detail', $item['slug']) }}">Baca Selengkapnya</a>
    </div>
@endforeach
```

### 3. Mengatur Navigasi Dua Arah
- Dari **Portal Sekolah (`/`)** ke **Login (`/login`)**: Menggunakan `<a href="{{ route('login') }}">Portal Guru</a>`.
- Dari **Login** kembali ke **Portal Sekolah**: Menggunakan `<a href="{{ route('home') }}">Kembali ke Web Sekolah</a>`.
- Dari **Dashboard (`/dashboard`)** ke **Portal Sekolah**: Menggunakan tombol **"Website Sekolah"** di navbar.

---

## 💡 Ide Latihan & Tantangan untuk Siswi

Ajak siswi Anda untuk mempraktikkan hal-hal berikut:

1. **Ubah Profil & Nama Sekolah**:
   - Buka `SchoolController.php` pada fungsi `getSchoolData()`.
   - Ubah nama sekolah, alamat, nomor WhatsApp, dan akun media sosial sesuai sekolah masing-masing.

2. **Tambah Berita Baru**:
   - Tambahkan elemen baru ke dalam array `'news'` di `SchoolController.php`.
   - Cek apakah berita baru langsung muncul secara otomatis di halaman utama.

3. **Tambah Jurusan Baru**:
   - Tambahkan jurusan baru (misalnya: *Animasi*, *Teknik Logistik*, atau *Broadcasting*) pada array `'majors'`.

4. **Kembangkan ke Database (Materi Tingkat Lanjut)**:
   - Buat migration: `php artisan make:migration create_news_table` dan `php artisan make:migration create_announcements_table`.
   - Ubah pemanggilan data dari array statis menjadi `News::latest()->get()`.

---

## 🚀 Menjalankan Project

Jalankan perintah ini di terminal:
```bash
php artisan serve
```
Buka browser pada:
- **Portal Web Sekolah**: [http://127.0.0.1:8000](http://127.0.0.1:8000)
- **Halaman Login Guru**: [http://127.0.0.1:8000/login](http://127.0.0.1:8000/login)
- **Dashboard**: [http://127.0.0.1:8000/dashboard](http://127.0.0.1:8000/dashboard) *(Gunakan akun `siswi@gmail.com` / `password123`)*
