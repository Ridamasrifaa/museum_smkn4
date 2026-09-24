@extends('layouts.admin')

@section('title', 'Manajemen Data Siswa')
@section('page_title', 'Manajemen Data Siswa')

@section('content')

    {{-- Container Utama --}}
    <div class="relative min-h-[400px]">

        {{-- Loading Screen --}}
        <div id="loading-content" class="absolute inset-0 bg-[#fcfcfc] z-40 flex flex-col items-center justify-center transition-opacity duration-200 ease-out rounded-xl">
            <div class="flex items-center gap-3 bg-white px-6 py-3 rounded-xl border-3 border-black shadow-[4px_4px_0px_#000]">
                <div class="w-5 h-5 border-3 border-black border-t-[#ffcc00] rounded-full animate-spin"></div>
                <p class="text-gray-900 font-extrabold text-sm tracking-wide">Memuat data siswa...</p>
            </div>
        </div>

        {{-- Form Pencarian --}}
        <div class="neubrutal-card mb-4 sm:mb-6 p-4 sm:p-6">
            <h2 class="text-base sm:text-xl font-black text-gray-900 mb-3">Cari Siswa</h2>
            <form action="{{ url('/admin/siswa') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari nama, kelas, atau email siswa..."
                    class="flex-1 px-3 py-2 sm:px-4 sm:py-2.5 rounded-xl input-neubrutal text-xs sm:text-sm text-gray-800" />
                <div class="flex gap-2">
                    <button type="submit" class="flex-1 sm:flex-none px-4 py-2 sm:px-6 sm:py-2.5 bg-[#ffcc00] text-black rounded-xl btn-neubrutal cursor-pointer text-xs sm:text-sm">
                        Cari Siswa
                    </button>
                    <a href="{{ url('/admin/siswa') }}" class="flex-1 sm:flex-none px-4 py-2 sm:px-6 sm:py-2.5 bg-gray-200 text-black rounded-xl btn-neubrutal text-center text-xs sm:text-sm">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        {{-- CONTAINER DAFTAR SISWA --}}
        <div class="neubrutal-card overflow-hidden mb-6">
            <div class="px-4 py-3 sm:px-6 sm:py-4 border-b-3 border-black bg-gray-50">
                <h2 class="text-base sm:text-xl font-black text-gray-900">Daftar Siswa</h2>
            </div>

            {{-- 1. TAMPILAN MOBILE (KARTU / CARD) --}}
            <div class="block sm:hidden divide-y-2 divide-gray-200">
                @forelse($siswas as $siswa)
                    <div class="p-4 space-y-3">
                        <div class="flex justify-between items-start gap-2">
                            <div>
                                <h3 class="font-black text-gray-900 text-base">{{ $siswa->name }}</h3>
                                <p class="text-xs text-gray-500 font-semibold">{{ $siswa->email }}</p>
                            </div>
                            <span class="px-2.5 py-0.5 bg-blue-100 text-blue-800 border-2 border-black rounded-lg text-xs font-black shadow-[2px_2px_0px_#000] shrink-0">
                                {{ $siswa->kelas ?? '-' }}
                            </span>
                        </div>
                        
                        <p class="text-xs text-gray-700 italic bg-gray-50 p-2 rounded-lg border border-gray-200 line-clamp-2">
                            "{{ $siswa->bio ?? 'Belum ada bio' }}"
                        </p>

                        <div class="flex justify-end items-center pt-1">
                            <form action="{{ url('/admin/siswa/' . $siswa->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Hapus siswa ini?')" class="px-3.5 py-1.5 bg-red-400 text-black border-2 border-black rounded-xl font-black text-xs shadow-[2px_2px_0px_#000] cursor-pointer active:translate-y-0.5">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 text-gray-500 font-bold text-sm">
                        Belum ada siswa ditemukan.
                    </div>
                @endforelse
            </div>

            {{-- 2. TAMPILAN DESKTOP (TABEL) --}}
            <div class="hidden sm:block overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b-3 border-black bg-yellow-100/60 text-sm font-black text-gray-900">
                            <th class="p-4">Nama Siswa</th>
                            <th class="p-4">Kelas</th>
                            <th class="p-4">Bio</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-gray-200 text-sm font-bold">
                        @forelse($siswas as $siswa)
                            <tr class="hover:bg-yellow-50/40 transition">
                                <td class="p-4">
                                    <div class="font-black text-gray-900 text-base">{{ $siswa->name }}</div>
                                    <div class="text-xs text-gray-500 font-semibold">{{ $siswa->email }}</div>
                                </td>
                                <td class="p-4">
                                    <span class="px-2.5 py-0.5 bg-blue-100 text-blue-800 border-2 border-black rounded-lg text-xs font-black shadow-[2px_2px_0px_#000] inline-block">
                                        {{ $siswa->kelas ?? '-' }}
                                    </span>
                                </td>
                                <td class="p-4 max-w-xs truncate text-xs text-gray-600 italic">
                                    {{ $siswa->bio ?? '-' }}
                                </td>
                                <td class="p-4 text-center">
                                    <form action="{{ url('/admin/siswa/' . $siswa->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Hapus siswa ini?')" class="px-3.5 py-1.5 bg-red-400 text-black border-2 border-black rounded-xl font-black text-xs shadow-[2px_2px_0px_#000] cursor-pointer hover:translate-y-[-1px]">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-10 text-gray-500 font-bold text-sm">
                                    Belum ada siswa ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- FOOTER PAGINATION --}}
            <div class="px-3 py-3 sm:px-6 sm:py-4 border-t-3 border-black bg-gray-50 flex flex-col-reverse sm:flex-row gap-3 justify-between items-center text-xs sm:text-sm text-gray-800 font-bold text-center">
                <span class="w-full sm:w-auto">Total: <span class="font-black">{{ $totalSiswa }}</span> Siswa</span>
                <div class="w-full sm:w-auto flex justify-center">
                    {{ $siswas->links() }}
                </div>
            </div>
        </div>

    </div>

    <script src="{{ asset('assets/js/admin/siswa.js')}}"></script>
@endsection