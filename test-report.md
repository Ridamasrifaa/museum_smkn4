# Laporan Uji Beban (Load Test) - Museum Karya SMKN 4

## Lingkungan Pengujian
- Server: Windows lokal, PHP built-in server (single-threaded) — **bukan** produksi.
- CPU/RAM simulasi target: 2–4 core, 1 GB RAM, 60 GB storage (single server: app + DB).
- Data uji: 1500 user siswa + 1000 project (campuran status pending/approved/rejected).

## Hasil Uji (Built-in Server)
- Endpoint `/`: 100 request → ~3.5 RPS, p95 ~27s.
- Endpoint `/karya`: 100 request → ~3.3 RPS, p95 ~30s, 31 error (timeout).
- Endpoint `/artikel`: 100 request → ~3.3 RPS, p95 ~30s, 50 error (timeout).

## Catatan Penting
- PHP built-in server hanya menangani 1 request per worker; hasil ini **tidak** merepresentasikan performa produksi dengan Nginx/PHP-FPM.
- Untuk uji realistis 1500 user, gunakan Nginx + PHP-FPM (multi-worker) atau Apache, dengan tuning MySQL.

## Rekomendasi untuk Server Produksi (1 GB RAM)
- OPcache aktif (128–256 MB).
- PHP-FPM `pm.max_children` 20–30, start 5, spare 3–10.
- MySQL `innodb_buffer_pool_size` 256–384 MB, `max_connections` 100–150, aktifkan slow query log.
- Index DB pada `status`, `jurusan`, `user_id`, `created_at`.
- Eager loading pada daftar karya/admin dashboard.
- Cache publik (`MuseumCache`) TTL 5–10 menit, pastikan hit rate tinggi.
- Session driver database/redis; queue untuk tugas berat.
- `php artisan config:cache`, `route:cache`, `view:cache` di produksi.
- Monitoring: CPU/RAM, MySQL processlist, Laravel log, disk I/O.

## Kesimpulan
- Aplikasi Laravel ini dapat menangani beban lebih baik dengan server produksi (Nginx/PHP-FPM) dan tuning. Pada built-in server, 1500 user tidak representatif. Disarankan uji ulang di lingkungan produksi dengan k6/ab.