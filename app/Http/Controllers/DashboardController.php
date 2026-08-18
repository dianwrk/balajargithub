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

        // Data statistik panel admin sekolah
        $schoolStats = [
            'total_news' => 14,
            'active_announcements' => 4,
            'ppdb_applicants' => 348,
            'active_students' => '1.250',
        ];

        // Daftar pengumuman sekolah yang dikelola admin
        $managedAnnouncements = [
            [
                'id' => 1,
                'title' => 'Pembukaan PPDB Jalur Prestasi & Reguler TA 2026/2027',
                'category' => 'PPDB',
                'author' => 'Panitia PPDB',
                'status' => 'Dipublikasikan',
                'is_pinned' => true,
                'date' => '15 Agu 2026'
            ],
            [
                'id' => 2,
                'title' => 'Jadwal Asesmen Sumatif Tengah Semester & UKK Mandiri',
                'category' => 'Akademik',
                'author' => 'Wakasek Kurikulum',
                'status' => 'Dipublikasikan',
                'is_pinned' => true,
                'date' => '12 Agu 2026'
            ],
            [
                'id' => 3,
                'title' => 'Sosialisasi & Penempatan PKL / Magang Industri Semester Ganjil',
                'category' => 'Magang & Hubin',
                'author' => 'Humas Hubin',
                'status' => 'Dipublikasikan',
                'is_pinned' => false,
                'date' => '08 Agu 2026'
            ],
            [
                'id' => 4,
                'title' => 'Penerimaan Beasiswa Industri Bootcamp & AWS Cloud',
                'category' => 'Beasiswa',
                'author' => 'Lab Komputer',
                'status' => 'Draf Siap Terbit',
                'is_pinned' => false,
                'date' => '05 Agu 2026'
            ],
        ];

        // Daftar artikel berita yang dikelola admin
        $managedNews = [
            [
                'id' => 1,
                'title' => 'Tim PPLG SMKN 1 Tech Raih Juara 1 LKS Nasional Web Technologies',
                'category' => 'Prestasi Siswa',
                'views' => '1.420',
                'status' => 'Tayang',
                'date' => '14 Agu 2026'
            ],
            [
                'id' => 2,
                'title' => 'SMKN 1 Tech Teken MoU Kerjasama dengan 15 Perusahaan Industri',
                'category' => 'Kemitraan Industri',
                'views' => '890',
                'status' => 'Tayang',
                'date' => '10 Agu 2026'
            ],
            [
                'id' => 3,
                'title' => 'Pameran Tech Expo 2026: Ratusan Inovasi Siswa Dipamerkan',
                'category' => 'Karya Inovasi',
                'views' => '1.150',
                'status' => 'Tayang',
                'date' => '04 Agu 2026'
            ],
        ];

        return view('dashboard', compact('user', 'schoolStats', 'managedAnnouncements', 'managedNews'));
    }
}
