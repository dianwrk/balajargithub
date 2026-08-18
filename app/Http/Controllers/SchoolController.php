<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Data master sekolah (Bisa dikembangkan menjadi Model/Database di materi lanjutan)
     */
    private function getSchoolData()
    {
        return [
            'info' => [
                'name' => 'SMK Negeri 1 Informatika & Teknologi',
                'short_name' => 'SMKN 1 Tech',
                'tagline' => 'Mencetak Generasi Terampil, Unggul, dan Siap Kerja di Era Digital',
                'description' => 'SMK Pusat Keunggulan (Center of Excellence) berbasis teknologi informasi dan industri kreatif dengan kurikulum berstandar industri internasional.',
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
                    'quote' => 'Pendidikan vokasi bukan hanya tentang mentransfer ilmu, tetapi menanamkan etos kerja, daya kreasi, dan kemandirian teknologi untuk masa depan bangsa.',
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
                    'color' => 'indigo',
                    'short_desc' => 'Mempelajari pemrograman Web modern (Laravel/Vue), Mobile Apps (Flutter/React Native), Artificial Intelligence, dan Game Development.',
                    'description' => 'Jurusan Pengembangan Perangkat Lunak dan Gim (PPLG) membekali siswa dengan keahlian rekayasa software mulai dari analisis kebutuhan sistem, desain arsitektur data, coding backend/frontend, DevOps, hingga integrasi AI dan penerbitan aplikasi komersial.',
                    'careers' => ['Fullstack Web Developer', 'Mobile App Engineer', 'Game Programmer', 'Software QA Tester', 'Database Administrator'],
                    'tools' => ['Laravel & PHP', 'JavaScript & React', 'Flutter & Dart', 'MySQL & PostgreSQL', 'Docker & Git'],
                    'quota' => '108 Siswa (3 Kelas)',
                ],
                [
                    'id' => 2,
                    'slug' => 'tjkt',
                    'code' => 'TJKT / TKJ',
                    'name' => 'Teknik Jaringan Komputer & Telekomunikasi',
                    'icon' => 'fa-solid fa-network-wired',
                    'badge' => 'Cisco & Mikrotik Academy',
                    'color' => 'sky',
                    'short_desc' => 'Menguasai infrastruktur cloud server, routing mikrotik/cisco, keamanan siber (Cybersecurity), dan instalasi fiber optik.',
                    'description' => 'Jurusan TJKT melatih peserta didik dalam merancang, mengkonfigurasi, memelihara, dan mengamankan jaringan komputer skala enterprise, cloud computing infrastructure (AWS/GCP), serta jaringan telekomunikasi berkecepatan tinggi.',
                    'careers' => ['Network Engineer', 'Cyber Security Analyst', 'Cloud Infrastructure Specialist', 'System Administrator', 'DevOps Support'],
                    'tools' => ['Cisco Packet Tracer & Router', 'MikroTik RouterOS', 'Linux Server (Ubuntu/Debian)', 'Wireshark Security', 'Fiber Optic Splicing'],
                    'quota' => '72 Siswa (2 Kelas)',
                ],
                [
                    'id' => 3,
                    'slug' => 'dkv',
                    'code' => 'DKV',
                    'name' => 'Desain Komunikasi Visual & Multimedia',
                    'icon' => 'fa-solid fa-palette',
                    'badge' => 'Creative Hub',
                    'color' => 'pink',
                    'short_desc' => 'Fokus pada UI/UX Design, Video Editing & Motion Graphic, 3D Modeling animasi, dan strategi Branding Komersial.',
                    'description' => 'Jurusan DKV membimbing siswa menuangkan ide kreatif menjadi karya visual bernilai tinggi. Siswa belajar UI/UX aplikasi digital, fotografi & videografi komersial, animasi 3D, branding agensi, dan desain periklanan kreatif.',
                    'careers' => ['UI/UX Designer', 'Motion Graphic Designer', 'Video Creator & Editor', '3D Animator', 'Brand Identity Specialist'],
                    'tools' => ['Figma & Adobe XD', 'Adobe After Effects & Premiere', 'Blender 3D', 'Photoshop & Illustrator', 'DaVinci Resolve'],
                    'quota' => '72 Siswa (2 Kelas)',
                ],
                [
                    'id' => 4,
                    'slug' => 'to',
                    'code' => 'TO / TKR',
                    'name' => 'Teknik Otomotif & Kendaraan Listrik',
                    'icon' => 'fa-solid fa-car-side',
                    'badge' => 'EV Tech Ready',
                    'color' => 'amber',
                    'short_desc' => 'Mempelajari teknologi otomotif mutakhir, Electronic Fuel Injection (EFI), sistem kelistrikan pintar, dan Electric Vehicle (EV).',
                    'description' => 'Jurusan Teknik Otomotif menggabungkan mekanika mesin modern dengan teknologi kelistrikan canggih dan era transisi kendaraan listrik (EV), didukung bengkel standar industri.',
                    'careers' => ['Automotive Diagnostic Technician', 'EV Specialist', 'Service Advisor Workshop', 'Fleet Maintenance Manager', 'Wirausaha Bengkel Modern'],
                    'tools' => ['Engine Diagnostic Scanner', 'Wheel Alignment 3D', 'EV Battery Management Kit', 'Common Rail Injection Test', 'Smart Dyno Test'],
                    'quota' => '72 Siswa (2 Kelas)',
                ],
                [
                    'id' => 5,
                    'slug' => 'akl',
                    'code' => 'AKL',
                    'name' => 'Akuntansi & Keuangan Lembaga (Fintech)',
                    'icon' => 'fa-solid fa-calculator',
                    'badge' => 'Digital Banking Lab',
                    'color' => 'emerald',
                    'short_desc' => 'Penguasaan akuntansi perpajakan digital, software keuangan Accurate/MYOB, audit keuangan, dan financial technology.',
                    'description' => 'Mempersiapkan tenaga ahli akuntansi yang melek teknologi finansial (Fintech), mahir pembukuan digital, pengolahan spreadsheet keuangan kompleks, e-faktur perpajakan, dan perbankan digital.',
                    'careers' => ['Staff Akuntan Publik', 'Tax Consultant Assistant', 'Junior Financial Analyst', 'Bank Teller / Customer Service', 'Auditor Internal'],
                    'tools' => ['Accurate Online', 'MYOB Accounting', 'Microsoft Excel Specialist', 'E-SPT Perpajakan', 'Mini Bank Software'],
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
                    'date_badge' => '15 AGU',
                    'author' => 'Panitia PPDB SMKN 1 Tech',
                    'summary' => 'Pendaftaran online resmi dibuka melalui portal PPDB. Dapatkan potongan biaya dan beasiswa prestasi bebas SPP bagi pemegang sertifikat kejuaraan tingkat Kota/Provinsi/Nasional.',
                    'content' => 'Pendaftaran Peserta Didik Baru (PPDB) SMK Negeri 1 Informatika & Teknologi untuk Tahun Ajaran 2026/2027 telah resmi dibuka. Terdapat dua jalur penerimaan: 1) Jalur Prestasi Akademik & Non-Akademik (Bebas Tes Tulis), dan 2) Jalur Reguler & Minat Bakat Vokasi. Calon peserta didik dimohon mempersiapkan dokumen: Surat Keterangan Lulus SMP/MTs, Nilai Rapor semester 1-5, dan Sertifikat Kejuaraan jika ada.',
                    'file_attachment' => 'Panduan_Resmi_PPDB_2026.pdf',
                ],
                [
                    'id' => 2,
                    'title' => 'Jadwal Asesmen Sumatif Tengah Semester & Uji Kompetensi Kejuruan (UKK) Mandiri',
                    'category' => 'Akademik',
                    'category_badge' => 'bg-indigo-500/10 text-indigo-400 border-indigo-500/30',
                    'is_pinned' => true,
                    'date' => '12 Agustus 2026',
                    'date_badge' => '12 AGU',
                    'author' => 'Wakasek Kurikulum',
                    'summary' => 'Seluruh siswa kelas X, XI, dan XII wajib memeriksa jadwal pelaksanaan ujian CBT daring dan praktikum kejuruan laboratorium.',
                    'content' => 'Pelaksanaan Asesmen Tengah Semester Ganjil akan dimulai secara serentak menggunakan platform Computer Based Test (CBT) sekolah. Siswa dihimbau membawa laptop atau menggunakan fasilitas PC Lab yang telah dijadwalkan oleh proktor masing-masing kelas.',
                    'file_attachment' => 'Jadwal_Asesmen_Ganjil_2026.pdf',
                ],
                [
                    'id' => 3,
                    'title' => 'Sosialisasi & Penempatan Praktik Kerja Lapangan (PKL) / Magang Industri Semester Ganjil',
                    'category' => 'Magang & Hubin',
                    'category_badge' => 'bg-purple-500/10 text-purple-400 border-purple-500/30',
                    'is_pinned' => false,
                    'date' => '08 Agustus 2026',
                    'date_badge' => '08 AGU',
                    'author' => 'Humas & Hubungan Industri (Hubin)',
                    'summary' => 'Daftar penempatan 140 siswa ke 35 mitra industri teknologi dan otomotif nasional untuk program magang 6 bulan.',
                    'content' => 'Bagi siswa kelas XII seluruh program keahlian, pembekalan pra-PKL akan diselenggarakan pada hari Senin di Aula Utama. Siswa akan mendapatkan perlengkapan identitas magang, kartu asuransi ketenagakerjaan vokasi, dan surat pengantar resmi ke perusahaan.',
                    'file_attachment' => 'Daftar_Mitra_Industri_PKL_2026.pdf',
                ],
                [
                    'id' => 4,
                    'title' => 'Penerimaan Beasiswa Industri Bootcamp & Sertifikasi Internasional AWS Cloud Practitioner',
                    'category' => 'Beasiswa',
                    'category_badge' => 'bg-amber-500/10 text-amber-400 border-amber-500/30',
                    'is_pinned' => false,
                    'date' => '05 Agustus 2026',
                    'date_badge' => '05 AGU',
                    'author' => 'Lab Komputer & Sertifikasi',
                    'summary' => 'Program beasiswa voucher ujian sertifikasi internasional senilai total Rp 50.000.000 bagi 25 siswa terpilih jurusan PPLG dan TJKT.',
                    'content' => 'Kerjasama antara SMKN 1 Tech dan AWS Educate memberikan kesempatan 25 voucher ujian sertifikasi resmi secara gratis. Seleksi internal mencakup tes logika algoritma dan dasar jaringan komputer.',
                    'file_attachment' => 'Syarat_Beasiswa_AWS_2026.pdf',
                ]
            ],
            'news' => [
                [
                    'id' => 1,
                    'slug' => 'juara-1-lks-nasional-web-technologies-2026',
                    'title' => 'Tim PPLG SMKN 1 Tech Raih Juara 1 Lomba Kompetensi Siswa (LKS) Tingkat Nasional 2026',
                    'category' => 'Prestasi Siswa',
                    'category_color' => 'indigo',
                    'date' => '14 Agustus 2026',
                    'read_time' => '3 menit baca',
                    'author' => 'Redaksi Humas',
                    'image_icon' => 'fa-solid fa-trophy',
                    'image_gradient' => 'from-indigo-600 via-purple-600 to-pink-600',
                    'summary' => 'Prestasi membanggakan kembali ditorehkan oleh siswa jurusan PPLG yang berhasil meraih Medali Emas pada ajang LKS Nasional ke-34 Bidang Web Technologies.',
                    'content' => "Prestasi membanggakan kembali ditorehkan oleh kontingen SMKN 1 Informatika & Teknologi. Dalam ajang bergengsi Lomba Kompetensi Siswa (LKS) Nasional ke-34, ananda Rizky Pratama (Kelas XII PPLG 1) berhasil menyabet Juara 1 (Medali Emas) Bidang Web Technologies.\n\nKompetisi yang berlangsung selama 4 hari ini menguji kemampuan peserta dalam merancang arsitektur backend REST API dengan Laravel, reactive frontend SPA, serta pengujian sistem otomatis (automated testing). Prestasi ini membuka jalan bagi Rizky untuk mewakili Indonesia pada ajang WorldSkills ASEAN mendatang.\n\nKepala Sekolah SMKN 1 Tech menyampaikan apresiasi yang setinggi-tingginya kepada tim pembimbing dan orang tua yang terus mendukung pengembangan talenta siswa secara konsisten.",
                ],
                [
                    'id' => 2,
                    'slug' => 'mou-kerjasama-15-perusahaan-teknologi-otomotif',
                    'title' => 'Perkuat Link and Match: SMKN 1 Tech Teken MoU Kerjasama dengan 15 Perusahaan Industri Terkemuka',
                    'category' => 'Kemitraan Industri',
                    'category_color' => 'sky',
                    'date' => '10 Agustus 2026',
                    'read_time' => '4 menit baca',
                    'author' => 'Biro Kerjasama Hubin',
                    'image_icon' => 'fa-solid fa-handshake-angle',
                    'image_gradient' => 'from-sky-600 via-blue-600 to-indigo-700',
                    'summary' => 'Komitmen menyelaraskan kurikulum sekolah dengan kebutuhan industri nyata melalui program kelas industri, guru tamu, dan jaminan rekrutmen kerja.',
                    'content' => "Guna memastikan setiap lulusan memiliki kompetensi relevan dan langsung diserap dunia kerja, SMKN 1 Tech menandatangani Memorandum of Understanding (MoU) dengan 15 perusahaan papan atas bidang Software House, Internet Service Provider, Agensi Kreatif, dan Manufaktur Otomotif.\n\nKerjasama ini mencakup kurikulum sinkronisasi, penyediaan guru tamu praktisi industri setiap minggu, penyaluran magang bersertifikat, dan rekrutmen langsung bagi lulusan berprestasi.",
                ],
                [
                    'id' => 3,
                    'slug' => 'pameran-gelar-karya-inovasi-startup-siswa',
                    'title' => 'Pameran Tech Expo 2026: Ratusan Produk Aplikasi, Robotik, dan Karya Animasi Siswa Dipamerkan ke Publik',
                    'category' => 'Karya Inovasi',
                    'category_color' => 'purple',
                    'date' => '04 Agustus 2026',
                    'read_time' => '5 menit baca',
                    'author' => 'Tim Media Kreatif',
                    'image_icon' => 'fa-solid fa-rocket',
                    'image_gradient' => 'from-purple-600 via-pink-600 to-rose-600',
                    'summary' => 'Lebih dari 40 proyek unggulan hasil teaching factory dan tugas akhir siswa dipresentasikan di hadapan investor dan perwakilan industri.',
                    'content' => "Aula SMKN 1 Tech dipadati ratusan pengunjung dalam gelaran tahunan 'Tech Expo & Startup Innovation 2026'. Berbagai karya inovatif dipamerkan, mulai dari aplikasi IoT pemantau kelembaban smart farming, aplikasi kasir UMKM berbasis cloud, film animasi pendek 3D, hingga motor konversi listrik ramah lingkungan buatan siswa teknik otomotif.",
                ],
                [
                    'id' => 4,
                    'slug' => 'workshop-ai-dan-cybersecurity-bersama-ahli-global',
                    'title' => 'SMKN 1 Tech Gelar Workshop Masterclass Generative AI & Cyber Defense untuk Guru dan Siswa',
                    'category' => 'Akademik & Workshop',
                    'category_color' => 'emerald',
                    'date' => '28 Juli 2026',
                    'read_time' => '3 menit baca',
                    'author' => 'Lab Komputer',
                    'image_icon' => 'fa-solid fa-microchip',
                    'image_gradient' => 'from-emerald-600 via-teal-600 to-cyan-700',
                    'summary' => 'Mempersiapkan talenta muda menghadapi era kecerdasan buatan dan ancaman keamanan siber dengan kurikulum praktikal berstandar industri modern.',
                    'content' => "Menjawab tantangan revolusi industri 4.0 dan era Generative AI, SMKN 1 Tech menyelenggarakan workshop intensif selama dua hari yang dihadiri oleh seluruh tenaga pengajar dan 300 siswa terpilih. Materi difokuskan pada pemanfaatan AI untuk efisiensi koding, etika kecerdasan buatan, serta teknik pertahanan siber dasar.",
                ]
            ],
            'extracurriculars' => [
                ['name' => 'Robotik & IoT Club', 'icon' => 'fa-solid fa-robot', 'badge' => 'Juara Nasional', 'desc' => 'Perakitan mikrokontroler, drone, sensor IoT, dan robotika kompetisi.'],
                ['name' => 'Cyber Security & CTF', 'icon' => 'fa-solid fa-shield-virus', 'badge' => 'Spesialis', 'desc' => 'Eksplorasi penetration testing legal, defense server, dan kompetisi Capture The Flag.'],
                ['name' => 'Game Development & Esport', 'icon' => 'fa-solid fa-gamepad', 'badge' => 'Kreatif', 'desc' => 'Perancangan aset game 2D/3D, Unity Engine, dan turnamen esport kompetitif.'],
                ['name' => 'Desain & Sinematografi', 'icon' => 'fa-solid fa-video', 'badge' => 'Media', 'desc' => 'Produksi konten video pendek, editing sinematik, podcast, dan fotografi pameran.'],
                ['name' => 'Pramuka & PMR Wira', 'icon' => 'fa-solid fa-campground', 'badge' => 'Karakter', 'desc' => 'Pembinaan kedisiplinan, kepemimpinan, kepedulian sosial, dan pertolongan pertama.'],
                ['name' => 'English Debate & Club', 'icon' => 'fa-solid fa-comments', 'badge' => 'Bahasa', 'desc' => 'Asah kecakapan berbicara bahasa Inggris, public speaking, dan kompetisi debat antar-SMK.'],
            ],
            'facilities' => [
                ['name' => '5 Lab Komputer Core i7 & GPU', 'icon' => 'fa-solid fa-desktop', 'desc' => 'Dilengkapi workstation spesifikasi tinggi untuk programming dan rendering 3D.'],
                ['name' => 'Bengkel Otomotif Standar ATPM', 'icon' => 'fa-solid fa-wrench', 'desc' => 'Fasilitas car lift, scanner injeksi digital, dan charging station motor listrik.'],
                ['name' => 'Studio Foto & Rekaman Podcast', 'icon' => 'fa-solid fa-microphone', 'desc' => 'Ruang kedap suara dengan pencahayaan profesional, kamera 4K, dan green screen.'],
                ['name' => 'Perpustakaan Digital & Cafe Baca', 'icon' => 'fa-solid fa-book-open-reader', 'desc' => 'Akses ribuan e-book, jurnal internasional, dan area santai ber-WiFi kecepatan tinggi.'],
                ['name' => 'Auditorium & Sarana Olahraga', 'icon' => 'fa-solid fa-basketball', 'desc' => 'Gedung serbaguna berkapasitas 800 orang, lapangan futsal, basket, dan bulutangkis.'],
                ['name' => 'Smart Classroom Ber-AC', 'icon' => 'fa-solid fa-chalkboard', 'desc' => 'Setiap ruang kelas dilengkapi Smart Interactive Board, proyektor, dan tata ruang ergonomis.'],
            ],
            'testimonials' => [
                [
                    'name' => 'Fadhil Ramadhan',
                    'role' => 'Software Engineer di Unicorn Tech (Alumni PPLG 2024)',
                    'message' => 'Belajar di SMKN 1 Tech membuat saya terbiasa dengan kultur industri nyata. Skill coding Laravel dan React yang diajarkan guru membuat saya langsung direkrut sebelum wisuda!',
                    'avatar' => 'fa-solid fa-user-tie',
                ],
                [
                    'name' => 'Sarah Putri Anjani',
                    'role' => 'UI/UX Designer di Startup Edukasi (Alumni DKV 2023)',
                    'message' => 'Fasilitas studio dan kurikulum berbasis portfolio sangat membantu portofolio saya bersaing di level internasional. Guru-gurunya sangat suportif membimbing kami.',
                    'avatar' => 'fa-solid fa-user-astronaut',
                ],
                [
                    'name' => 'Budi Hendra, S.T.',
                    'role' => 'HR Director PT Mitra Solusi Digital (Mitra Industri)',
                    'message' => 'Lulusan SMKN 1 Tech selalu menjadi prioritas kami saat membuka lowongan kerja. Karakter disiplin dan fondasi teknis yang mereka miliki sangat matang dan siap pakai.',
                    'avatar' => 'fa-solid fa-building-user',
                ],
            ],
            'faqs' => [
                [
                    'q' => 'Kapan pendaftaran siswa baru (PPDB) dibuka?',
                    'a' => 'PPDB SMKN 1 Tech dibuka dalam 2 gelombang: Gelombang 1 (Jalur Prestasi & Beasiswa) dibuka mulai bulan Agustus hingga Desember, sedangkan Gelombang 2 (Jalur Reguler) dibuka mulai Januari hingga kuota kelas terpenuhi.'
                ],
                [
                    'q' => 'Apakah lulusan SMK ini bisa melanjutkan kuliah ke Perguruan Tinggi Negeri (PTN)?',
                    'a' => 'Sangat bisa! Kurikulum kami menggabungkan kompetensi vokasi kejuruan dan materi akademik esensial, sehingga siswa siap memilih jalur: Bekerja (Langsung di industri), Melanjutkan Kuliah (SNBP/SNBT/Mandiri), maupun Berwirausaha (BMW).'
                ],
                [
                    'q' => 'Bagaimana sistem magang / Praktik Kerja Lapangan (PKL)?',
                    'a' => 'Program PKL dilaksanakan selama 6 bulan di semester 5 (Kelas XII). Sekolah yang akan menyalurkan siswa ke lebih dari 48 mitra industri terakreditasi sesuai jurusannya masing-masing.'
                ],
                [
                    'q' => 'Apakah tersedia beasiswa bagi siswa berprestasi atau kurang mampu?',
                    'a' => 'Ya, kami menyediakan Beasiswa Prestasi Akademik, Beasiswa Hafiz Quran, Beasiswa Juara LKS/Olahraga, serta subsidi program Indonesia Pintar (PIP) dan beasiswa dari mitra industri binaan.'
                ],
            ]
        ];
    }

    /**
     * Tampilkan Halaman Utama (Landing Page Portal Web Sekolah)
     */
    public function index()
    {
        $data = $this->getSchoolData();

        $info = $data['info'];
        $stats = $data['stats'];
        $majors = $data['majors'];
        $announcements = $data['announcements'];
        $news = $data['news'];
        $extracurriculars = $data['extracurriculars'];
        $facilities = $data['facilities'];
        $testimonials = $data['testimonials'];
        $faqs = $data['faqs'];

        return view('school.index', compact(
            'info',
            'stats',
            'majors',
            'announcements',
            'news',
            'extracurriculars',
            'facilities',
            'testimonials',
            'faqs'
        ));
    }

    /**
     * Tampilkan Halaman Detail Berita
     */
    public function newsDetail($slug = null)
    {
        $data = $this->getSchoolData();
        $newsList = $data['news'];
        $info = $data['info'];

        // Cari berita berdasarkan slug, atau ambil berita pertama jika tidak ditemukan
        $article = collect($newsList)->firstWhere('slug', $slug) ?? $newsList[0];
        $recentNews = collect($newsList)->where('slug', '!=', $article['slug'])->take(3);

        return view('school.news-detail', compact('article', 'recentNews', 'info'));
    }

    /**
     * Tampilkan Halaman Detail Pengumuman
     */
    public function announcementDetail($id = null)
    {
        $data = $this->getSchoolData();
        $announcements = $data['announcements'];
        $info = $data['info'];

        // Cari pengumuman berdasarkan ID, atau ambil pengumuman pertama
        $announcement = collect($announcements)->firstWhere('id', (int)$id) ?? $announcements[0];
        $otherAnnouncements = collect($announcements)->where('id', '!=', $announcement['id'])->take(3);

        return view('school.announcement-detail', compact('announcement', 'otherAnnouncements', 'info'));
    }

    /**
     * Tampilkan Halaman Detail Jurusan
     */
    public function majorDetail($slug = null)
    {
        $data = $this->getSchoolData();
        $majors = $data['majors'];
        $info = $data['info'];

        // Cari jurusan berdasarkan slug
        $major = collect($majors)->firstWhere('slug', $slug) ?? $majors[0];
        $otherMajors = collect($majors)->where('slug', '!=', $major['slug']);

        return view('school.major-detail', compact('major', 'otherMajors', 'info'));
    }
}
