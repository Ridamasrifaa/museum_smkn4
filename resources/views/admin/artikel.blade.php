@extends('layouts.admin')

@section('title', 'Kelola Artikel')
@section('page_title', 'Kelola Artikel')

@section('header_action')
    <a href="{{ route('articles.create') }}" class="px-3 py-2 sm:px-4 sm:py-2 bg-[#ffcc00] text-black rounded-xl btn-neubrutal flex items-center gap-1.5 text-xs sm:text-sm">
        <span class="font-black text-base leading-none">+</span>
        <span class="hidden sm:inline">Tambah Artikel</span>
        <span class="sm:hidden">Tambah</span>
    </a>
@endsection

@section('content')

    <div id="loading-content" class="absolute inset-0 bg-[#fcfcfc]/90 z-40 flex flex-col items-center justify-center transition-opacity duration-300 ease-out">
        <div class="flex items-center gap-3 bg-white px-6 py-3 rounded-xl border-3 border-black shadow-[4px_4px_0px_#000]">
            <div class="w-5 h-5 border-3 border-black border-t-[#ffcc00] rounded-full animate-spin"></div>
            <p class="text-gray-900 font-extrabold text-sm tracking-wide">Memuat daftar artikel...</p>
        </div>
    </div>

    {{-- KARTU STATISTIK RINGKAS --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-4 mb-6">
        <div class="neubrutal-card p-4 sm:p-5">
            <p class="text-xs sm:text-sm text-gray-600 font-bold mb-1">Total Artikel</p>
            <p class="text-xl sm:text-2xl font-black text-gray-900">{{ $articles->count() }}</p>
        </div>
        <div class="neubrutal-card p-4 sm:p-5">
            <p class="text-xs sm:text-sm text-gray-600 font-bold mb-1">Sudah Terbit</p>
            <p class="text-xl sm:text-2xl font-black text-green-600">{{ $articles->where('status','published')->count() }}</p>
        </div>
        <div class="neubrutal-card p-4 sm:p-5">
            <p class="text-xs sm:text-sm text-gray-600 font-bold mb-1">Draft</p>
            <p class="text-xl sm:text-2xl font-black text-amber-600">{{ $articles->where('status','draft')->count() }}</p>
        </div>
    </div>

    {{-- FILTER & SEARCH --}}
    <div class="neubrutal-card p-4 sm:p-5 mb-6">
        <div class="flex flex-col md:flex-row gap-3 md:items-center">
            <input id="searchInput" type="text" placeholder="Cari judul artikel..." class="flex-1 px-4 py-2.5 rounded-xl input-neubrutal text-sm text-gray-800" />

            <div class="grid grid-cols-2 md:flex gap-3">
                <select id="statusFilter" class="w-full md:w-auto px-3 sm:px-4 py-2.5 rounded-xl input-neubrutal text-xs sm:text-sm text-gray-800 bg-white">
                    <option value="">Semua Status</option>
                    <option value="published">Terbit</option>
                    <option value="draft">Draft</option>
                </select>

                <select id="categoryFilter" class="w-full md:w-auto px-3 sm:px-4 py-2.5 rounded-xl input-neubrutal text-xs sm:text-sm text-gray-800 bg-white">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="button" onclick="runFilter()" class="w-full md:w-auto px-5 py-2.5 bg-[#ffcc00] text-black rounded-xl btn-neubrutal text-sm cursor-pointer">Terapkan</button>
        </div>
    </div>

    {{-- RESPONSIVE LIST / TABLE CONTAINER --}}
    <div class="neubrutal-card overflow-hidden">

        {{-- 1. TAMPILAN DESKTOP (TABEL) --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full border-collapse">
                <thead class="bg-gray-100 border-b-3 border-black">
                    <tr>
                        <th class="px-6 py-3.5 text-left text-xs font-black text-gray-900 uppercase">Judul</th>
                        <th class="px-6 py-3.5 text-left text-xs font-black text-gray-900 uppercase">Kategori</th>
                        <th class="px-6 py-3.5 text-left text-xs font-black text-gray-900 uppercase">Penulis</th>
                        <th class="px-6 py-3.5 text-left text-xs font-black text-gray-900 uppercase">Status</th>
                        <th class="px-6 py-3.5 text-center text-xs font-black text-gray-900 uppercase">Sorotan</th>
                        <th class="px-6 py-3.5 text-left text-xs font-black text-gray-900 uppercase">Tanggal</th>
                        <th class="px-6 py-3.5 text-center text-xs font-black text-gray-900 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody id="articleTableBody" class="divide-y-2 divide-gray-200">
                    @forelse($articles as $article)
                        <tr class="article-row hover:bg-yellow-50/50" data-title="{{ strtolower($article->title) }}" data-category="{{ $article->category?->name }}" data-status="{{ $article->status }}">
                            <td class="px-6 py-4 text-sm font-bold text-gray-900 max-w-xs truncate">{{ $article->title }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700 font-medium">{{ $article->category?->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700 font-medium">{{ $article->author->name }}</td>
                            <td class="px-6 py-4 text-sm">
                                @if($article->status == 'published')
                                    <span class="inline-block px-3 py-1 rounded-lg text-xs font-black bg-green-200 text-green-900 border-2 border-black shadow-[2px_2px_0px_#000]">Terbit</span>
                                @else
                                    <span class="inline-block px-3 py-1 rounded-lg text-xs font-black bg-amber-200 text-amber-900 border-2 border-black shadow-[2px_2px_0px_#000]">Draft</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-center">{{ $article->is_featured ? '⭐' : '—' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700 font-medium whitespace-nowrap">{{ $article->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-sm text-center whitespace-nowrap">
                                <a href="{{ route('articles.edit',$article) }}" class="px-3 py-1.5 bg-sky-400 text-black border-2 border-black rounded-lg font-black text-xs shadow-[2px_2px_0px_#000] inline-block mr-2 hover:translate-y-[-1px]">Edit</a>
                                <form action="{{ route('articles.destroy',$article) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Hapus artikel ini?')" class="px-3 py-1.5 bg-red-400 text-black border-2 border-black rounded-lg font-black text-xs shadow-[2px_2px_0px_#000] cursor-pointer hover:translate-y-[-1px]">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-10 text-gray-500 font-bold text-sm">Belum ada artikel.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- 2. TAMPILAN MOBILE (CARD LIST) --}}
        <div id="articleMobileBody" class="block md:hidden divide-y-2 divide-gray-200">
            @forelse($articles as $article)
                <div class="article-card p-4 space-y-3 hover:bg-yellow-50/40 transition" data-title="{{ strtolower($article->title) }}" data-category="{{ $article->category?->name }}" data-status="{{ $article->status }}">
                    <div class="flex items-start justify-between gap-2">
                        <h3 class="font-extrabold text-sm text-gray-900 leading-snug">{{ $article->title }}</h3>
                        @if($article->status == 'published')
                            <span class="px-2.5 py-0.5 rounded-lg text-[10px] font-black bg-green-200 text-green-900 border-2 border-black shadow-[2px_2px_0px_#000] shrink-0">Terbit</span>
                        @else
                            <span class="px-2.5 py-0.5 rounded-lg text-[10px] font-black bg-amber-200 text-amber-900 border-2 border-black shadow-[2px_2px_0px_#000] shrink-0">Draft</span>
                        @endif
                    </div>

                    <div class="flex flex-wrap items-center gap-2 text-xs font-bold text-gray-600">
                        <span class="px-2 py-0.5 bg-blue-100 text-blue-800 border border-black rounded-md">{{ $article->category?->name }}</span>
                        <span>•</span>
                        <span>{{ $article->author->name }}</span>
                        @if($article->is_featured)
                            <span>•</span>
                            <span>⭐ Sorotan</span>
                        @endif
                    </div>

                    <div class="flex items-center justify-between pt-2 border-t border-gray-100">
                        <span class="text-xs font-semibold text-gray-500">{{ $article->created_at->format('d M Y') }}</span>
                        <div class="flex gap-2">
                            <a href="{{ route('articles.edit',$article) }}" class="px-3 py-1 bg-sky-400 text-black border-2 border-black rounded-lg font-black text-xs shadow-[2px_2px_0px_#000]">Edit</a>
                            <form action="{{ route('articles.destroy',$article) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Hapus artikel ini?')" class="px-3 py-1 bg-red-400 text-black border-2 border-black rounded-lg font-black text-xs shadow-[2px_2px_0px_#000] cursor-pointer">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-10 text-gray-500 font-bold text-sm">Belum ada artikel.</div>
            @endforelse
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        window.addEventListener("load", function() {
            const loadingContent = document.getElementById("loading-content");
            setTimeout(() => {
                loadingContent.classList.add("opacity-0");
                setTimeout(() => loadingContent.classList.add("hidden"), 300);
            }, 700);
        });

        const searchInput = document.getElementById("searchInput");
        const statusFilter = document.getElementById("statusFilter");
        const categoryFilter = document.getElementById("categoryFilter");

        function runFilter() {
            const query = (searchInput.value || "").toLowerCase().trim();
            const status = statusFilter.value;
            const category = categoryFilter.value.toLowerCase();

            const allItems = document.querySelectorAll(".article-row, .article-card");

            allItems.forEach((item) => {
                const d = item.dataset;
                const matchesQuery = query === "" || d.title.includes(query);
                const matchesStatus = status === "" || d.status === status;
                const matchesCategory = category === "" || (d.category && d.category.toLowerCase() === category);
                const isMatch = matchesQuery && matchesStatus && matchesCategory;
                item.classList.toggle("hidden", !isMatch);
            });
        }

        searchInput.addEventListener("input", runFilter);
    </script>
@endpush