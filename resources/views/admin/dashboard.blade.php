@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page_title', 'Dashboard Admin ' . ($user->isSuperAdmin() ? 'Utama' : $user->jurusan))

@section('content')

    {{-- Loading Screen --}}
    <div id="loading-content" class="absolute inset-0 bg-[#fcfcfc]/90 z-50 flex flex-col items-center justify-center transition-opacity duration-300 ease-out">
        <div class="flex items-center gap-3 bg-white px-6 py-3 rounded-xl border-3 border-black shadow-[4px_4px_0px_#000]">
            <div class="w-5 h-5 border-3 border-black border-t-[#ffcc00] rounded-full animate-spin"></div>
            <p class="text-gray-900 font-extrabold text-sm tracking-wide">Memuat data museum...</p>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <div class="p-6 counter-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-xs font-black uppercase tracking-wider">Total Karya</p>
                    <p class="text-3xl font-black text-gray-900 mt-2">{{ $totalProject }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 border-2 border-black rounded-xl flex items-center justify-center text-blue-600 font-bold shadow-[2px_2px_0px_#000]">🎨</div>
            </div>
        </div>

        <div class="p-6 counter-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-xs font-black uppercase tracking-wider">Karya Menunggu</p>
                    <p class="text-3xl font-black text-yellow-600 mt-2">{{ $pending }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 border-2 border-black rounded-xl flex items-center justify-center text-yellow-600 font-bold shadow-[2px_2px_0px_#000]">⏳</div>
            </div>
        </div>

        <div class="p-6 counter-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-xs font-black uppercase tracking-wider">Karya Disetujui</p>
                    <p class="text-3xl font-black text-green-600 mt-2">{{ $approved }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 border-2 border-black rounded-xl flex items-center justify-center text-green-600 font-bold shadow-[2px_2px_0px_#000]">✅</div>
            </div>
        </div>

        <div class="p-6 counter-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-xs font-black uppercase tracking-wider">Total Siswa {{ $user->isSuperAdmin() ? '' : '(' . $user->jurusan . ')' }}</p>
                    <p class="text-3xl font-black text-purple-600 mt-2">{{ $totalSiswa }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 border-2 border-black rounded-xl flex items-center justify-center text-purple-600 font-bold shadow-[2px_2px_0px_#000]">🎓</div>
            </div>
        </div>
    </div>

    {{-- BAGIAN OVERVIEW (2 Kolom) --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6 sm:mt-8">

        {{-- Kolom Kiri: Perlu Moderasi Cepat --}}
        <div class="p-6 stats-section-card flex flex-col justify-between">
            <div>
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-lg font-black text-gray-900">Perlu Moderasi Cepat</h3>
                        <p class="text-xs font-bold text-gray-500">Karya siswa yang masih menunggu peninjauan admin</p>
                    </div>
                    <a href="{{ url('/admin/karya') }}" class="text-xs font-black text-black hover:underline">Lihat Semua</a>
                </div>

                <div class="space-y-3">
                    @forelse($pendingProjects as $item)
                        <div class="p-3.5 bg-gray-50 border-2 border-black rounded-xl flex items-center justify-between gap-3 shadow-[2px_2px_0px_#000]">
                            <div class="min-w-0">
                                <h4 class="font-black text-gray-900 text-sm truncate">{{ $item->title }}</h4>
                                <p class="text-xs text-gray-500 font-bold">Oleh: {{ $item->user->name ?? 'Siswa' }} • <span class="text-blue-700">{{ $item->jurusan }}</span></p>
                            </div>
                            <a href="{{ url('/admin/karya/' . $item->id) }}" class="shrink-0 px-3 py-1.5 bg-sky-400 text-black border-2 border-black rounded-lg font-black text-xs shadow-[2px_2px_0px_#000] hover:translate-y-[-1px] transition">
                                Tinjau
                            </a>
                        </div>
                    @empty
                        <div class="text-center py-6 text-gray-400 text-sm font-bold">
                            🎉 Tidak ada karya baru yang menunggu peninjauan.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Karya Terbaru Disetujui --}}
        <div class="p-6 stats-section-card flex flex-col justify-between">
            <div>
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-lg font-black text-gray-900">Karya Terbaru Disetujui</h3>
                        <p class="text-xs font-bold text-gray-500">Karya siswa yang baru saja disetujui admin</p>
                    </div>
                    <a href="{{ url('/admin/karya') }}" class="text-xs font-black text-black hover:underline">Lihat Semua</a>
                </div>

                <div class="space-y-3">
                    @forelse($approvedProjects as $item)
                        <div class="p-3.5 bg-gray-50 border-2 border-black rounded-xl flex items-center justify-between gap-3 shadow-[2px_2px_0px_#000]">
                            <div class="min-w-0">
                                <h4 class="font-black text-gray-900 text-sm truncate">{{ $item->title }}</h4>
                                <p class="text-xs text-gray-500 font-bold">Siswa: {{ $item->user->name ?? 'Siswa' }}</p>
                            </div>
                            <span class="shrink-0 px-3 py-1 rounded-lg text-xs font-black bg-green-200 text-green-900 border-2 border-black shadow-[2px_2px_0px_#000]">
                                Disetujui
                            </span>
                        </div>
                    @empty
                        <div class="text-center py-6 text-gray-400 text-sm font-bold">
                            Belum ada karya yang disetujui.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/admin/dashboard.js') }}"></script>
    <script>
        window.addEventListener("load", function () {
            const loadingContent = document.getElementById("loading-content");
            const counterCards = document.querySelectorAll(".counter-card");
            const statsSectionCards = document.querySelectorAll(".stats-section-card");

            if (loadingContent) {
                setTimeout(() => {
                    loadingContent.classList.add("opacity-0");
                    setTimeout(() => {
                        loadingContent.classList.add("hidden");
                        counterCards.forEach((card, index) => setTimeout(() => card.classList.add("show"), index * 100));
                        statsSectionCards.forEach((card, index) => setTimeout(() => card.classList.add("show"), (counterCards.length * 100) + (index * 150)));
                    }, 300);
                }, 800);
            }
        });
    </script>
@endpush