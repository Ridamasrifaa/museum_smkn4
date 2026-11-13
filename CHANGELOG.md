# CHANGELOG

## 0.1.0 (13 November 2026)

Fitur:
- MuseumCache untuk cache publik berbasis grup (karya, stat, artikel, komentar.{id}).
- Form upload karya otomatis menyesuaikan jurusan siswa.
- Validasi wajib link GitHub untuk jurusan PPLG.
- Kolom Instagram untuk seluruh siswa.
- Kompresi gambar pada upload karya.
- Moderasi karya oleh admin jurusan dan super admin.
- Profil siswa sebagai portofolio karya.
- Like, komentar, dan berbagi karya.
- Cache publik untuk performa beranda.

Update:
- Navbar halaman show artikel menampilkan Dashboard jika sudah login.
- Footer halaman index disesuaikan dengan halaman publik lainnya.
- Badge jurusan disesuaikan warnanya dengan form jurusan.
- Tombol filter jurusan di halaman karya disesuaikan warnanya dengan form jurusan.
- Edit profil siswa: ganti password digabung ke satu panel.
- README.md diperbarui dengan dokumentasi project.

Fixx:
- AdminSiswaController memfilter siswa berdasarkan jurusan admin.
- Middleware SuperAdmin menggunakan isSuperAdmin().
- Migrasi modify_projects_table_remove_category kompatibel SQLite.
- Path avatar ganda di halaman karya diperbaiki.
- Warna tombol filter jurusan yang tidak muncul diperbaiki (inline style).
- Validasi dan feedback login/register (kode undangan kosong/penuh/kadaluarsa).
- Normalisasi URL pada form upload (tanpa https://).
- Navbar public: garis putih pada mode dark disesuaikan.

Catatan:
- File Agent.md, TASKS.md, fix.md, dan file laporan tidak disertakan dalam commit sesuai aturan.
- Pengujian: php artisan test lulus.

### Update Perbaikan
- Badge jurusan di halaman profil publik disesuaikan warnanya.
- Modal feedback global ditambahkan di layout admin.
- Spinner "Tunggu bentar....." ditambahkan pada tombol login dan register.

### Update Komentar
- GIF pada komentar dihapus.
- Komentar dapat diedit/dihapus dalam 5 menit pertama.
- Like pada komentar memperbarui jumlah secara realtime.
- Kolom "Guru pengampu" di detail karya dihapus; tersisa Tahun (tanggal lengkap) dan Teknologi.
- Tombol GitHub pada detail karya menggunakan ikon GitHub.

### Bug 5
- Komentar di mobile/desktop tidak membuka modal dan unlike tidak berfungsi; diperbaiki dengan menghapus referensi GIF yang sudah dihapus.

### Bug 6
- Komentar tidak bisa dibuka dan like/unlike tidak berfungsi karena kurung kurawal ekstra pada script; diperbaiki.

### Bug 4
- Card project di profil siswa tidak menampilkan iframe dari link project; diperbaiki dengan normalisasi URL dan fallback iframe.