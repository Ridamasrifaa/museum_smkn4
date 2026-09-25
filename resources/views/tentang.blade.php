@extends('layouts.app')

@section('title', 'Tentang — Museum Karya SMKN 4 Tasikmalaya')
@section('body_class', 'bg-[#FFFDF5] dark:bg-zinc-950 text-slate-900 dark:text-zinc-100 transition-colors duration-300 antialiased min-h-screen flex flex-col justify-between')

@push('styles')
    <style>
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
        <main class="py-12 sm:py-16">
            <section class="pb-10 text-center">
                <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
                    <span class="inline-block px-4 py-1.5 mb-4 text-xs font-black uppercase tracking-wider text-black bg-yellow-300 rounded-full border-2 border-black shadow-[2px_2px_0px_#000]"> Informasi Proyek </span>
                    <h1 class="text-3xl sm:text-5xl font-black text-slate-900 dark:text-white mb-4 tracking-tight uppercase">Tentang Museum Karya</h1>
                    <p class="text-slate-700 dark:text-gray-300 text-sm sm:text-base font-medium max-w-2xl mx-auto leading-relaxed">Mengenal latar belakang pengerjaan proyek dan tujuan pengembangannya untuk siswa-siswi SMKN 4 Tasikmalaya.</p>
                </div>
            </section>

            <section id="tentang-proyek" class="mx-auto max-w-4xl px-4 sm:px-6">
                <div class="bg-white dark:bg-gray-900 p-6 sm:p-10 rounded-2xl border-3 border-black dark:border-white shadow-[5px_5px_0px_0px_#000] dark:shadow-[5px_5px_0px_0px_#fff] transition-colors duration-300">
                    <div class="space-y-4 sm:space-y-6 text-slate-800 dark:text-gray-200 leading-relaxed text-sm sm:text-base md:text-lg font-medium">
                        <p>
                            <strong class="text-black dark:text-white font-black">Museum Karya</strong> hadir sebagai wadah digital terintegrasi yang dirancang khusus untuk menampung, mendokumentasikan, dan mempublikasikan berbagai hasil karya siswa-siswi SMKN 4 Tasikmalaya. Potensi kreativitas dan inovasi yang dihasilkan oleh para siswa sangat kaya, sehingga sangat disayangkan apabila karya-karya luar biasa tersebut hanya tersimpan tanpa sempat diapresiasi secara luas.
                        </p>
                        <p>
                            Platform ini dikembangkan melalui <span class="bg-cyan-200 dark:bg-cyan-900 text-black dark:text-cyan-200 px-1.5 py-0.5 font-bold border border-black dark:border-white rounded">kolaborasi antar tim pengembang</span> yang mulai dikerjakan secara intensif pada tanggal <span class="bg-yellow-200 dark:bg-yellow-900 text-black dark:text-yellow-200 px-1.5 py-0.5 font-bold border border-black dark:border-white rounded">28 Juni 2026</span>. Melalui kolaborasi ini, diharapkan Museum Karya dapat menjadi galeri digital terdepan yang tidak hanya memamerkan portofolio terbaik siswa, tetapi juga menginspirasi lahirnya karya-karya baru di lingkungan SMKN 4 Tasikmalaya.
                        </p>
                    </div>

                    <div class="mt-8 p-5 sm:p-6 rounded-xl bg-amber-100 dark:bg-gray-800 border-2 border-black dark:border-white shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] dark:shadow-[3px_3px_0px_0px_rgba(255,255,255,1)] flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="text-center sm:text-left">
                            <p class="text-sm font-black text-black dark:text-white">Penasaran siapa saja yang membangun platform ini?</p>
                            <p class="text-xs text-gray-700 dark:text-gray-300 font-semibold mt-0.5">Kenali profil, peran, serta portofolio dari masing-masing pengembang.</p>
                        </div>
                        <a href="{{ route('developer') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-pink-400 dark:bg-pink-600 text-black dark:text-white font-black text-sm transition-all neop-btn-box shrink-0">
                            Sapa Tim Pengembang
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>

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
                            <p class="text-[10px] sm:text-xs uppercase tracking-wider text-gray-600 dark:text-gray-400 font-black text-center sm:text-left">Versi Sistem</p>
                            <div class="flex items-center justify-center sm:justify-start gap-3 mt-1">
                                <span id="app-version" class="text-sm sm:text-base font-black text-blue-600 dark:text-blue-400">v1.1</span>
                                <button onclick="openChangelogModal()" class="text-[10px] px-2.5 py-1 rounded bg-yellow-300 text-black border border-black font-black hover:bg-yellow-400 cursor-pointer shadow-[2px_2px_0px_0px_#000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all">
                                    Terbaru
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

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

    <div id="changelogModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-xs opacity-0 pointer-events-none transition-all duration-300">
        <div id="changelogContent" class="relative max-w-lg w-full mx-4 bg-section-box bg-white dark:bg-zinc-900 rounded-3xl border-4 border-black dark:border-white shadow-[8px_8px_0px_#000] dark:shadow-[8px_8px_0px_#fff] transform scale-95 transition-all duration-300 max-h-[80vh] flex flex-col overflow-hidden">
            <div class="px-6 py-4 bg-[#FFD23F] border-b-4 border-black dark:border-white flex items-center justify-between gap-4">
                <h3 class="text-lg font-black uppercase text-black">Riwayat Pembaruan</h3>
                <button onclick="closeChangelogModal()" aria-label="Tutup" class="w-10 h-10 shrink-0 flex items-center justify-center bg-[#FF6B6B] text-black font-black border-3 border-black rounded-xl shadow-[3px_3px_0px_#000] hover:bg-white cursor-pointer">
                    ✕
                </button>
            </div>
            <div class="p-6 sm:p-8 flex flex-col min-h-0">
                <p class="text-xs font-bold text-zinc-700 dark:text-zinc-300 mb-4 pb-3 border-b-2 border-dashed border-black dark:border-white">Catatan versi dan log perubahan aplikasi Museum Karya.</p>
                <div id="changelogList" class="overflow-y-auto space-y-6 pr-1 text-left">
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{ asset('assets/js/app.js')}}"></script>