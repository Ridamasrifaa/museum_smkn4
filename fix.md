# Fix Report

## Ringkasan
Perbaikan dilakukan agar aplikasi Museum Karya SMKN 4 lolos pengujian fungsional, otorisasi, cache, dan migrasi (termasuk environment testing SQLite).

## Temuan & Perbaikan

### 1. Cache Publik (MuseumCache)
- Temuan: Class `MuseumCache` tidak ada, padahal digunakan untuk pembacaan data publik dan flush cache.
- Perbaikan: Membuat `App\Services\MuseumCache` (dan alias di `App\Cache`, `App\Helpers`, `App\Support`) dengan method `remember(...)` dan `flush(...)`. Alias global `MuseumCache` didaftarkan di `AppServiceProvider`. `config/cache.php` diubah `serializable_classes` menjadi `true` agar cache database bisa menyimpan koleksi Eloquent.
- Penggunaan cache ditambahkan di `PublicController` untuk beranda (karya, stat).
- Pemanggilan `MuseumCache::flush(...)` ditambahkan pada aksi moderasi/admin (karya, stat, artikel, komentar.{id}).

### 2. Migrasi & Testing
- Temuan: Migrasi `modify_projects_table_remove_category` gagal di SQLite karena index `projects_category_id_index`.
- Perbaikan: Migrasi dibuat robust (drop foreign/index jika ada, fallback kolom). `ExampleTest` diaktifkan `RefreshDatabase`.

### 3. Otorisasi Admin Jurusan
- Temuan: `AdminSiswaController` tidak memfilter siswa berdasarkan jurusan admin.
- Perbaikan: Filter jurusan ditambahkan (kecuali super admin).
- `SuperAdmin` middleware menggunakan `isSuperAdmin()`.

### 4. Form Upload Siswa
- Temuan: Peringatan nomor WhatsApp pada jurusan TKJ/TSM memeriksa `phone_number` yang tidak pernah diisi (profil memakai `instagram`).
- Perbaikan: Kondisi diubah ke `instagram`.

### 5. Route/Controller yang belum ada
- Temuan: Beberapa route resource memanggil method yang belum ada (`show`/`create`), berpotensi 500.
- Perbaikan: Menambahkan method redirect aman di `AdminCategoryController`, `AdminInvitationCodeController`, `ArticleController`, `ArticlePageController`.

### 6. User Model
- Temuan: Kolom `instagram` tidak ada di `$fillable`.
- Perbaikan: Menambahkan `instagram` ke `$fillable`.

### 7. Performa/Cache Flush
- Temuan: Aksi perubahan data (upload, hapus, like, komentar, admin, undangan) tidak memperbarui cache.
- Perbaikan: Menambahkan `MuseumCache::flush(...)` pada controller terkait.

## Feedback Login & Register
- Login: jika gagal, pesan `email atau password anda salah` hanya muncul di field email, bukan password; nilai email lama dipertahankan.
- Register: jika `kode_unik` kosong, muncul feedback `isi dulu kode undangannya`.
- Register: jika `kode_unik` diisi tetapi penuh/kadaluarsa/tidak valid, muncul feedback `kode unik sudah dipakai / sudah kadaluarsa`.
- Alur Google (kode undangan) juga menggunakan pesan feedback yang sama.

## Fitur Halaman Siswa
- Upload: form kini otomatis menyesuaikan jurusan akun siswa (hanya jurusan siswa yang tampil), tidak perlu dipilih manual.
- Link (live/github/iframe): user dapat mengetik tanpa `https://` (mis. `web.com`, `github.com/user`), controller menormalisasi otomatis.
- Detail karya (siswa & admin): menambahkan baris Teknologi/Alat agar menampilkan semua kolom yang diisi saat upload.
- Edit profil: kolom ganti password digabung ke panel/form yang sama (satu form).

## Bug 1 (PPLG github.com/username/project)
- Temuan: input link bertipe `url` di browser menolak nilai tanpa skema (mis. `github.com/username/project`), sehingga form PPLG tidak bisa dikirim.
- Perbaikan: tipe input link diubah menjadi `text`, dan controller menormalisasi nilai (menambahkan `https://` jika belum ada) sebelum validasi/penyimpanan.
- Kolom input semua jurusan tetap divalidasi dan ternormalisasi.

