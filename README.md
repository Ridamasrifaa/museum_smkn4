# Museum Karya SMKN 4 Tasikmalaya

Aplikasi web untuk menampung, memamerkan, dan memoderasi karya siswa SMKN 4 Tasikmalaya dari berbagai jurusan (PPLG, TKJ/TJKT, DKV, TOI, TSM).

## Tujuan
- Menyediakan etalase karya siswa (website, aplikasi, desain, jaringan, otomasi, mesin, dll.).
- Memberikan apresiasi (like, komentar) dari komunitas sekolah.
- Moderasi karya oleh admin jurusan dan super admin.
- Profil siswa sebagai portofolio.

## Teknologi
- Backend: Laravel 13 (PHP 8.3+)
- Database: MySQL/MariaDB
- Frontend: Blade + Tailwind (CDN) + JavaScript
- Cache: Laravel Cache (database/array)
- Autentikasi: Laravel Auth + Google Socialite
- Upload: kompresi gambar di sisi klien & server

## Peran Pengguna
- **Siswa (role 2):** upload karya, melihat karya, komentar, like, edit profil.
- **Admin Jurusan (role 1):** moderasi karya jurusannya, kelola siswa/kategori/artikel/kode undangan.
- **Super Admin (role 0):** kelola akun admin, lihat statistik global.

## Alur Utama
1. Siswa mendaftar dengan kode undangan atau login Google + kode undangan.
2. Siswa mengunggah karya sesuai jurusannya (form otomatis menyesuaikan).
3. Admin jurusan menyetujui/menolak karya dengan catatan.
4. Karya yang disetujui tampil di halaman publik (Museum Karya).
5. Pengunjung dapat melihat detail, memberi like, dan berkomentar.

## Fitur Utama
- Cache publik berbasis grup (`MuseumCache::remember/flush`).
- Validasi kode undangan (masa berlaku, batas pemakaian, status aktif).
- Upload karya dengan kompresi gambar.
- Wajib link GitHub untuk jurusan PPLG.
- Kolom Instagram untuk seluruh siswa.
- Detail karya menampilkan semua kolom yang diisi.
- Profil siswa dengan portofolio karya.
- Desain Neubrutalism (border tebal, shadow keras, font Plus Jakarta Sans).

## Instalasi (Lokal)
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

## Pengujian
```bash
php artisan test
```

## Catatan
- Aplikasi dirancang untuk server terbatas (1 GB RAM). Gunakan OPcache, tuning PHP-FPM/MySQL, dan cache publik.
- Tidak ada `git push` file sensitif (`Agent.md`, `TASKS.md`, dll.) sesuai aturan.