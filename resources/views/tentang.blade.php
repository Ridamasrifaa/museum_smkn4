@extends('layouts.app')

@section('title', 'Tentang — Museum Karya SMKN 4 Tasikmalaya')
@section('body_class', 'bg-[#FFFDF5] dark:bg-zinc-950 text-slate-900 dark:text-zinc-100 transition-colors duration-300 antialiased min-h-screen flex flex-col justify-between')

@push('styles')
    <style>
        /* Background kotak-kotak ala Neo-Brutalism */
        .bg-grid-pattern {
            background-image:
                linear-gradient(to right, rgba(0, 0, 0, 0.06) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(0, 0, 0, 0.06) 1px, transparent 1px);
            background-size: 24px 24px;
        }
        .dark .bg-grid-pattern {
            background-image:
                linear-gradient(to right, rgba(255, 255, 255, 0.05) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
            background-size: 24px 24px;
        }

        /* Styling kartu tim yang dirender dari dev.js */
        #team-grid > * {
            background: #ffffff;
            color: #000000;
            border: 3px solid #000000;
            border-radius: 1rem;
            box-shadow: 5px 5px 0px 0px #000000;
            transition: all 0.1s ease;
        }
        #team-grid > *:hover {
            transform: translate(-2px, -2px);
            box-shadow: 7px 7px 0px 0px #000000;
        }
        #team-grid img {
            border: 3px solid #000000;
            cursor: pointer;
        }
        .dark #team-grid > * {
            background: #18181b;
            color: #f4f4f5;
            border-color: #ffffff;
            box-shadow: 5px 5px 0px 0px #ffffff;
        }
        .dark #team-grid > *:hover {
            box-shadow: 7px 7px 0px 0px #ffffff;
        }
        .dark #team-grid img {
            border-color: #ffffff;
        }

        .neop-btn-box {
            border: 2px solid #000;
            box-shadow: 2px 2px 0px 0px #000;
            transition: all 0.1s ease;
        }
        .neop-btn-box:active {
            transform: translate(2px, 2px);
            box-shadow: 0px 0px 0px 0px #000;
        }
        .dark .neop-btn-box {
            border: 2px solid #fff;
            box-shadow: 2px 2px 0px 0px #fff;
        }
        .dark .neop-btn-box:active {
            box-shadow: 0px 0px 0px 0px #fff;
        }
    </style>
@endpush

