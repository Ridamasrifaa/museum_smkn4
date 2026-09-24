@extends('layouts.admin')

@section('title', 'Manajemen Data Karya')
@section('page_title', 'Manajemen Data Karya')

@section('content')

    {{-- SPINNER OVERLAY --}}
    <div id="loading-content" class="absolute inset-0 bg-[#fcfcfc]/90 z-40 flex flex-col items-center justify-center transition-opacity duration-300 ease-out">
        <div class="flex items-center gap-3 bg-white px-6 py-3 rounded-xl border-3 border-black shadow-[4px_4px_0px_#000]">
            <div class="w-5 h-5 border-3 border-black border-t-[#ffcc00] rounded-full animate-spin"></div>
            <p class="text-gray-900 font-extrabold text-sm tracking-wide">Memuat data karya...</p>
        </div>
    </div>

    {{-- Form Pencarian --}}
    <div class="neubrutal-card mb-4 sm:mb-6 p-4 sm:p-6">
        <h2 class="text-base sm:text-xl font-black text-gray-900 mb-3">Cari Karya</h2>
        <form action="{{ url('/admin/karya') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari judul, jurusan, atau siswa..."
                class="flex-1 px-3 py-2 sm:px-4 sm:py-2.5 rounded-xl input-neubrutal text-xs sm:text-sm text-gray-800">
            <div class="flex gap-2">
                <button type="submit" class="flex-1 sm:flex-none px-4 py-2 sm:px-6 sm:py-2.5 bg-[#ffcc00] text-black rounded-xl btn-neubrutal text-xs sm:text-sm cursor-pointer">Cari</button>
                <a href="{{ url('/admin/karya') }}" class="flex-1 sm:flex-none px-4 py-2 sm:px-6 sm:py-2.5 bg-gray-200 text-black rounded-xl btn-neubrutal text-xs sm:text-sm text-center">Reset</a>
            </div>
        </form>
    </div>

    {{-- KARTU KONTEN TABEL & MOBILE CARD VIEW --}}
    <div class="neubrutal-card overflow-hidden mb-6">
        <div class="px-4 py-3 sm:px-6 sm:py-4 border-b-3 border-black bg-gray-50">
            <h2 class="text-base sm:text-xl font-black text-gray-900">Daftar Karya</h2>
        </div>

        {{-- 1. TAMPILAN KHUSUS MOBILE (CARD VIEW) --}}
        <div class="block sm:hidden divide-y-2 divide-gray-200">
            @forelse($projects as $project)
                <div class="p-4 space-y-3">
                    <div class="flex items-start justify-between gap-2">
                        <div>
                            <h3 class="font-bold text-gray-900 text-sm leading-snug">{{ $project->title }}</h3>
                            <p class="text-xs text-gray-500 font-semibold mt-0.5">Siswa: {{ $project->user->name ?? '-' }}</p>
                        </div>
                        <span class="px-2 py-0.5 bg-blue-100 text-blue-800 border-2 border-black rounded-md text-[10px] font-black shadow-[1.5px_1.5px_0px_#000] shrink-0">
                            {{ $project->jurusan }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between gap-2 pt-1">
                        @php
                            $badge = match($project->status) {
                                'approved' => ['Disetujui', 'bg-green-100 text-green-800'],
                                'rejected' => ['Ditolak', 'bg-red-100 text-red-800'],
                                default => ['Menunggu', 'bg-yellow-100 text-yellow-800'],
                            };
                        @endphp
                        <span class="inline-block px-2.5 py-1 rounded-lg text-xs font-black {{ $badge[1] }} border-2 border-black shadow-[2px_2px_0px_#000]">
                            {{ $badge[0] }}
                        </span>
                        <div class="flex gap-2">
                            <a href="{{ url('/admin/karya/' . $project->id) }}" class="px-3 py-1 bg-blue-400 text-black border-2 border-black rounded-lg font-black text-xs shadow-[2px_2px_0px_#000]">Detail</a>
                            <form action="{{ url('/admin/karya/' . $project->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Hapus karya ini?')" class="px-3 py-1 bg-red-400 text-black border-2 border-black rounded-lg font-black text-xs shadow-[2px_2px_0px_#000] cursor-pointer">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-10 text-gray-500 font-bold text-sm">Belum ada karya ditemukan.</div>
            @endforelse
        </div>

        {{-- 2. TAMPILAN TABEL DESKTOP --}}
        <div class="hidden sm:block w-full overflow-x-auto">
            <table class="w-full border-collapse">
                <thead class="bg-gray-100 border-b-3 border-black">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-black text-gray-900 uppercase tracking-wider">Judul & Siswa</th>
                        <th class="px-6 py-3 text-left text-xs font-black text-gray-900 uppercase tracking-wider">Jurusan</th>
                        <th class="px-6 py-3 text-center text-xs font-black text-gray-900 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-center text-xs font-black text-gray-900 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y-2 divide-gray-200">
                    @forelse($projects as $project)
                        <tr class="hover:bg-yellow-50/50">
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-900 text-sm">{{ $project->title }}</div>
                                <div class="text-xs text-gray-500 font-semibold mt-0.5">Siswa: {{ $project->user->name ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 border-2 border-black rounded-lg text-xs font-black shadow-[2px_2px_0px_#000]">{{ $project->jurusan }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @php
                                    $badge = match($project->status) {
                                        'approved' => ['Disetujui', 'bg-green-100 text-green-800'],
                                        'rejected' => ['Ditolak', 'bg-red-100 text-red-800'],
                                        default => ['Menunggu', 'bg-yellow-100 text-yellow-800'],
                                    };
                                @endphp
                                <span class="inline-block px-3 py-1 rounded-lg text-xs font-black {{ $badge[1] }} border-2 border-black shadow-[2px_2px_0px_#000]">{{ $badge[0] }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex gap-2 justify-center">
                                    <a href="{{ url('/admin/karya/' . $project->id) }}" class="px-3 py-1.5 bg-blue-400 text-black border-2 border-black rounded-lg font-black text-xs shadow-[2px_2px_0px_#000]">Detail</a>
                                    <form action="{{ url('/admin/karya/' . $project->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Hapus karya ini?')" class="px-3 py-1.5 bg-red-400 text-black border-2 border-black rounded-lg font-black text-xs shadow-[2px_2px_0px_#000] cursor-pointer">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-12 text-gray-500 font-bold text-sm">Belum ada karya ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Footer Pagination --}}
        <div class="px-3 py-3 sm:px-6 sm:py-4 border-t-3 border-black bg-gray-50 flex flex-col sm:flex-row gap-3 justify-between items-center text-xs sm:text-sm text-gray-800 font-bold text-center">
            <span>Menampilkan <b>{{ $projects->count() }}</b> dari <b>{{ $projects->total() ?? $projects->count() }}</b> karya</span>
            <div>
                {{ $projects->links() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/admin/dashboard.js') }}"></script>
@endpush