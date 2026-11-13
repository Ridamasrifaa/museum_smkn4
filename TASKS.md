## Laporan

- laporkan apa saja yang kamu temukan dan apa saja yang kamu perbaiki
- contoh
    - Bug di bagian route
    - perbaikan di bagian controller
- jelaskan semuanya dengan jelas kalimatnya dan tidak ada yang kurang sedikitpun
- Simpan semua catatan itu di file fix.md / atau buatkan file nya fix.md

## Feedback: di halaman login dan register

- kasih feedback halaman login dan register
    - jika user login kasih tau 'email atau password anda salah' di return email nya saja dan tidak boleh password
    - di halaman register jika user tidak mengisi kode unik maka muncul feedback 'isi dulu kode undangannya'
    - dan jika di halaman register user mengisi kode unik lalu penuh atau atau expired dan kasih feedback pesan 'kode unik sudah dipakai / sudah kadaluarsa'

## Fitur: dihalaman siswa

- tambahkan fitur:
    - untuk di halaman kirim project di halaman siswa tampilkan form sesuai jurusannya masing masing agar tidak di pilih
    - dan untuk semua form jurusannya termasuk pplg yang ada link github itu user cuman ngetik link nya seperti ini web.com tanpa perlu mengetik https:// dan juga termasuk github tanpa mengetik https:// dan langsung input github.com/username
    - tambahan untuk detail karya siswa baik admin atau siswa itu harus munculin semua form atau sesuai yang sudah di isi kolom kolom kirim project

- perbaikan:
    - di halaman edit profile siswa ada kolom ganti password itu gabungkan dengan form yang ada form di atas dijadikan 1 panel saja

## Bug 1

- Bug tidak bisa di kirim yang khusus nya pplg ketika user mengetik github.com/username/project dan saat saya kirim project dia tidak bisa
- perbaiki kolom kolom inputan termasuk semua jurusan
- test sampai lulus
- jika sudah lulus test jangan lupa catat di fix.md

## Perbaikan 1

- di halaman index utama perbaiki footer nya sesuai footer yang lainnya yang di public
- di halaman show artikel perbaiki navbarnya terutama jika session user masih ada ubah login menjadi dashboard bukan muncul login
- Perbaiki di halaman profile siswa di bawah my karya gue ada card project nya di panggil sama link web nya atau foto
- test sampai lulus
- jika sudah lulus test jangan lupa catat di fix.md

## Perbaikan 2

- di halaman siswa di profile siswa di bagian bawah my karya gue ada card itu ada preview web / aplikasi nah itu munculkan link iframe nya yang sudah di isi kolom link tersebut
- Ganti warna badge di halaman siswa di bagian halaman my karya gue badge jurusannya sesuaikan warna form jurusan termasuk di badge jurusan siswa di halaman admin
- test sampai lulus
- jika layout kurang di rapihkan dan sesuaikan
- jika sudah lulus test jangan lupa catat di fix.md

## Perbaikan 3

- di halaman siswa di my karya gue tabel jurusan itu badge jurusannya sesuaikan warna form nya
- lalu di halaman admin di bagian karya tabel daftar karya jurusan badge nya sesuaikan warna form nya

## Git push

- Tolong di git push ke branch main dan tambahkan apa saja yang sudah di tambahkan dan juga perbaiki
- update commit harus menggunakan Bahasa Indonesia dan update di CHANGELOG.md semuanya dengan jelas
- jik terjadi konflik , Perbaiki konflik tersebut.

## Perbaikan 4 : navbar public 
- di folder partials atau navbar coba check di navbar tersebut ketika mode dark dia ada garis putih di bawah, nah sesuaikan dengan link active misal di beranda garis bawah text beranda garis putih 
- test sampai lulus 
- jika sudah lulus test update CHANGELOG.md dan di fix.md 
