@extends('layouts.siswa')

@section('title', 'Dashboard')
@section('page_title', 'Student Dashboard')

@section('content')
    <div class="flex-1 p-4 sm:p-6 lg:p-8 space-y-4 sm:space-y-6 relative">

        {{-- Loading screen --}}
        <div id="loading-content" class="absolute inset-0 bg-[#FAF7F2] z-40 flex flex-col items-center justify-center transition-opacity duration-300 ease-out">
            <div class="flex items-center gap-3 bg-white px-6 py-3.5 rounded-2xl neo-border neo-shadow">
                <div class="w-5 h-5 border-3 border-slate-900 border-t-transparent rounded-full animate-spin"></div>
                <p class="text-slate-900 font-extrabold text-sm tracking-wide">Memuat halaman dashboard...</p>
            </div>
        </div>

        {{-- Banner Selamat Datang --}}
        <div class="bg-[#C7D2FE] neo-border neo-shadow-lg rounded-2xl p-5 sm:p-8 text-slate-900">
            <h2 class="text-2xl sm:text-3xl font-black mb-2">Selamat Datang, {{ explode(' ', Auth::user()->name)[0] }}! 👋</h2>
            <p class="font-bold text-slate-800">Kelola dan kirim karyamu dengan mudah</p>
        </div>

        {{-- Cards Statistik --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
            {{-- Total Karya --}}
            <div class="bg-[#FEF08A] rounded-2xl p-6 neo-border neo-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-800 text-xs font-black uppercase tracking-wider">Total Karya</p>
                        <p class="text-4xl font-black text-slate-900 mt-2">{{ $totalProject ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-white text-slate-900 rounded-xl neo-border flex items-center justify-center text-xl font-bold">
                        📊
                    </div>
                </div>
            </div>

            {{-- Karya Disetujui --}}
            <div class="bg-[#BBF7D0] rounded-2xl p-6 neo-border neo-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-800 text-xs font-black uppercase tracking-wider">Karya Disetujui</p>
                        <p class="text-4xl font-black text-slate-900 mt-2">{{ $approved ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-white text-emerald-700 rounded-xl neo-border flex items-center justify-center text-xl font-black">
                        ✓
                    </div>
                </div>
            </div>

            {{-- Menunggu Review --}}
            <div class="bg-[#FED7AA] rounded-2xl p-6 neo-border neo-shadow sm:col-span-2 lg:col-span-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-800 text-xs font-black uppercase tracking-wider">Menunggu Review</p>
                        <p class="text-4xl font-black text-slate-900 mt-2">{{ $pending ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-white text-amber-700 rounded-xl neo-border flex items-center justify-center text-xl font-bold">
                        ⏳
                    </div>
                </div>
            </div>
        </div>

        {{-- Aksi Cepat --}}
        <div class="bg-white rounded-2xl p-4 sm:p-6 neo-border neo-shadow">
            <h3 class="text-lg font-black text-slate-900 mb-4">Aksi Cepat</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="{{ url('/siswa/upload') }}" class="block p-5 bg-[#E0E7FF] rounded-xl neo-border neo-btn">
                    <p class="font-black text-slate-900">Upload Project Baru</p>
                    <p class="text-xs font-bold text-slate-700 mt-1">Mulai upload karya terbaru mu</p>
                </a>
                <a href="{{ url('/siswa/karya') }}" class="block p-5 bg-[#DCFCE7] rounded-xl neo-border neo-btn">
                    <p class="font-black text-slate-900">Lihat Karya Ku</p>
                    <p class="text-xs font-bold text-slate-700 mt-1">Cek status semua karya yang sudah diupload</p>
                </a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        window.addEventListener('load', function () {
            const loadingContent = document.getElementById('loading-content');
            setTimeout(() => {
                loadingContent.classList.add('opacity-0');
                setTimeout(() => loadingContent.classList.add('hidden'), 300);
            }, 1000);
        });
    </script>
@endpush