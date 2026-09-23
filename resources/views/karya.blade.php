@extends('layouts.app')

@section('title', 'Semua Karya - Museum Karya SMKN 4 Tasikmalaya')
@section('body_class', 'bg-[#fffdf9] dark:bg-zinc-950 text-zinc-900 dark:text-zinc-100 transition-colors duration-300 antialiased flex flex-col min-h-screen')

@push('styles')
    <style>
        /* Pola Kotak-kotak (Grid Pattern untuk Background) */
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
            background-size: 30px 30px;
        }

        .card-hover:hover {
            transform: translate(-3px, -3px);
            box-shadow: 8px 8px 0px 0px #18181b;
        }
        .dark .card-hover:hover {
            box-shadow: 8px 8px 0px 0px #f4f4f5;
        }

        .badge-custom {
            display: inline-block;
            padding: 0.2rem 0.6rem;
            background-color: #fde047;
            color: #18181b;
            font-size: 0.7rem;
            font-weight: 900;
            border-radius: 0.4rem;
            border: 2px solid #18181b;
            box-shadow: 2px 2px 0px 0px #18181b;
        }

        .iframe-container {
            position: relative;
            width: 100%;
            height: 180px;
            overflow: hidden;
            background: #f4f4f5;
        }

        .card-filtered-out { display: none !important; }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/css/karya.css') }}">
@endpush

