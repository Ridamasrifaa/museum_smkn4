@extends('layouts.app')

@section('title', 'Profil ' . $user->name . ' - Museum Karya SMKN 4 Tasikmalaya')
@section('body_class', 'bg-[#fffdf9] dark:bg-zinc-950 text-zinc-900 dark:text-zinc-100 transition-colors duration-300 antialiased flex flex-col min-h-screen')

@push('styles')
    <style>
        .bg-grid-pattern {
            background-image:
                linear-gradient(to right, rgba(0, 0, 0, 0.05) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(0, 0, 0, 0.05) 1px, transparent 1px);
            background-size: 30px 30px;
        }
        .dark .bg-grid-pattern {
            background-image:
                linear-gradient(to right, rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
        }
        .card-hover:hover { transform: translate(-3px, -3px); box-shadow: 8px 8px 0 0 #18181b; }
        .dark .card-hover:hover { box-shadow: 8px 8px 0 0 #f4f4f5; }
        .nb-btn { transition: transform .1s, box-shadow .1s; }
        .nb-btn:active { transform: translate(2px, 2px); box-shadow: 0 0 0 0 #000; }
    </style>
@endpush

@section('content')
@php
    $av = $user->avatar ?? null;
    $avatarUrl = $av
        ? (str_starts_with($av, 'http') ? $av : (str_starts_with($av, '/storage') ? asset($av) : asset('storage/' . $av)))
        : null;
@endphp

<section class="flex-grow bg-grid-pattern py-8">
    <div class="mx-auto max-w-5xl px-4 lg:px-8 space-y-8">

        <a href="{{ url('/karya') }}"
           class="nb-btn inline-block px-4 py-2 bg-yellow-300 text-zinc-900 font-black text-xs rounded-xl border-2 border-zinc-900 shadow-[3px_3px_0px_#18181b]">
            ← Kembali ke Museum Karya
        </a>

        {{-- ===== Header profil ===== --}}
        <div class="bg-white dark:bg-zinc-900 rounded-3xl overflow-hidden border-[3px] border-zinc-900 dark:border-zinc-100 shadow-[8px_8px_0px_0px_#18181b] dark:shadow-[8px_8px_0px_0px_#f4f4f5]">
            <div class="h-20 sm:h-28 bg-sky-400 dark:bg-sky-900 border-b-[3px] border-zinc-900 dark:border-zinc-100"></div>

            <div class="px-6 pb-6 flex flex-col sm:flex-row items-center sm:items-start gap-5">
                {{-- Avatar bulat (klik = perbesar) --}}
                <div class="relative overflow-hidden shrink-0 -mt-12 sm:-mt-14 w-24 h-24 sm:w-28 sm:h-28 bg-yellow-300 text-zinc-900 border-[3px] border-zinc-900 rounded-full shadow-[4px_4px_0px_#18181b] flex items-center justify-center font-black text-4xl">
                    @if($avatarUrl)
                        <button type="button" data-avatar-full="{{ $avatarUrl }}" aria-label="Perbesar foto profil" class="absolute inset-0 w-full h-full cursor-zoom-in">
                            <img src="{{ $avatarUrl }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                        </button>
                    @else
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    @endif
                </div>

                <div class="flex-1 min-w-0 text-center sm:text-left space-y-3 sm:pt-4">
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3">
                        <h1 class="text-2xl sm:text-3xl font-black tracking-tight break-words">{{ $user->name }}</h1>
                        <span class="self-center sm:self-auto px-2.5 py-1 bg-yellow-300 text-zinc-900 text-[11px] font-black rounded-lg border-2 border-zinc-900 shadow-[2px_2px_0px_#18181b]">
                            {{ $user->jurusan ?? 'PPLG' }}
                        </span>
                    </div>

                    <p class="text-sm font-bold text-zinc-700 dark:text-zinc-300 leading-relaxed whitespace-pre-line">{{ $user->bio ?? 'Belum ada bio.' }}</p>

                    <div class="flex flex-wrap justify-center sm:justify-start gap-2">
                        <span class="px-3 py-1.5 bg-sky-300 text-zinc-900 text-xs font-black rounded-xl border-2 border-zinc-900 shadow-[2px_2px_0px_#18181b]">
                            <span class="text-base">{{ $user->projects->count() }}</span> Karya
                        </span>
                        @if(!empty($user->instagram))
                            @php
                                // Membersihkan input Instagram (menghapus URL lengkap atau tanda @ di depan)
                                $igClean = trim($user->instagram);
                                $igClean = preg_replace('/^https?:\/\/(www\.)?instagram\.com\//', '', $igClean);
                                $igClean = ltrim($igClean, '@/');
                                $igClean = rtrim($igClean, '/');
                            @endphp
                            <a href="https://instagram.com/{{ $igClean }}" target="_blank" rel="noopener"
                            class="flex items-center gap-1.5 px-3 py-1.5 bg-pink-300 text-zinc-900 text-xs font-black rounded-xl border-2 border-zinc-900 shadow-[2px_2px_0px_#18181b] hover:bg-pink-400 transition">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                                Instagram
                            </a>
                        @endif
                                                @if(!empty($user->kelas))
                            <span class="px-3 py-1.5 bg-zinc-100 dark:bg-zinc-800 text-xs font-black rounded-xl border-2 border-zinc-900 dark:border-zinc-100">{{ $user->kelas }}</span>
                        @endif
                        @if(!empty($user->angkatan))
                            <span class="px-3 py-1.5 bg-zinc-100 dark:bg-zinc-800 text-xs font-black rounded-xl border-2 border-zinc-900 dark:border-zinc-100">Angkatan {{ $user->angkatan }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== Grid karya ===== --}}
        <div>
            <h2 class="inline-block mb-6 px-3 py-1.5 bg-yellow-300 text-zinc-900 text-sm font-black rounded-xl border-2 border-zinc-900 shadow-[3px_3px_0px_#18181b]">
                Karya yang di-upload
            </h2>

            @if($user->projects->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($user->projects as $project)
                        @php
                            $isImage = $project->file_path && (
                                empty($project->file_type)
                                || str_starts_with($project->file_type, 'image/')
                                || preg_match('/\.(jpe?g|png|gif|webp|svg)$/i', $project->file_path)
                            );
                            $liked = in_array($project->id, $likedIds);
                        @endphp
                        <div class="card-hover bg-white dark:bg-zinc-900 rounded-3xl overflow-hidden border-[3px] border-zinc-900 dark:border-zinc-100 shadow-[6px_6px_0px_0px_#18181b] dark:shadow-[6px_6px_0px_0px_#f4f4f5] transition-all flex flex-col">

                            {{-- Preview: gambar -> iframe live_link -> placeholder. Link transparan di atasnya supaya tetap bisa diklik --}}
                            <div class="relative h-44 bg-zinc-100 dark:bg-zinc-800 border-b-[3px] border-zinc-900 dark:border-zinc-100 overflow-hidden">
                                @if($isImage)
                                    <img src="{{ asset('storage/' . $project->file_path) }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
                                @elseif($project->live_link)
                                    <iframe src="{{ $project->live_link }}" title="{{ $project->title }}" loading="lazy" tabindex="-1"
                                            class="absolute top-0 left-0 w-[300%] h-[300%] origin-top-left scale-[0.3334] border-0 pointer-events-none bg-white"></iframe>
                                @else
                                    <div class="flex items-center justify-center h-full text-xs font-bold text-zinc-400">Tidak ada preview</div>
                                @endif
                                <a href="{{ route('project.detail', $project->id) }}" class="absolute inset-0" aria-label="Buka {{ $project->title }}"></a>
                            </div>

                            <div class="p-4 flex-grow">
                                <span class="inline-block px-2 py-0.5 bg-yellow-300 text-zinc-900 text-[10px] font-black rounded-md border-2 border-zinc-900 shadow-[2px_2px_0px_#18181b]">
                                    {{ $project->jurusan ?? 'PPLG' }}
                                </span>
                                <a href="{{ route('project.detail', $project->id) }}" class="block mt-2 font-black text-sm truncate hover:underline">{{ $project->title }}</a>
                            </div>

                            {{-- Like, komentar, bagikan --}}
                            <div class="px-4 py-3 border-t-2 border-dashed border-zinc-300 dark:border-zinc-700 flex items-center gap-2">
                                <button type="button" data-like="{{ $project->id }}"
                                        class="nb-btn flex items-center gap-1.5 px-2.5 py-1.5 bg-white dark:bg-zinc-800 font-black text-xs rounded-lg border-2 border-zinc-900 dark:border-zinc-100 shadow-[2px_2px_0px_#18181b] dark:shadow-[2px_2px_0px_#f4f4f5] cursor-pointer">
                                    <svg class="w-4 h-4 {{ $liked ? 'text-red-500' : '' }}" fill="{{ $liked ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                    <span class="like-count">{{ $project->likes_count ?? 0 }}</span>
                                </button>

                                {{-- #komentar = panel komentar langsung terbuka di halaman detail --}}
                                <a href="{{ route('project.detail', $project->id) }}#komentar"
                                   class="nb-btn flex items-center gap-1.5 px-2.5 py-1.5 bg-sky-300 text-zinc-900 font-black text-xs rounded-lg border-2 border-zinc-900 shadow-[2px_2px_0px_#18181b]">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                    <span>{{ $project->comments_count ?? 0 }}</span>
                                </a>

                                <button type="button" data-share="{{ route('project.detail', $project->id) }}"
                                        class="nb-btn ml-auto px-2.5 py-1.5 bg-white dark:bg-zinc-800 font-black text-xs rounded-lg border-2 border-zinc-900 dark:border-zinc-100 shadow-[2px_2px_0px_#18181b] dark:shadow-[2px_2px_0px_#f4f4f5] cursor-pointer">
                                    <span>Bagikan</span>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16 bg-white dark:bg-zinc-900 rounded-3xl border-[3px] border-dashed border-zinc-900 dark:border-zinc-100">
                    <p class="text-sm font-black">Belum ada karya yang di-upload.</p>
                </div>
            @endif
        </div>
    </div>
</section>

{{-- ===== Perbesar foto profil ===== --}}
<div id="avatar-modal" class="hidden fixed inset-0 z-50 bg-zinc-950/80 backdrop-blur-xs items-center justify-center p-4">
    <div class="relative">
        <img id="avatar-modal-img" src="" alt="Foto profil"
             class="max-h-[80vh] max-w-full rounded-3xl border-[3px] border-zinc-900 dark:border-zinc-100 shadow-[8px_8px_0px_0px_#18181b] dark:shadow-[8px_8px_0px_0px_#f4f4f5] bg-white">
        <button type="button" data-avatar-close aria-label="Tutup"
                class="nb-btn absolute -top-3 -right-3 w-9 h-9 bg-yellow-300 text-zinc-900 border-2 border-zinc-900 rounded-xl font-black shadow-[2px_2px_0px_#000] cursor-pointer">✕</button>
    </div>
</div>
@endsection

@push('scripts')
<div id="profile-config" hidden
     data-csrf="{{ csrf_token() }}"
     data-like-base="{{ url('/project') }}"></div>

<script>
    const cfg = document.getElementById('profile-config').dataset;

    // ===== Like (tamu & user login boleh, klik lagi = unlike) =====
    function paintLike(btn, liked) {
        const icon = btn.querySelector('svg');
        icon.setAttribute('fill', liked ? 'currentColor' : 'none');
        icon.classList.toggle('text-red-500', liked);
    }

    async function toggleLike(btn) {
        if (btn.disabled) return;
        btn.disabled = true;
        try {
            const res = await fetch(`${cfg.likeBase}/${btn.dataset.like}/like`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': cfg.csrf, 'Accept': 'application/json' }
            });
            if (!res.ok) throw new Error();
            const data = await res.json();
            btn.querySelector('.like-count').textContent = data.likes_count;
            paintLike(btn, data.liked);
        } catch (_) {
            alert('Gagal memproses like.');
        } finally {
            btn.disabled = false;
        }
    }

    // ===== Bagikan =====
    function shareProject(btn) {
        const label = btn.querySelector('span');
        navigator.clipboard.writeText(btn.dataset.share).then(() => {
            label.textContent = 'Tersalin!';
            setTimeout(() => label.textContent = 'Bagikan', 1500);
        });
    }

    // ===== Foto profil =====
    const avatarModal = document.getElementById('avatar-modal');
    function openAvatar(url) {
        document.getElementById('avatar-modal-img').src = url;
        avatarModal.classList.remove('hidden');
        avatarModal.classList.add('flex');
    }
    function closeAvatar() {
        avatarModal.classList.add('hidden');
        avatarModal.classList.remove('flex');
    }

    // ===== Satu listener untuk semua tombol (tanpa onclick di HTML) =====
    document.addEventListener('click', e => {
        const like = e.target.closest('[data-like]');
        if (like) return toggleLike(like);

        const share = e.target.closest('[data-share]');
        if (share) return shareProject(share);

        const avatar = e.target.closest('[data-avatar-full]');
        if (avatar) return openAvatar(avatar.dataset.avatarFull);

        if (e.target === avatarModal || e.target.closest('[data-avatar-close]')) closeAvatar();
    });
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeAvatar(); });
</script>
@endpush