@section('content')
    <div class="flex-grow bg-grid-pattern">
        <!-- ===== MAIN CONTENT CONTAINER ===== -->
        <main class="py-12 sm:py-16">
            <!-- ===== HERO ===== -->
            <section class="pb-10 text-center">
                <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
                    <span class="inline-block px-4 py-1.5 mb-4 text-xs font-black uppercase tracking-wider text-black bg-yellow-300 rounded-full border-2 border-black shadow-[2px_2px_0px_#000]"> Informasi Proyek </span>
                    <h1 class="text-3xl sm:text-5xl font-black text-slate-900 dark:text-white mb-4 tracking-tight uppercase">Tentang Museum Karya</h1>
                    <p class="text-slate-700 dark:text-gray-300 text-sm sm:text-base font-medium max-w-2xl mx-auto leading-relaxed">Mengenal latar belakang pengerjaan proyek, tujuan pengembangannya, dan tim di balik platform ini.</p>
                </div>
            </section>

            <!-- ===== TENTANG PROYEK ===== -->
            <section id="tentang-proyek" class="mx-auto max-w-4xl px-4 sm:px-6">
                <div class="bg-white dark:bg-gray-900 p-6 sm:p-10 rounded-2xl border-3 border-black dark:border-white shadow-[5px_5px_0px_0px_#000] dark:shadow-[5px_5px_0px_0px_#fff] transition-colors duration-300">
                    <!-- Narasi Utama -->
                    <div class="space-y-4 sm:space-y-6 text-slate-800 dark:text-gray-200 leading-relaxed text-sm sm:text-base md:text-lg font-medium">
                        <p>
                            <strong class="text-black dark:text-white font-black">Museum Karya</strong> hadir sebagai wadah digital terintegrasi yang dirancang khusus untuk menampung, mendokumentasikan, dan mempublikasikan berbagai hasil karya siswa-siswi SMKN 4 Tasikmalaya. Potensi kreativitas dan inovasi yang dihasilkan oleh para siswa sangat kaya, sehingga sangat disayangkan apabila karya-karya luar biasa tersebut hanya tersimpan tanpa sempat diapresiasi secara luas.
                        </p>
                        <p>
                            Platform ini dikembangkan melalui <span class="bg-cyan-200 dark:bg-cyan-900 text-black dark:text-cyan-200 px-1.5 py-0.5 font-bold border border-black dark:border-white rounded">kolaborasi antar tim pengembang</span> yang mulai dikerjakan secara intensif pada tanggal <span class="bg-yellow-200 dark:bg-yellow-900 text-black dark:text-yellow-200 px-1.5 py-0.5 font-bold border border-black dark:border-white rounded">28 Juni 2026</span>. Melalui kolaborasi ini, diharapkan Museum Karya dapat menjadi galeri digital terdepan yang tidak hanya memamerkan portofolio terbaik siswa, tetapi juga menginspirasi lahirnya karya-karya baru di lingkungan SMKN 4 Tasikmalaya.
                        </p>
                    </div>

                    <!-- Callout Bridge -->
                    <div class="mt-8 p-5 sm:p-6 rounded-xl bg-amber-100 dark:bg-gray-800 border-2 border-black dark:border-white shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] dark:shadow-[3px_3px_0px_0px_rgba(255,255,255,1)] flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="text-center sm:text-left">
                            <p class="text-sm font-black text-black dark:text-white">Penasaran siapa saja yang membangun platform ini?</p>
                            <p class="text-xs text-gray-700 dark:text-gray-300 font-semibold mt-0.5">Lihat profil dan peran dari masing-masing tim pengembang kami.</p>
                        </div>
                        <a href="#tim-kami" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-pink-400 dark:bg-pink-600 text-black dark:text-white font-black text-sm transition-all neop-btn-box shrink-0">
                            Sapa Tim Pengembang
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                            </svg>
                        </a>
                    </div>

                    <!-- Ringkasan Statistik -->
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 sm:gap-6 mt-8 sm:mt-10 pt-6 sm:pt-8 border-t-2 border-black dark:border-white text-center sm:text-left">
                        <div class="p-3 bg-gray-50 dark:bg-gray-800 border-2 border-black dark:border-white rounded-lg shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] dark:shadow-[2px_2px_0px_0px_rgba(255,255,255,1)]">
                            <p class="text-[10px] sm:text-xs uppercase tracking-wider text-gray-600 dark:text-gray-400 font-black">Mulai Pengerjaan</p>
                            <p class="text-sm sm:text-base font-black text-black dark:text-white mt-1">28 Juni 2026</p>
                        </div>
                        <div class="p-3 bg-gray-50 dark:bg-gray-800 border-2 border-black dark:border-white rounded-lg shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] dark:shadow-[2px_2px_0px_0px_rgba(255,255,255,1)]">
                            <p class="text-[10px] sm:text-xs uppercase tracking-wider text-gray-600 dark:text-gray-400 font-black">Bentuk Proyek</p>
                            <p class="text-sm sm:text-base font-black text-black dark:text-white mt-1">Kolaborasi Tim</p>
                        </div>
                        <div class="col-span-2 sm:col-span-1 p-3 bg-gray-50 dark:bg-gray-800 border-2 border-black dark:border-white rounded-lg shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] dark:shadow-[2px_2px_0px_0px_rgba(255,255,255,1)]">
                            <p class="text-[10px] sm:text-xs uppercase tracking-wider text-gray-600 dark:text-gray-400 font-black">Versi Sistem</p>
                            <div class="flex items-center justify-between sm:justify-start gap-2 mt-1">
                                <span id="app-version" class="text-sm sm:text-base font-black text-blue-600 dark:text-blue-400">v1.0.0</span>
                                <button onclick="openChangelogModal()" class="text-[10px] px-2 py-0.5 rounded bg-yellow-300 text-black border border-black font-black hover:bg-yellow-400 cursor-pointer">
                                    Update
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ===== TIM KAMI ===== -->
            <section id="tim-kami" class="scroll-mt-24 pt-16 sm:pt-20 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-10 text-center max-w-2xl mx-auto">
                    <span class="inline-block px-4 py-1.5 mb-3 text-xs font-black uppercase tracking-wider text-black bg-cyan-300 rounded-full border-2 border-black shadow-[2px_2px_0px_#000]"> Developer Profile </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-slate-900 dark:text-white mb-3 tracking-tight uppercase">Tim Pengembang</h2>
                    <p class="text-slate-700 dark:text-gray-300 text-xs sm:text-base font-medium">Siswa di balik perancangan dan pembangunan platform Museum Karya. (Klik foto untuk memperbesar)</p>
                </div>

                <!-- Kontainer target render dari dev.js -->
                <div id="team-grid" class="grid grid-cols-1 md:grid-cols-2 gap-8 justify-center max-w-3xl mx-auto">
                    <!-- Data dimuat dinamis melalui dev.js -->
                </div>
            </section>
        </main>
    </div>

    <!-- ===== FOOTER ===== -->
    <footer class="bg-gray-900 dark:bg-black text-white text-center py-12 mt-16 border-t-4 border-black dark:border-white">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="pt-4">
                <p class="text-gray-300 font-bold text-sm">&copy; {{ date('Y') }} Museum Karya SMKN 4 Tasikmalaya</p>
                <p class="text-gray-400 text-xs mt-1">Design &amp; Development By PPLG</p>
            </div>
        </div>
    </footer>

    <!-- ===== MODAL PREVIEW FOTO PROFIL (AVATAR) ===== -->
    <div id="avatarModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-xs opacity-0 pointer-events-none transition-all duration-300">
        <div id="modalContent" class="relative max-w-md w-full mx-4 bg-white dark:bg-zinc-900 rounded-3xl p-8 border-4 border-black dark:border-white shadow-[8px_8px_0px_#000] dark:shadow-[8px_8px_0px_#fff] transform scale-95 transition-all duration-300 text-center">
            <button onclick="closeAvatarModal()" aria-label="Tutup" class="absolute top-4 right-4 w-10 h-10 flex items-center justify-center bg-[#FF6B6B] text-black font-black border-3 border-black rounded-xl shadow-[3px_3px_0px_#000] hover:bg-white cursor-pointer">
                ✕
            </button>
            
            <!-- Container foto normal tanpa fitur drag -->
            <div class="w-64 h-64 sm:w-72 sm:h-72 mx-auto mb-6 mt-4 rounded-full overflow-hidden bg-[#FFD23F] border-4 border-black dark:border-white shadow-[6px_6px_0px_#000] relative select-none">
                <img id="modalImage" src="" alt="" class="w-full h-full object-cover object-center" />
            </div>

            <h4 id="modalName" class="text-xl font-black uppercase text-black dark:text-white"></h4>
            <span class="inline-block mt-2 px-3 py-1 text-[11px] font-black uppercase tracking-wider text-black bg-[#74B9FF] border-2 border-black rounded-lg shadow-[2px_2px_0px_#000]">Foto Profil</span>
        </div>
    </div>

    <!-- ===== MODAL CHANGELOG / RIWAYAT UPDATE ===== -->
    <div id="changelogModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-xs opacity-0 pointer-events-none transition-all duration-300">
        <div id="changelogContent" class="relative max-w-lg w-full mx-4 bg-white dark:bg-zinc-900 rounded-3xl border-4 border-black dark:border-white shadow-[8px_8px_0px_#000] dark:shadow-[8px_8px_0px_#fff] transform scale-95 transition-all duration-300 max-h-[80vh] flex flex-col overflow-hidden">
            <div class="px-6 py-4 bg-[#FFD23F] border-b-4 border-black dark:border-white flex items-center justify-between gap-4">
                <h3 class="text-lg font-black uppercase text-black">Riwayat Pembaruan</h3>
                <button onclick="closeChangelogModal()" aria-label="Tutup" class="w-10 h-10 shrink-0 flex items-center justify-center bg-[#FF6B6B] text-black font-black border-3 border-black rounded-xl shadow-[3px_3px_0px_#000] hover:bg-white cursor-pointer">
                    ✕
                </button>
            </div>
            <div class="p-6 sm:p-8 flex flex-col min-h-0">
                <p class="text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-4 pb-3 border-b-2 border-dashed border-black dark:border-white">Catatan versi dan log perubahan aplikasi Museum Karya.</p>
                <div id="changelogList" class="overflow-y-auto space-y-6 pr-1 text-left">
                    <!-- Dimuat dinamis melalui app.js -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Pemanggilan File JS eksternal -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/dev.js') }}"></script>

    <!-- <script>
        // Modal Avatar Handler
        function openAvatarModal(imgSrc, devName) {
            const modal = document.getElementById('avatarModal');
            document.getElementById('modalImage').src = imgSrc;
            document.getElementById('modalName').textContent = devName;
            modal.classList.remove('opacity-0', 'pointer-events-none');
            document.getElementById('modalContent').classList.remove('scale-95');
            document.getElementById('modalContent').classList.add('scale-100');
        }

        function closeAvatarModal() {
            const modal = document.getElementById('avatarModal');
            document.getElementById('modalContent').classList.remove('scale-100');
            document.getElementById('modalContent').classList.add('scale-95');
            modal.classList.add('opacity-0', 'pointer-events-none');
        }

        // Modal Changelog Handler
        function openChangelogModal() {
            const modal = document.getElementById('changelogModal');
            modal.classList.remove('opacity-0', 'pointer-events-none');
            document.getElementById('changelogContent').classList.remove('scale-95');
            document.getElementById('changelogContent').classList.add('scale-100');
        }

        function closeChangelogModal() {
            const modal = document.getElementById('changelogModal');
            document.getElementById('changelogContent').classList.remove('scale-100');
            document.getElementById('changelogContent').classList.add('scale-95');
            modal.classList.add('opacity-0', 'pointer-events-none');
        }

        // Tutup modal dengan klik di luar area atau tombol Esc
        window.addEventListener('click', function(e) {
            if (e.target.id === 'avatarModal') closeAvatarModal();
            if (e.target.id === 'changelogModal') closeChangelogModal();
        });
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeAvatarModal();
                closeChangelogModal();
            }
        });
    </script> -->
@endpush