@section('content')
    <!-- ===== HERO BANNER FULL WIDTH ===== -->
    <section class="w-full pt-8 pb-6 px-4 lg:px-8">
        <div class="mx-auto max-w-7xl border-2 border-zinc-900 dark:border-zinc-100 rounded-3xl bg-sky-400 dark:bg-sky-900 relative overflow-hidden shadow-[4px_4px_0px_0px_#18181b] dark:shadow-[4px_4px_0px_0px_#f4f4f5]">
            <img src="https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&w=1600&q=80" 
                 alt="Exhibition Banner" 
                 class="w-full h-44 sm:h-56 lg:h-64 object-cover opacity-20 absolute inset-0">

            <div class="relative z-10 px-6 py-8 sm:p-10 lg:p-12 flex flex-col md:flex-row items-center justify-between gap-6 text-zinc-900 dark:text-white">
                <div class="space-y-2 text-center md:text-left">
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black uppercase tracking-tight">SEMUA KARYA SHOWCASE</h1>
                    <p class="text-xs sm:text-sm font-bold text-sky-950 dark:text-sky-100 max-w-xl">
                        Jelajahi kumpulan project digital, aplikasi, web, dan sistem IoT terbaik hasil karya siswa-siswi SMKN 4 Tasikmalaya.
                    </p>
                </div>

                <div class="flex items-center gap-3 shrink-0">
                    <div class="bg-white dark:bg-zinc-900 border-2 border-zinc-900 dark:border-zinc-100 px-4 py-3 rounded-2xl shadow-[3px_3px_0px_0px_#18181b] text-center">
                        <span class="block text-xl font-black text-yellow-500 dark:text-yellow-300">{{ count($karyas) }}+</span>
                        <span class="text-[10px] uppercase font-bold tracking-wider">Total Karya</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== KARYA SECTION ===== -->
    <section id="karya" class="py-12 flex-grow bg-grid-pattern">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">

            <div class="mb-8">
                <h2 class="text-xl sm:text-2xl font-black uppercase tracking-tight text-zinc-900 dark:text-white">Pilih Template &amp; Karya Siswa</h2>
                <p class="text-xs sm:text-sm font-bold text-zinc-600 dark:text-zinc-400">Jelajahi karya inovatif para kreator — pilih, lihat detail, dan berikan apresiasi.</p>
            </div>

            <!-- Bar Filter & Pencarian Neo-Brutalist -->
            <div class="bg-white dark:bg-zinc-900 border-2 border-zinc-900 dark:border-zinc-100 rounded-2xl p-4 mb-6 shadow-[4px_4px_0px_0px_#18181b] dark:shadow-[4px_4px_0px_0px_#f4f4f5]">
                <div class="flex flex-col lg:flex-row items-center gap-4">
                    
                    <div class="flex flex-wrap gap-2 w-full lg:w-auto">
                        <button data-filter="all" class="filter-pill active px-4 py-2 bg-yellow-300 text-zinc-900 font-black text-xs rounded-xl border-2 border-zinc-900 shadow-[2px_2px_0px_#000] cursor-pointer transition">Semua</button>
                        <button data-filter="pplg" class="filter-pill px-4 py-2 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white font-black text-xs rounded-xl border-2 border-zinc-900 dark:border-zinc-100 shadow-[2px_2px_0px_#000] cursor-pointer transition">PPLG</button>
                        <button data-filter="dkv" class="filter-pill px-4 py-2 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white font-black text-xs rounded-xl border-2 border-zinc-900 dark:border-zinc-100 shadow-[2px_2px_0px_#000] cursor-pointer transition">DKV</button>
                        <button data-filter="toi" class="filter-pill px-4 py-2 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white font-black text-xs rounded-xl border-2 border-zinc-900 dark:border-zinc-100 shadow-[2px_2px_0px_#000] cursor-pointer transition">TOI</button>
                        <button data-filter="tkj" class="filter-pill px-4 py-2 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white font-black text-xs rounded-xl border-2 border-zinc-900 dark:border-zinc-100 shadow-[2px_2px_0px_#000] cursor-pointer transition">TKJ</button>
                        <button data-filter="tsm" class="filter-pill px-4 py-2 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white font-black text-xs rounded-xl border-2 border-zinc-900 dark:border-zinc-100 shadow-[2px_2px_0px_#000] cursor-pointer transition">TSM</button>
                    </div>

                    <div class="relative flex-grow w-full">
                        <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input id="searchInput" type="text" placeholder="Cari judul karya atau nama siswa..."
                            class="w-full pl-10 pr-4 py-2.5 rounded-xl border-2 border-zinc-900 dark:border-zinc-100 bg-zinc-50 dark:bg-zinc-800 text-zinc-900 dark:text-white placeholder-zinc-500 font-bold text-xs focus:outline-none shadow-[2px_2px_0px_#000_#18181b]" />
                    </div>

                </div>
            </div>

            <p id="resultCounter" class="text-xs font-bold text-zinc-600 dark:text-zinc-400 mb-6"></p>

            <!-- Grid Kartu Karya -->
            <div id="allKaryaGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($karyas as $karya)
                    <div class="karya-card bg-white dark:bg-zinc-900 rounded-3xl overflow-hidden border-3 border-zinc-900 dark:border-zinc-100 shadow-[6px_6px_0px_0px_#18181b] dark:shadow-[6px_6px_0px_0px_#f4f4f5] card-hover transition-all flex flex-col"
                        data-title="{{ $karya->title }}"
                        data-desc="{{ $karya->description }}"
                        data-category="{{ $karya->jurusan ?? '-' }}"
                        data-event="Museum Karya"
                        data-siswa="{{ $karya->user->name ?? '-' }}"
                        data-id="{{ $karya->user->id ?? '' }}"
                        data-guru="{{ $karya->guru_pengampu ?? '-' }}"
                        data-avatar="{{ $karya->user->avatar ?? '' }}"
                        data-avatar-letter="{{ strtoupper(substr($karya->user->name ?? '-', 0, 1)) }}"
                        data-kelas="{{ $karya->user->kelas ?? '-' }}"
                        data-jurusan-siswa="{{ $karya->user->jurusan ?? '-' }}"
                        data-angkatan="{{ $karya->user->angkatan ?? '-' }}"
                        data-tahun="{{ $karya->created_at ? $karya->created_at->format('Y') : '-' }}"
                        data-tech="{{ $karya->technology_stack ?? '-' }}"
                        data-live="{{ $karya->live_link ?? '' }}"
                        data-github="{{ $karya->github_link ?? '' }}"
                        data-file-path="{{ $karya->file_path ? asset('storage/' . $karya->file_path) : '' }}">
                        
                        <div class="iframe-container border-b-3 border-zinc-900 dark:border-zinc-100 cursor-pointer" onclick="openModal(this.closest('.karya-card'))">
                            @if ($karya->file_path)
                                <img src="{{ asset('storage/' . $karya->file_path) }}" alt="{{ $karya->title }}" class="w-full h-full object-cover" />
                            @elseif ($karya->live_link)
                                <iframe src="{{ $karya->live_link }}" loading="lazy" class="w-full h-full pointer-events-none border-0"></iframe>
                            @else
                                <div class="flex items-center justify-center h-full text-zinc-400 text-xs font-bold">Tidak ada Preview</div>
                            @endif
                        </div>

                        <div class="p-4 flex flex-col flex-grow">
                            <span class="badge-custom w-fit mb-2">{{ $karya->jurusan ?? 'Umum' }}</span>
                            <p class="text-[11px] text-zinc-500 font-bold mb-1">Oleh {{ $karya->user->name ?? 'Anonim' }}</p>
                            <h3 class="font-black text-zinc-900 dark:text-white mb-4 text-sm line-clamp-1">{{ $karya->title }}</h3>
                            <div class="mt-auto">
                                <button onclick="openModal(this.closest('.karya-card'))" class="w-full py-2 bg-yellow-300 hover:bg-yellow-400 text-zinc-900 font-black text-xs rounded-xl border-2 border-zinc-900 shadow-[2px_2px_0px_#000] transition-all cursor-pointer">Lihat Detail</button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20">
                        <h3 class="text-xl font-black text-zinc-900 dark:text-white mb-2">Belum ada karya.</h3>
                    </div>
                @endforelse
            </div>

            <div id="emptyState" class="hidden text-center py-20">
                <div class="text-5xl mb-4">📭</div>
                <h3 class="text-xl font-black text-zinc-900 dark:text-white mb-2">Tidak ada karya ditemukan</h3>
            </div>

            <!-- Pagination Container -->
            <div id="paginationContainer" class="mt-10 flex justify-center items-center gap-2"></div>
        </div>
    </section>

    <!-- ===== FOOTER ===== -->
    <footer class="bg-gray-900 dark:bg-black text-white text-center py-12 mt-16 border-t-4 border-black dark:border-white">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="pt-4">
                <p class="text-gray-300 font-bold text-sm">&copy; {{ date('Y') }} Museum Karya SMKN 4 Tasikmalaya</p>
                <p class="text-gray-400 text-xs mt-1">
                    Design &amp; Development By 
                    <a href="{{ route('dev') }}" class="text-blue-500 dark:text-blue-400 font-bold underline decoration-2 underline-offset-4 hover:text-blue-600 transition-colors">
                        Team Developer PPLG
                    </a>
                </p>
            </div>
        </div>
    </footer>

    <!-- ===== MODAL DETAIL STYLE NEO-BRUTALISM ===== -->
    <div id="detailModal" class="hidden fixed inset-0 bg-zinc-950/70 backdrop-blur-xs z-50 flex items-center justify-center p-4">
        <div class="bg-white dark:bg-zinc-900 rounded-3xl shadow-[8px_8px_0px_0px_#18181b] dark:shadow-[8px_8px_0px_0px_#f4f4f5] max-w-xl w-full p-6 border-3 border-zinc-900 dark:border-zinc-100 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center pb-4 border-b-2 border-zinc-200 dark:border-zinc-700">
                <h3 id="modalTitle" class="text-lg font-black text-zinc-900 dark:text-white"></h3>
                <button onclick="closeModal()" class="px-3 py-1 bg-yellow-300 text-zinc-900 rounded-xl border-2 border-zinc-900 font-black cursor-pointer shadow-[2px_2px_0px_#000]">✕</button>
            </div>
            
            <div class="py-4 space-y-4">
                <div id="modalMediaPreview" class="w-full h-56 rounded-2xl overflow-hidden border-2 border-zinc-900 dark:border-zinc-100 bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center"></div>

                <div class="flex gap-2 flex-wrap">
                    <span id="modalCategory" class="badge-custom"></span>
                </div>

                <div>
                    <h4 class="font-black text-xs uppercase text-zinc-500 dark:text-zinc-400 mb-1">Deskripsi</h4>
                    <p id="modalDescription" class="text-xs font-bold text-zinc-800 dark:text-zinc-200 leading-relaxed"></p>
                </div>

                <div class="bg-zinc-100 dark:bg-zinc-800 p-4 rounded-2xl border-2 border-zinc-900 dark:border-zinc-100 shadow-[3px_3px_0px_0px_#18181b]">
                    <div class="flex items-center gap-3">
                        <div id="modalAvatar" class="w-10 h-10 bg-yellow-300 text-zinc-900 border-2 border-zinc-900 rounded-xl flex items-center justify-center font-black text-sm shrink-0 shadow-[2px_2px_0px_#000]"></div>
                        <div>
                            <div id="modalSiswaContainer">
                                <p id="modalSiswa" class="font-black text-xs text-zinc-900 dark:text-white"></p>
                            </div>
                            <p id="modalBiodata" class="text-[10px] font-bold text-zinc-600 dark:text-zinc-400"></p>
                            <p id="modalGuru" class="text-[10px] font-bold text-zinc-500 dark:text-zinc-400"></p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-zinc-100 dark:bg-zinc-800 p-3 rounded-xl border-2 border-zinc-900 dark:border-zinc-100">
                        <p class="text-[10px] text-zinc-500 font-black uppercase">Tahun</p>
                        <p id="modalTahun" class="font-black text-xs text-zinc-900 dark:text-white"></p>
                    </div>
                    <div class="bg-zinc-100 dark:bg-zinc-800 p-3 rounded-xl border-2 border-zinc-900 dark:border-zinc-100">
                        <p class="text-[10px] text-zinc-500 font-black uppercase">Teknologi</p>
                        <p id="modalTech" class="font-black text-xs text-zinc-900 dark:text-white truncate"></p>
                    </div>
                </div>

                <div id="actionButtonsContainer" class="pt-2 flex flex-wrap gap-2"></div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>

    // Ikon GitHub (dipakai khusus untuk jurusan PPLG pada tombol kanan)
    const GITHUB_ICON_SVG = '<svg class="w-4 h-4 inline-block -mt-0.5 mr-1" fill="currentColor" viewBox="0 0 24 24"><path d="M12 .5C5.73.5.5 5.73.5 12.03c0 5.09 3.29 9.4 7.86 10.93.58.11.79-.25.79-.56 0-.28-.01-1.02-.02-2-3.2.7-3.88-1.54-3.88-1.54-.52-1.34-1.28-1.7-1.28-1.7-1.04-.72.08-.7.08-.7 1.15.08 1.76 1.19 1.76 1.19 1.03 1.76 2.7 1.25 3.36.96.1-.75.4-1.25.73-1.54-2.55-.29-5.23-1.28-5.23-5.68 0-1.25.44-2.28 1.18-3.08-.12-.29-.51-1.46.11-3.04 0 0 .97-.31 3.18 1.18a10.9 10.9 0 015.79 0c2.2-1.49 3.17-1.18 3.17-1.18.63 1.58.24 2.75.12 3.04.74.8 1.18 1.83 1.18 3.08 0 4.41-2.69 5.38-5.25 5.67.41.36.78 1.06.78 2.14 0 1.55-.01 2.79-.01 3.17 0 .31.21.68.8.56A10.53 10.53 0 0023.5 12.03C23.5 5.73 18.27.5 12 .5z"/></svg>';

    // ===== Modal Handling =====
    function openModal(card) {
        if (!card) return;
        const d = card.dataset;

        if (document.getElementById("modalTitle")) document.getElementById("modalTitle").textContent = d.title || "";
        if (document.getElementById("modalCategory")) document.getElementById("modalCategory").textContent = d.category || "";
        if (document.getElementById("modalDescription")) document.getElementById("modalDescription").textContent = d.desc || "";
        if (document.getElementById("modalTahun")) document.getElementById("modalTahun").textContent = d.tahun || "";
        if (document.getElementById("modalTech")) document.getElementById("modalTech").textContent = d.tech || "";

        // Tombol Aksi: kiri = link project (live), kanan = link github
        const actionContainer = document.getElementById("actionButtonsContainer");
        if (actionContainer) {
            actionContainer.innerHTML = "";
            let hasButton = false;

            if (d.live) {
                hasButton = true;
                actionContainer.innerHTML += `<a href="${d.live}" target="_blank" class="flex-1 py-2.5 bg-yellow-300 text-zinc-900 font-black text-xs rounded-xl border-2 border-zinc-900 shadow-[2px_2px_0px_#000] text-center transition">Live Demo</a>`;
            }
            if (d.github) {
                hasButton = true;
                const isPplg = (d.category || "").trim().toUpperCase() === "PPLG";
                const label = isPplg ? "GitHub" : "Link Lainnya";
                const icon = isPplg ? GITHUB_ICON_SVG : "";
                actionContainer.innerHTML += `<a href="${d.github}" target="_blank" class="flex-1 py-2.5 bg-zinc-900 dark:bg-zinc-100 text-white dark:text-zinc-900 font-black text-xs rounded-xl border-2 border-zinc-900 dark:border-zinc-100 shadow-[2px_2px_0px_#000] text-center transition inline-flex items-center justify-center">${icon}${label}</a>`;
            }
            actionContainer.classList.toggle("hidden", !hasButton);
        }

        // Preview Media Modal
        const mediaPreview = document.getElementById("modalMediaPreview");
        if (mediaPreview) {
            if (d.filePath) {
                mediaPreview.innerHTML = `<img src="${d.filePath}" alt="${d.title}" class="w-full h-full object-cover" />`;
            } else if (d.live) {
                mediaPreview.innerHTML = `<iframe src="${d.live}" class="w-full h-full border-0" loading="lazy"></iframe>`;
            } else {
                mediaPreview.innerHTML = `<span class="text-xs font-bold text-zinc-400">Tidak ada preview media</span>`;
            }
        }

        // Avatar & Siswa
        const modalAvatar = document.getElementById("modalAvatar");
        if (modalAvatar) {
            modalAvatar.textContent = d.avatarLetter || (d.siswa ? d.siswa.charAt(0).toUpperCase() : "U");
        }

        const siswaContainer = document.getElementById("modalSiswaContainer");
        if (siswaContainer) {
            if (d.id) {
                siswaContainer.innerHTML = `<a href="/u/${d.id}" class="font-black text-xs text-sky-600 dark:text-sky-400 hover:underline">${d.siswa || "-"}</a>`;
            } else {
                siswaContainer.innerHTML = `<p class="font-black text-xs text-zinc-900 dark:text-white">${d.siswa || "-"}</p>`;
            }
        }

        const modalBiodata = document.getElementById("modalBiodata");
        if (modalBiodata) {
            const parts = [];
            if (d.kelas && d.kelas !== "-") parts.push(d.kelas);
            if (d.jurusanSiswa && d.jurusanSiswa !== "-") parts.push(d.jurusanSiswa);
            if (d.angkatan && d.angkatan !== "-") parts.push("Angkatan " + d.angkatan);
            modalBiodata.textContent = parts.length ? parts.join(" • ") : "-";
        }

        if (document.getElementById("modalGuru")) {
            document.getElementById("modalGuru").textContent = d.guru && d.guru !== "-" ? "Guru: " + d.guru : "";
        }

        const modal = document.getElementById("detailModal");
        if (modal) modal.classList.remove("hidden");
    }

    function closeModal() {
        const modal = document.getElementById("detailModal");
        if (modal) {
            modal.classList.add("hidden");
            const mediaPreview = document.getElementById("modalMediaPreview");
            if (mediaPreview) mediaPreview.innerHTML = "";
        }
    }

    document.getElementById("detailModal")?.addEventListener("click", (e) => {
        if (e.target.id === "detailModal") closeModal();
    });

    // ===== Search, Filter & Pagination Logic =====
    const searchInput = document.getElementById("searchInput");
    const filterPills = document.querySelectorAll(".filter-pill");
    const allCards = Array.from(document.querySelectorAll(".karya-card"));
    const resultCounter = document.getElementById("resultCounter");
    const emptyState = document.getElementById("emptyState");
    const paginationContainer = document.getElementById("paginationContainer");

    let activeCategory = "all";
    let currentPage = 1;
    const itemsPerPage = 12;
    let filteredCards = [];

    function normalize(text) {
        return (text || "").toLowerCase();
    }

    function runFilter() {
        const query = normalize(searchInput?.value.trim() || "");

        filteredCards = allCards.filter((card) => {
            const d = card.dataset;
            const haystack = normalize(`${d.title} ${d.siswa} ${d.tech} ${d.category} ${d.desc}`);
            const matchesQuery = query === "" || haystack.includes(query);
            const matchesCategory = activeCategory === "all" || normalize(d.category) === normalize(activeCategory);
            return matchesQuery && matchesCategory;
        });

        currentPage = 1;
        renderPage();
    }

    function renderPage() {
        const totalItems = filteredCards.length;
        const totalPages = Math.ceil(totalItems / itemsPerPage) || 1;

        if (currentPage > totalPages) currentPage = totalPages;

        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;

        allCards.forEach(card => card.classList.add("card-filtered-out"));

        const currentSlice = filteredCards.slice(startIndex, endIndex);
        currentSlice.forEach(card => card.classList.remove("card-filtered-out"));

        if (resultCounter) {
            resultCounter.textContent = totalItems === allCards.length
                ? `Menampilkan semua ${allCards.length} karya`
                : `Menampilkan ${currentSlice.length} dari ${totalItems} karya`;
        }

        if (emptyState) {
            emptyState.classList.toggle("hidden", totalItems > 0);
        }

        renderPagination(totalPages);
    }

    function renderPagination(totalPages) {
        if (!paginationContainer) return;
        paginationContainer.innerHTML = "";

        if (totalPages <= 1) return;

        for (let i = 1; i <= totalPages; i++) {
            const pageBtn = document.createElement("button");
            pageBtn.textContent = i;
            const isActive = i === currentPage;
            pageBtn.className = `px-3.5 py-1.5 rounded-xl text-xs font-black border-2 border-zinc-900 transition ${isActive ? 'bg-yellow-300 shadow-[2px_2px_0px_#000]' : 'bg-white dark:bg-zinc-800'}`;
            pageBtn.onclick = () => { currentPage = i; renderPage(); window.scrollTo({top: 400, behavior: 'smooth'}); };
            paginationContainer.appendChild(pageBtn);
        }
    }

    if (searchInput) searchInput.addEventListener("input", runFilter);

    filterPills.forEach((pill) => {
        pill.addEventListener("click", () => {
            filterPills.forEach((p) => {
                p.classList.remove("active", "bg-yellow-300", "shadow-[2px_2px_0px_#000]");
                p.classList.add("bg-white", "dark:bg-zinc-800");
            });
            pill.classList.add("active", "bg-yellow-300", "shadow-[2px_2px_0px_#000]");
            pill.classList.remove("bg-white", "dark:bg-zinc-800");
            activeCategory = pill.dataset.filter;
            runFilter();
        });
    });

    runFilter();
</script>
@endpush