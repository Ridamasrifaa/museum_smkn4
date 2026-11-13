# CHANGELOG

## 0.1.0 - 13 November 2026

### Ditambahkan
- Class `MuseumCache` (App\Services, App\Cache, App\Helpers, App\Support) dengan method `remember()` dan `flush()` untuk cache publik berbasis grup (`karya`, `stat`, `artikel`, `komentar.{id}`).
- Alias global `MuseumCache` melalui `AppServiceProvider`.
- Normalisasi URL pada form upload karya (pengguna dapat mengetik tanpa `https://`).
- Baris "Teknologi / Alat" pada detail karya (siswa dan admin).
- Pesan feedback login/register sesuai permintaan.

### Diubah
- Form upload karya siswa otomatis menyesuaikan jurusan akun yang login.
- Input link (GitHub/live/iframe) diubah dari `type="url"` menjadi `type="text"`.
- Kolom ganti password pada edit profil siswa digabung ke dalam satu panel/form.
- Navbar halaman show artikel menampilkan DASHBOARD jika pengguna sudah login.
- Footer halaman index disesuaikan dengan footer halaman publik lainnya.
- Badge jurusan (profil siswa, admin detail, tabel siswa/admin) disesuaikan warnanya dengan tombol form jurusan.
- `config/cache.php`: `serializable_classes` diaktifkan.
- Migrasi `modify_projects_table_remove_category` dibuat kompatibel dengan SQLite.

### Diperbaiki
- `AdminSiswaController` memfilter siswa berdasarkan jurusan admin (kecuali super admin).
- Middleware `SuperAdmin` menggunakan `isSuperAdmin()`.
- Route resource yang memanggil method belum ada diberi method redirect aman.
- `User` model menambahkan `instagram` ke `$fillable`.
- Peringatan upload TKJ/TSM menggunakan `instagram`.
- URL normalisasi memungkinkan input `github.com/username/project` untuk PPLG.
- Cache flush dipanggil pada aksi moderasi/admin dan perubahan data terkait.
- Navbar public: underline aktif pada mode dark berwarna putih.
- Navbar public: garis putih panjang pada mode dark dihapus/dikembalikan sesuai permintaan terakhir (searah semula).

### Catatan
- File `Agent.md` dan `TASKS.md` tidak disertakan dalam commit sesuai aturan.
- Pengujian: `php artisan test` lulus.

### Perbaikan 8
- Card karya public/index: modal label kategori diubah menjadi jurusan; tombol filter jurusan disesuaikan warna form dan state aktif.

### Update Tombol
- Tombol filter jurusan di halaman karya disesuaikan warnanya dengan form jurusan masing-masing dan state aktif.

### Ganti Warna Button
- Tombol filter jurusan di halaman karya disesuaikan warnanya dengan form jurusan masing-masing dan state aktif.