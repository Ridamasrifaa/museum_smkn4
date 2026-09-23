@extends('layouts.app')

@section('title', 'Artikel - Museum Karya SMKN 4 Tasikmalaya')
@section('body_class', 'bg-white dark:bg-zinc-950 text-zinc-900 dark:text-zinc-100 transition-colors duration-300 antialiased flex flex-col min-h-screen')

@push('styles')
    <style>
        /* Pola Sinar Memancar (Sunburst Background) BIRU MUDA & PUTIH untuk Hero Section */
        .bg-sunburst {
            background-color: #ffffff;
            background-image: repeating-conic-gradient(
                from 0deg at 50% 50%,
                rgba(56, 189, 248, 0.22) 0deg,
                rgba(56, 189, 248, 0.22) 20deg,
                transparent 20deg,
                transparent 40deg
            );
        }
        .dark .bg-sunburst {
            background-color: #09090b;
            background-image: repeating-conic-gradient(
                from 0deg at 50% 50%,
                rgba(56, 189, 248, 0.06) 0deg,
                rgba(56, 189, 248, 0.06) 20deg,
                transparent 20deg,
                transparent 40deg
            );
        }

        /* Pola Kotak-kotak (Grid Pattern untuk Background Section Artikel di Bawah) */
        .bg-grid-pattern {
            background-color: #ffffff;
            background-image:
                linear-gradient(to right, rgba(0, 0, 0, 0.08) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(0, 0, 0, 0.08) 1px, transparent 1px);
            background-size: 24px 24px;
        }
        .dark .bg-grid-pattern {
            background-color: #09090b;
            background-image:
                linear-gradient(to right, rgba(255, 255, 255, 0.07) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255, 255, 255, 0.07) 1px, transparent 1px);
            background-size: 24px 24px;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/css/theme.css') }}">
@endpush

@section('content')
    <!-- ===== HERO SECTION (Background Biru Muda & Putih Sunburst) ===== -->
    <div class="bg-sunburst border-b-3 border-zinc-900 dark:border-zinc-100 pb-20 lg:pb-28 pt-8 transition-colors duration-300">
        <section class="relative pt-12 lg:pt-16 pb-8 text-center overflow-hidden">
            <div class="relative z-10 mx-auto max-w-3xl px-6 lg:px-8 flex flex-col items-center">

                <!-- Badge Kecil di Atas -->
                <div class="inline-flex items-center gap-2 px-4 py-1.5 mb-6 bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white font-black text-xs uppercase tracking-widest rounded-full border-2 border-zinc-900 dark:border-zinc-100 shadow-[3px_3px_0px_0px_#18181b]">
                    <span>Berita &amp; Kegiatan</span>
                </div>

                <!-- Judul Utama Atas -->
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black uppercase tracking-tight text-zinc-900 dark:text-white mb-4">
                    Artikel Museum Karya
                </h1>

                <!-- Kotak Judul Kuning Khas Neo-Brutalisme -->
                <div class="bg-yellow-300 text-zinc-900 border-3 border-zinc-900 px-8 py-4 rounded-3xl shadow-[6px_6px_0px_0px_#18181b] mb-6 transform -rotate-1">
                    <span class="text-xl sm:text-2xl lg:text-3xl font-black uppercase tracking-tight">SMKN 4 TASIKMALAYA</span>
                </div>

                <!-- Deskripsi -->
                <p class="max-w-xl text-sm sm:text-base font-bold text-zinc-600 dark:text-zinc-300 leading-relaxed">
                    Temukan liputan kegiatan, informasi terbaru, dan cerita inspiratif dari Museum Karya. Cari artikel yang paling menarik untukmu.
                </p>

            </div>
        </section>
    </div>

    <!-- ===== DAFTAR ARTIKEL (Background Kotak-kotak / Grid Pattern) ===== -->
    <main class="bg-grid-pattern py-16 flex-grow w-full">
        <div class="max-w-7xl mx-auto px-6">

            @if ($articles->count())

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

                    @foreach ($articles as $article)
                        <article class="bg-white dark:bg-zinc-900 rounded-3xl overflow-hidden border-3 border-zinc-900 dark:border-zinc-100 shadow-[6px_6px_0px_0px_#18181b] dark:shadow-[6px_6px_0px_0px_#f4f4f5] transition-all duration-300 hover:-translate-y-1 flex flex-col">
                            <div class="overflow-hidden border-b-3 border-zinc-900 dark:border-zinc-100">
                                <img src="{{ asset('storage/' . $article->cover) }}" alt="{{ $article->title }}"
                                    class="w-full h-60 object-cover">
                            </div>

                            <div class="p-6 flex flex-col flex-grow">
                                <span class="inline-flex w-fit rounded-xl bg-sky-200 text-zinc-900 border-2 border-zinc-900 px-3 py-1 text-xs font-black shadow-[2px_2px_0px_0px_#18181b] mb-4">
                                    {{ $article->category->name }}
                                </span>

                                <h2 class="text-xl font-black text-zinc-900 dark:text-white leading-snug line-clamp-2">
                                    {{ $article->title }}
                                </h2>

                                <p class="mt-3 text-zinc-600 dark:text-zinc-300 text-xs sm:text-sm font-medium leading-relaxed line-clamp-3">
                                    {{ $article->excerpt }}
                                </p>

                                <div class="mt-6 flex flex-wrap items-center gap-2 text-xs text-zinc-500 dark:text-zinc-400 font-bold">
                                    <span>{{ $article->author->name }}</span>
                                    <span>•</span>
                                    <span>{{ $article->created_at->format('d M Y') }}</span>
                                </div>

                                <div class="mt-auto pt-6">
                                    <a href="{{ route('artikel.show', $article->slug) }}"
                                        class="w-full inline-flex items-center justify-center rounded-xl bg-cyan-300 hover:bg-cyan-400 px-5 py-3 text-sm font-black text-zinc-900 border-2 border-zinc-900 shadow-[3px_3px_0px_0px_#18181b] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition">
                                        Baca Selengkapnya &rarr;
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach

                </div>

            @else

                <div class="text-center py-24 bg-white dark:bg-zinc-900 rounded-3xl border-3 border-zinc-900 dark:border-zinc-100 shadow-[6px_6px_0px_0px_#18181b] dark:shadow-[6px_6px_0px_0px_#f4f4f5]">
                    <h2 class="text-2xl sm:text-3xl font-black uppercase text-zinc-900 dark:text-white">
                        Belum ada artikel.
                    </h2>
                    <p class="mt-3 text-zinc-600 dark:text-zinc-300 font-bold">
                        Artikel akan muncul setelah dipublikasikan oleh admin.
                    </p>
                </div>

            @endif

        </div>
    </main>

    <!-- ===== FOOTER ===== -->
    <footer class="bg-zinc-900 text-white text-center py-8 border-t-3 border-zinc-900">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <p class="text-xs font-bold">&copy; {{ date('Y') }} Museum Karya SMKN 4 Tasikmalaya</p>
            <p class="text-xs font-bold text-cyan-300 mt-1">Design &amp; Development By PPLG</p>
        </div>
    </footer>

    
@endsection

@push('scripts')
<script src="{{ asset('assets/js/artikel.js') }}"></script>
@endpush