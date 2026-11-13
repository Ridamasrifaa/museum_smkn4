# CHANGELOG

## [Unreleased] - Perubahan Terbaru

### Ditambahkan
- Class `MuseumCache` (App\Services, App\Cache, App\Helpers, App\Support) dengan method `remember()` dan `flush()` untuk cache publik berbasis grup (`karya`, `stat`, `artikel`, `komentar.{id}`).
- Alias global `MuseumCache` melalui `AppServiceProvider`.
- Normalisasi URL pada form upload karya (pengguna dapat mengetik tanpa `https://`).
- Baris "Teknologi / Alat" pada detail karya (siswa dan admin).
- Pesan feedback login/register sesuai permintaan (error hanya di field email, kode undangan kosong/penuh/kadaluarsa).

### Diubah
- Form upload karya siswa otomatis menyesuaikan jurusan akun yang login (tidak perlu dipilih manual).
- Input link (GitHub/live/iframe) diubah dari `type="url"` menjadi `type="text"` agar bisa diketik tanpa skema.
- Kolom ganti password pada edit profil siswa digabung ke dalam satu panel/form.
- Navbar halaman show artikel menampilkan DASHBOARD jika pengguna sudah login.
- Footer halaman index disesuaikan dengan footer halaman publik lainnya.
- Badge jurusan (profil siswa, admin detail, tabel siswa/admin) disesuaikan warnanya dengan tombol form jurusan.
- `config/cache.php`: `serializable_classes` diaktifkan agar cache database dapat menyimpan koleksi Eloquent.
- Migrasi `modify_projects_table_remove_category` dibuat kompatibel dengan SQLite.

### Diperbaiki
- `AdminSiswaController` memfilter siswa berdasarkan jurusan admin (kecuali super admin).
- Middleware `SuperAdmin` menggunakan `isSuperAdmin()`.
- Route resource yang memanggil method belum ada diberi method redirect aman (kategori, kode undangan, artikel, artikel publik).
- `User` model menambahkan `instagram` ke `$fillable`.
- Peringatan upload TKJ/TSM menggunakan `instagram` (bukan `phone_number`).
- URL normalisasi memungkinkan input `github.com/username/project` untuk PPLG.
- Cache flush dipanggil pada aksi moderasi/admin dan perubahan data terkait.

### Catatan
- Tidak ada git add/commit/push dilakukan selama pengerjaan sesuai larangan; commit ini dibuat setelah konfirmasi pengguna.

### Perbaikan 4
- Navbar public: underline link aktif pada mode dark disesuaikan berwarna putih.