## Perbaikan 1
- Halaman index: footer disesuaikan dengan footer halaman publik lainnya.
- Halaman show artikel: navbar menampilkan DASHBOARD (sesuai role) jika user sudah login, bukan LOGIN.
- Halaman profil siswa: card karya di bawah "My Karya Gue" tetap menampilkan preview foto/video/link web dan modal detail; interaksi like/komentar/share tersedia.

## Perbaikan 2
- Profil siswa: badge jurusan pada modal detail karya disesuaikan warnanya dengan tombol form jurusan (PPLG hijau, TKJ biru, DKV oranye, TOI abu, TSM merah).
- Admin detail karya: badge jurusan juga disesuaikan warnanya dengan form jurusan.
- Card karya di profil siswa tetap menampilkan preview foto/video/link web dan membuka modal detail; link live tersedia pada tombol "Buka Live Demo".

## Perbaikan 3
- Halaman siswa (My Karya): badge jurusan pada tabel disesuaikan warnanya dengan tombol form jurusan.
- Halaman admin (Daftar Karya): badge jurusan pada tabel disesuaikan warnanya dengan tombol form jurusan.

## Perbaikan 4 (Navbar Public)
- Navbar partial sudah menggunakan underline aktif berwarna putih pada mode dark (`border-b-4 border-black dark:border-white`) sehingga sesuai dengan link aktif (mis. Beranda).

## Perbaikan 5 (Navbar Public)
- Menghapus garis putih panjang pada mode dark di navbar (border container diubah agar tidak terlihat).

## Perbaikan 6 (Navbar Public)
- Mengembalikan garis putih pada mode dark di navbar (sesuai permintaan: garis putih di bawah menu text).

## Perbaikan 7 (Navbar Public)
- Menghapus kembali garis putih panjang pada mode dark di container navbar, sementara underline aktif pada link tetap berwarna putih.

## Update Navbar
- Mengembalikan garis putih pada mode dark di navbar seperti semula (sesuai permintaan).

## Perbaikan 8 (Card Karya Public & Index)
- Modal card di halaman index: label "Kategori" diubah menjadi "Jurusan".
- Halaman karya: modal card menampilkan foto/avatar user (sudah tersedia via data-avatar).
- Tombol filter jurusan di halaman karya disesuaikan warnanya dengan form jurusan dan state aktif mengikuti warna masing-masing jurusan.

## Update Tombol (Karya Public)
- Tombol filter jurusan di halaman karya disesuaikan warnanya dengan form jurusan masing-masing (PPLG hijau, TKJ biru, DKV oranye, TOI abu, TSM merah), selain tombol "Semua".
- State aktif tombol menggunakan warna jurusan masing-masing.

## Ganti Warna Button (Filter Jurusan)
- Tombol filter jurusan di halaman karya sudah menggunakan warna form jurusan masing-masing (kecuali tombol "Semua"), termasuk state aktif.

## Ganti Warna Button (Filter Jurusan) - Lanjutan
- Tombol filter jurusan di halaman karya kini menggunakan warna border sesuai jurusan pada state aktif.

## Bug 2 (Tombol Filter Jurusan)
- Temuan: warna tombol filter jurusan tidak muncul karena kelas Tailwind dinamis tidak ter-generate (browser CDN).
- Perbaikan: menerapkan warna melalui inline style (background, text, border) berdasarkan jurusan, sehingga warna pasti muncul.

## Bug 3 (Foto Avatar Halaman Karya)
- Temuan: path avatar digabung ganda (`storage/` + `/storage/...`) sehingga foto tidak muncul.
- Perbaikan: normalisasi path avatar (handle URL, path `/storage`, dan path relatif).

## Isi Readme
- README.md diganti dengan dokumentasi project Museum Karya SMKN 4 Tasikmalaya (tujuan, teknologi, peran, alur, fitur, instalasi, pengujian).

## Catatan
- Tidak ada `git add`/commit/push dilakukan sesuai larangan.
