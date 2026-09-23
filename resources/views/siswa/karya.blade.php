@extends('layouts.siswa')

@section('title', 'My karya Gue')
@section('page_title', 'Karya gue')

@section('content')
    <div class="flex-1 p-4 sm:p-6 lg:p-8 relative">

        {{-- Loading Screen --}}
        <div id="loading-content"
            class="absolute inset-0 bg-[#FAF7F2] z-40 flex flex-col items-center justify-center transition-opacity duration-300 ease-out">
            <div class="flex items-center gap-3 bg-white px-6 py-3.5 rounded-2xl neo-border neo-shadow">
                <div class="w-5 h-5 border-3 border-slate-900 border-t-transparent rounded-full animate-spin"></div>
                <p class="text-slate-900 font-extrabold text-sm tracking-wide">Memuat daftar karya...</p>
            </div>
        </div>

        {{-- Table Card --}}
        <div class="bg-white neo-border neo-shadow-lg rounded-2xl overflow-hidden">
            <div class="px-4 sm:px-6 py-4 sm:py-5 border-b-[3px] border-slate-900">
                <h2 class="text-lg sm:text-xl font-black text-slate-900">My Karya Gue</h2>
                <p class="text-sm font-bold text-slate-500 mt-1">Kelola dan pantau status karya kamu yang telah dikirim</p>
            </div>

            {{-- Tabel: tablet & desktop --}}
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-[#F1F5F9] border-b-[3px] border-slate-900">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-black text-slate-700 uppercase tracking-wider">Judul Karya</th>
                            <th class="px-6 py-3 text-left text-xs font-black text-slate-700 uppercase tracking-wider">Jurusan</th>
                            <th class="px-6 py-3 text-left text-xs font-black text-slate-700 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-black text-slate-700 uppercase tracking-wider">Tanggal Dikirim</th>
                            <th class="px-6 py-3 text-left text-xs font-black text-slate-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-[3px] divide-slate-900">
                        @forelse ($projects as $project)
                            <tr class="hover:bg-[#F8FAFC]">
                                <td class="px-6 py-4 text-sm font-extrabold text-slate-900">
                                    {{ $project->title }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 bg-[#E0E7FF] text-indigo-800 rounded-full text-xs font-black neo-border">
                                        {{ $project->jurusan ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($project->status == 'approved')
                                        <span class="px-3 py-1 bg-[#BBF7D0] text-emerald-800 rounded-full text-xs font-black neo-border">Disetujui</span>
                                    @elseif ($project->status == 'pending')
                                        <span class="px-3 py-1 bg-[#FED7AA] text-amber-800 rounded-full text-xs font-black neo-border">Menunggu</span>
                                    @else
                                        <span class="px-3 py-1 bg-[#FDA4AF] text-rose-900 rounded-full text-xs font-black neo-border">Ditolak</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm font-bold text-slate-600">
                                    {{ $project->created_at->translatedFormat('d M Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <a href="{{ url('/siswa/karya/detail/' . $project->id) }}"
                                            class="text-indigo-600 hover:text-indigo-800 text-sm font-extrabold">Lihat</a>
                                        <form action="{{ url('/siswa/karya/' . $project->id) }}" method="POST"
                                            onsubmit="return confirm('Hapus karya ini?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-[#F43F5E] hover:text-rose-700 text-sm font-extrabold cursor-pointer">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-10 text-slate-500 text-sm font-extrabold">
                                    Belum ada nich karya yang dikirim.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Kartu: HP (menggantikan tabel) --}}
            <div class="md:hidden p-4 space-y-4">
                @forelse ($projects as $project)
                    <div class="bg-white neo-border neo-shadow-sm rounded-2xl p-4">
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-wider">Judul Karya</p>
                                <h3 class="mt-0.5 text-base font-black text-slate-900 leading-snug break-words">{{ $project->title }}</h3>
                            </div>
                            @if ($project->status == 'approved')
                                <span class="shrink-0 px-3 py-1 bg-[#BBF7D0] text-emerald-800 rounded-full text-[11px] font-black neo-border">Disetujui</span>
                            @elseif ($project->status == 'pending')
                                <span class="shrink-0 px-3 py-1 bg-[#FED7AA] text-amber-800 rounded-full text-[11px] font-black neo-border">Menunggu</span>
                            @else
                                <span class="shrink-0 px-3 py-1 bg-[#FDA4AF] text-rose-900 rounded-full text-[11px] font-black neo-border">Ditolak</span>
                            @endif
                        </div>

                        <div class="mt-4 grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-wider">Jurusan</p>
                                <span class="mt-1 inline-block px-3 py-1 bg-[#E0E7FF] text-indigo-800 rounded-full text-xs font-black neo-border">
                                    {{ $project->jurusan ?? '-' }}
                                </span>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-wider">Tanggal Dikirim</p>
                                <p class="mt-1 text-sm font-bold text-slate-700">{{ $project->created_at->translatedFormat('d M Y') }}</p>
                            </div>
                        </div>

                        <div class="mt-4 flex gap-3">
                            <a href="{{ url('/siswa/karya/detail/' . $project->id) }}"
                                class="flex-1 px-3 py-2.5 bg-[#818CF8] text-white text-center text-xs font-black rounded-xl neo-border neo-shadow-sm neo-btn">
                                Lihat
                            </a>
                            <form action="{{ url('/siswa/karya/' . $project->id) }}" method="POST"
                                onsubmit="return confirm('Hapus karya ini?');" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full px-3 py-2.5 bg-[#FDA4AF] hover:bg-[#F43F5E] text-slate-900 text-xs font-black rounded-xl neo-border neo-shadow-sm neo-btn cursor-pointer">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-10 text-slate-500 text-sm font-extrabold">
                        Belum ada nich karya yang dikirim.
                    </div>
                @endforelse
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