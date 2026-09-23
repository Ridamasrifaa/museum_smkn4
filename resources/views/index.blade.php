@extends('layouts.app')

@section('title', 'Museum Karya - SMKN 4 Tasikmalaya')
@section('body_class', 'scroll-smooth bg-[#FFFDF5] dark:bg-zinc-950 text-slate-900 dark:text-zinc-100 antialiased transition-colors duration-300')

@push('styles')
    <style>
        /* CSS untuk Background Kotak-kotak (Grid Pattern) */
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

        /* CSS untuk Background Gambar Testimoni/Kata Pengunjung */
        .bg-testimonial-pattern {
            background-color: #D48EE3;
            background-image: url('{{ asset("assets/img/testimonial-bg.png") }}');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }

        .card-hover {
          transition: all 0.15s ease-in-out;
        }
        .card-hover:hover {
          transform: translate(-4px, -4px);
          box-shadow: 10px 10px 0px #000000;
        }
        .dark .card-hover:hover {
          box-shadow: 10px 10px 0px #f4f4f5;
        }
        .scroll-smooth {
          scroll-behavior: smooth;
        }
        button {
          transition: all 0.1s ease-in-out;
        }
        button:hover {
          transform: translate(-2px, -2px);
          box-shadow: 5px 5px 0px #000000;
        }
        .dark button:hover {
          box-shadow: 5px 5px 0px #f4f4f5;
        }
        button:active {
          transform: translate(2px, 2px);
          box-shadow: 1px 1px 0px #000000;
        }
        .dark button:active {
          box-shadow: 1px 1px 0px #f4f4f5;
        }

        /* Iframe preview container */
        .iframe-container {
          position: relative;
          width: 100%;
          height: 192px;
          overflow: hidden;
          background: #FFFDF5;
        }
        .dark .iframe-container {
          background: #18181b;
        }
        .iframe-container iframe {
          position: absolute;
          top: 0;
          left: 0;
          width: 400%;
          height: 400%;
          transform: scale(0.25);
          transform-origin: 0 0;
          border: none;
          pointer-events: none;
        }
        .iframe-container .overlay {
          position: absolute;
          inset: 0; 
          cursor: pointer;
          background: transparent;
        }
        .iframe-container .overlay:hover {
          background: rgba(0, 0, 0, 0.04);
        }
        .dark .iframe-container .overlay:hover {
          background: rgba(255, 255, 255, 0.06);
        }
        .counter {
          font-size: 4rem;
          font-weight: 900;
          line-height: 1;
          letter-spacing: -2px;
          color: #000000;
        }
        .dark .counter {
          color: #ffffff;
        }
        .counter-card {
          opacity: 0;
          transform: translateY(20px);
          transition: opacity 0.6s ease, transform 0.6s ease;
        }
        .counter-card.show {
          opacity: 1;
          transform: translateY(0);
        }
        @keyframes marquee {
          0% { transform: translateX(0%); }
          100% { transform: translateX(-50%); }
        }
        .animate-marquee {
          display: flex;
          width: max-content;
          animation: marquee 20s linear infinite;
        }
        .animate-marquee:hover {
          animation-play-state: paused;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
@endpush

@section('content')
    <!-- ===== HERO (Video Section) ===== -->
    <section id="beranda"
        class="relative text-white flex items-center justify-center overflow-hidden h-[60vh] min-h-[400px] border-b-4 border-black dark:border-white bg-black mt-4">
        <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover opacity-50">
            <source src="{{ asset('assets/img/museum_karya.mp4') }}" type="video/mp4">
        </video>
        <div class="absolute inset-0 bg-[#74B9FF]/30 dark:bg-sky-900/40 mix-blend-multiply"></div>
        <div class="relative z-10 mx-auto max-w-5xl px-6 lg:px-8 text-center">
            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black leading-tight text-white drop-shadow-[4px_4px_0px_#000]">
                SELAMAT DATANG DI MUSEUM KARYA SMKN 4 TASIKMALAYA
            </h1>
        </div>
    </section>

    <!-- ===== LOGO JURUSAN BERJALAN ===== -->
    <div class="w-full bg-white dark:bg-zinc-900 border-b-4 border-black dark:border-white py-6 shadow-[0px_6px_0px_#000] dark:shadow-[0px_6px_0px_#fff] overflow-hidden relative transition-colors duration-300">
        <div class="flex animate-marquee items-center gap-20 whitespace-nowrap">
            <div class="flex items-center gap-20">
                <div class="flex items-center gap-3">
                    <span class="font-black text-black dark:text-white text-lg tracking-wider">DKV</span>
                </div>
                <div class="flex items-center gap-3">
                    <span class="font-black text-black dark:text-white text-lg tracking-wider">PPLG</span>
                </div>
                <div class="flex items-center gap-3">
                    <span class="font-black text-black dark:text-white text-lg tracking-wider">TKJ</span>
                </div>
                <div class="flex items-center gap-3">
                    <span class="font-black text-black dark:text-white text-lg tracking-wider">TOI</span>
                </div>
                <div class="flex items-center gap-3">
                    <span class="font-black text-black dark:text-white text-lg tracking-wider">TSM</span>
                </div>
                <div class="flex items-center gap-3">
                    <span class="font-black text-black dark:text-white text-lg tracking-wider">SMKN 4</span>
                </div>
            </div>
            <div class="flex items-center gap-20">
                <div class="flex items-center gap-3">
                    <span class="font-black text-black dark:text-white text-lg tracking-wider">DKV</span>
                </div>
                <div class="flex items-center gap-3">
                    <span class="font-black text-black dark:text-white text-lg tracking-wider">PPLG</span>
                </div>
                <div class="flex items-center gap-3">
                    <span class="font-black text-black dark:text-white text-lg tracking-wider">TKJ</span>
                </div>
                <div class="flex items-center gap-3">
                    <span class="font-black text-black dark:text-white text-lg tracking-wider">TOI</span>
                </div>
                <div class="flex items-center gap-3">
                    <span class="font-black text-black dark:text-white text-lg tracking-wider">TSM</span>
                </div>
                <div class="flex items-center gap-3">
                    <span class="font-black text-black dark:text-white text-lg tracking-wider">SMKN 4</span>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== STATISTIK ===== -->
    <section class="py-16 bg-[#FFFDF5] dark:bg-zinc-950 border-b-4 border-black dark:border-white transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-wrap justify-center gap-8">
                <div class="counter-card w-full sm:w-72 bg-white dark:bg-zinc-900 rounded-3xl p-8 text-center border-4 border-black dark:border-white shadow-[6px_6px_0px_#000] dark:shadow-[6px_6px_0px_#fff] rotate-[-1deg]">
                    <div class="flex justify-center items-end gap-1">
                        <h2 class="counter text-black dark:text-white font-black text-6xl" data-target="{{ $totalKarya }}">0</h2>
                    </div>
                    <p class="text-black mt-2 font-black uppercase text-sm tracking-widest bg-[#FFD23F] border-2 border-black py-1 rounded-xl shadow-[2px_2px_0px_#000]">Total Karya</p>
                </div>
                <div class="counter-card w-full sm:w-72 bg-white dark:bg-zinc-900 rounded-3xl p-8 text-center border-4 border-black dark:border-white shadow-[6px_6px_0px_#000] dark:shadow-[6px_6px_0px_#fff] rotate-[1deg]">
                    <h2 class="counter text-black dark:text-white font-black text-6xl" data-target="{{ $totalSiswa }}">0</h2>
                    <p class="text-black mt-2 font-black uppercase text-sm tracking-widest bg-[#74B9FF] border-2 border-black py-1 rounded-xl shadow-[2px_2px_0px_#000]">Total Siswa</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== SEMUA KARYA ===== -->
    <section id="karya" class="py-16 bg-[#FFFDF5] dark:bg-zinc-950 bg-grid-pattern border-b-4 border-black dark:border-white overflow-hidden transition-colors duration-300">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="flex items-center justify-between mb-12">
                <h2 class="text-3xl sm:text-4xl font-black text-black tracking-tight bg-[#FFD23F] px-4 py-2 border-3 border-black shadow-[4px_4px_0px_#000] inline-block">SEMUA KARYA</h2>
                <a href="{{ url('/karya') }}"
                    class="text-black font-black px-5 py-3 bg-[#88D498] border-3 border-black rounded-2xl shadow-[4px_4px_0px_#000] hover:bg-[#72c784] flex items-center gap-2 transition-all">
                    Lihat Semua
                    <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

            <div id="allKaryaGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($projects->take(4) as $project)
                    @php
                        $avatarUrl = '';
                        if ($project->user->avatar) {
                            if (str_starts_with($project->user->avatar, 'http')) {
                                $avatarUrl = $project->user->avatar;
                            } else {
                                $cleanPath = str_replace('/storage/', '', $project->user->avatar);
                                $avatarUrl = asset('storage/' . $cleanPath);
                            }
                        }
                    @endphp

                    <div class="karya-card bg-white dark:bg-zinc-900 rounded-3xl overflow-hidden border-4 border-black dark:border-white shadow-[6px_6px_0px_#000] dark:shadow-[6px_6px_0px_#fff] card-hover transition-all duration-200"
                        data-title="{{ $project->title }}"
                        data-desc="{{ $project->description }}"
                        data-category="{{ $project->jurusan }}"
                        data-event="Museum Karya"
                        data-siswa="{{ $project->user->name }}"
                        data-guru="{{ $project->guru_pengampu ?? '-' }}"
                        data-avatar="{{ $avatarUrl }}"
                        data-avatar-letter="{{ strtoupper(substr($project->user->name, 0, 1)) }}"
                        data-kelas="{{ $project->user->kelas ?? '-' }}"
                        data-jurusan-siswa="{{ $project->user->jurusan ?? '-' }}"
                        data-angkatan="{{ $project->user->angkatan ?? '-' }}"
                        data-tahun="{{ $project->created_at->format('Y') }}"
                        data-views="{{ $project->views_count }}"
                        data-likes="{{ $project->likes_count }}"
                        data-tech="{{ $project->technology_stack }}"
                        data-live="{{ $project->live_link }}"
                        data-github="{{ $project->github_link ?? '' }}"
                        data-file-path="{{ $project->file_path ? asset('storage/' . $project->file_path) : '' }}"
                        data-file-type="{{ $project->file_type }}"
                        data-download="{{ $project->file_path ? asset('storage/' . $project->file_path) : '' }}">

                        <div class="iframe-container cursor-pointer border-b-4 border-black dark:border-white" onclick="openModal(this.closest('.karya-card'))">
                            @php
                                $isImage = $project->file_path && str_starts_with($project->file_type ?? '', 'image/');
                            @endphp
                            @if ($isImage)
                                <img src="{{ asset('storage/' . $project->file_path) }}" alt="{{ $project->title }}"
                                    class="w-full h-full object-cover" />
                            @elseif ($project->live_link)
                                <iframe src="{{ $project->live_link }}" loading="lazy"></iframe>
                            @else
                                <div class="flex items-center justify-center h-full bg-[#FFFDF5] dark:bg-zinc-800 text-black dark:text-white font-black">
                                    Tidak ada Preview
                                </div>
                            @endif
                            <div class="overlay"></div>
                        </div>

                        <div class="p-6">
                            <span class="badge-custom mb-3 inline-block bg-[#FFD23F] border-2 border-black font-black text-black px-3 py-1 rounded-xl text-xs shadow-[2px_2px_0px_#000]">{{ $project->jurusan }}</span>
                            <p class="text-slate-700 dark:text-zinc-400 text-xs font-black mt-1">
                                Oleh: <strong class="text-black dark:text-white">{{ $project->user->name }}</strong>
                            </p>
                            <p class="font-black text-black dark:text-white text-lg my-2 line-clamp-1">{{ $project->title }}</p>
                            <button onclick="openModal(this.closest('.karya-card'))"
                                class="w-full mt-4 py-3 bg-[#74B9FF] hover:bg-[#54a0ff] text-black font-black rounded-2xl border-3 border-black shadow-[3px_3px_0px_#000] cursor-pointer transition-all">
                                LIHAT DETAIL
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="col-span-4 text-center py-20">
                        <h2 class="text-2xl font-black text-black dark:text-white">Belum ada karya yang disetujui</h2>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- ===== FOOTER ===== -->
    <footer class="bg-gray-900 dark:bg-black text-white text-center py-12 mt-16 border-t-4 border-black dark:border-white">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="pt-4">
                <p class="text-gray-300 font-bold text-sm">&copy; {{ date('Y') }} Museum Karya SMKN 4 Tasikmalaya</p>
                <p class="text-gray-400 text-xs mt-1">
                    Design &amp; Development By 
                    <a href="{{ route('developer') }}" class="text-blue-500 dark:text-blue-400 font-bold underline decoration-2 underline-offset-4 hover:text-blue-600 transition-colors">
                        Team Developer PPLG
                    </a>
                </p>
            </div>
        </div>
    </footer>

    <!-- ===== MODAL DETAIL ===== -->
    <div id="detailModal"
        class="hidden fixed inset-0 bg-black/60 backdrop-blur-xs z-50 flex items-center justify-center p-4">
        <div class="bg-white dark:bg-zinc-900 rounded-3xl border-4 border-black dark:border-white shadow-[8px_8px_0px_#000] dark:shadow-[8px_8px_0px_#fff] max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="sticky top-0 px-6 py-4 border-b-4 border-black dark:border-white flex justify-between items-center bg-[#FFD23F] z-10">
                <h3 id="modalTitle" class="text-xl font-black text-black"></h3>
                <button onclick="closeModal()" class="w-10 h-10 bg-white border-3 border-black rounded-xl flex items-center justify-center font-black text-black hover:bg-[#FF6B6B] hover:text-white transition cursor-pointer shadow-[3px_3px_0px_#000]">
                    ✕
                </button>
            </div>

            <div class="p-6 space-y-6">
                <!-- Preview -->
                <div id="modalPreview" class="space-y-4">
                    <img id="modalImagePreview" class="hidden w-full rounded-2xl object-contain max-h-[360px] border-3 border-black dark:border-white shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff]" />
                    <iframe id="modalIframePreview" class="hidden w-full h-80 rounded-2xl border-3 border-black dark:border-white shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff]"
                        allowfullscreen></iframe>
                    <div id="modalPreviewEmpty"
                        class="hidden w-full h-80 flex items-center justify-center rounded-2xl bg-[#FFFDF5] dark:bg-zinc-800 text-black dark:text-white border-3 border-black dark:border-white font-black shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff]">
                        Tidak ada preview tersedia
                    </div>
                </div>

                <!-- Badge -->
                <div class="flex gap-2 flex-wrap">
                    <span class="inline-block bg-[#88D498] text-black px-3 py-1.5 rounded-xl border-2 border-black text-xs font-black shadow-[2px_2px_0px_#000]">
                        Disetujui
                    </span>
                    <span id="modalCategory"
                        class="inline-block bg-[#FFD23F] text-black px-3 py-1.5 rounded-xl border-2 border-black text-xs font-black shadow-[2px_2px_0px_#000]"></span>
                    <span id="modalEvent"
                        class="inline-block bg-[#B8A9FA] text-black px-3 py-1.5 rounded-xl border-2 border-black text-xs font-black shadow-[2px_2px_0px_#000]"></span>
                </div>

                <!-- Deskripsi -->
                <div>
                    <h4 class="font-black text-black dark:text-white mb-2 text-lg">Deskripsi</h4>
                    <p id="modalDescription" class="text-slate-800 dark:text-zinc-200 font-bold leading-relaxed text-sm sm:text-base bg-[#FFFDF5] dark:bg-zinc-800 p-4 rounded-2xl border-2 border-black dark:border-white"></p>
                </div>

                <!-- AVATAR + BIODATA SISWA -->
                <div class="bg-[#74B9FF]/20 dark:bg-sky-900/30 border-3 border-black dark:border-white p-4 rounded-2xl shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff]">
                    <div class="flex items-center gap-4">
                        <div id="modalAvatar"
                            class="w-14 h-14 bg-[#FFD23F] text-black border-3 border-black dark:border-white rounded-full flex items-center justify-center font-black text-xl overflow-hidden shrink-0 shadow-[3px_3px_0px_#000]">
                        </div>
                        <div class="min-w-0">
                            <p id="modalSiswa" class="font-black text-black dark:text-white text-lg truncate"></p>
                            <p id="modalBiodata" class="text-xs font-black text-slate-700 dark:text-zinc-400"></p>
                            <p id="modalGuru" class="text-xs font-bold text-slate-600 dark:text-zinc-500 mt-0.5"></p>
                        </div>
                    </div>
                </div>

                <!-- Info tambahan -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-[#FFA552]/30 dark:bg-orange-900/30 border-3 border-black dark:border-white p-4 rounded-2xl shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff]">
                        <p class="text-xs text-black dark:text-zinc-300 font-black mb-1 uppercase tracking-wider">Kategori</p>
                        <p id="modalKategoriDetail" class="font-black text-black dark:text-white text-base"></p>
                    </div>
                    <div class="bg-[#88D498]/30 dark:bg-emerald-900/30 border-3 border-black dark:border-white p-4 rounded-2xl shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff]">
                        <p class="text-xs text-black dark:text-zinc-300 font-black mb-1 uppercase tracking-wider">Tahun</p>
                        <p id="modalTahun" class="font-black text-black dark:text-white text-base"></p>
                    </div>
                </div>

                <!-- Teknologi -->
                <div class="bg-[#B8A9FA]/30 dark:bg-violet-900/30 border-3 border-black dark:border-white p-4 rounded-2xl shadow-[4px_4px_0px_#000] dark:shadow-[4px_4px_0px_#fff]">
                    <p class="text-xs text-black dark:text-zinc-300 font-black mb-1 uppercase tracking-wider">Teknologi</p>
                    <p id="modalTech" class="font-black text-black dark:text-white text-base"></p>
                </div>

                <!-- Tombol Aksi: kiri = link project (live), kanan = link github (ikon GitHub khusus PPLG) -->
                <div class="pt-4 border-t-3 border-black dark:border-white">
                    <div id="modalActionContainer" class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <a id="liveBtn" href="#" target="_blank"
                            class="w-full px-4 py-3.5 bg-[#FFD23F] hover:bg-[#ffc107] text-black rounded-2xl font-black transition text-center border-3 border-black shadow-[4px_4px_0px_#000] flex items-center justify-center gap-2">
                            <span id="liveBtnText">Buka Live</span>
                        </a>
                        <a id="extraBtn" href="#" target="_blank"
                            class="w-full px-4 py-3.5 bg-[#74B9FF] hover:bg-[#54a0ff] text-black rounded-2xl font-black transition text-center border-3 border-black shadow-[4px_4px_0px_#000] flex items-center justify-center gap-2">
                            <svg id="extraBtnIcon" class="hidden w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 .5C5.73.5.5 5.73.5 12.03c0 5.09 3.29 9.4 7.86 10.93.58.11.79-.25.79-.56 0-.28-.01-1.02-.02-2-3.2.7-3.88-1.54-3.88-1.54-.52-1.34-1.28-1.7-1.28-1.7-1.04-.72.08-.7.08-.7 1.15.08 1.76 1.19 1.76 1.19 1.03 1.76 2.7 1.25 3.36.96.1-.75.4-1.25.73-1.54-2.55-.29-5.23-1.28-5.23-5.68 0-1.25.44-2.28 1.18-3.08-.12-.29-.51-1.46.11-3.04 0 0 .97-.31 3.18 1.18a10.9 10.9 0 015.79 0c2.2-1.49 3.17-1.18 3.17-1.18.63 1.58.24 2.75.12 3.04.74.8 1.18 1.83 1.18 3.08 0 4.41-2.69 5.38-5.25 5.67.41.36.78 1.06.78 2.14 0 1.55-.01 2.79-.01 3.17 0 .31.21.68.8.56A10.53 10.53 0 0023.5 12.03C23.5 5.73 18.27.5 12 .5z"/>
                            </svg>
                            <span id="extraBtnText">Github</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
@endsection

@push('scripts')
<script src="{{ asset('assets/js/index.js') }}"></script>
@endpush