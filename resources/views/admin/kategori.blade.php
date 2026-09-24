@extends('layouts.admin')

@section('title', 'Manajemen Kategori')
@section('page_title', 'Manajemen Kategori Karya')

@section('content')

    <div id="loading-content" class="absolute inset-0 bg-[#fcfcfc]/90 z-40 flex flex-col items-center justify-center transition-opacity duration-300 ease-out">
        <div class="flex items-center gap-3 bg-white px-6 py-3 rounded-xl border-3 border-black shadow-[4px_4px_0px_#000]">
            <div class="w-5 h-5 border-3 border-black border-t-[#ffcc00] rounded-full animate-spin"></div>
            <p class="text-gray-900 font-extrabold text-sm tracking-wide">Memuat data kategori...</p>
        </div>
    </div>

    <div class="neubrutal-card overflow-hidden">
        <div class="px-4 sm:px-6 py-4 border-b-3 border-black bg-gray-50 flex justify-between items-center gap-2">
            <h2 class="text-base sm:text-xl font-black text-gray-900">Kategori Artikel</h2>
            <button type="button" onclick="openKategoriModal('tambah')" class="px-3.5 py-2 bg-[#ffcc00] text-black rounded-xl btn-neubrutal cursor-pointer text-xs sm:text-sm whitespace-nowrap">
                + Tambah Kategori
            </button>
        </div>

        <div class="divide-y-2 divide-gray-200">
            @forelse($categories as $category)
                <div class="p-4 sm:p-5 hover:bg-yellow-50/40 transition flex items-center justify-between gap-3">
                    <div class="flex items-center gap-3 min-w-0">
                        <span class="w-7 h-7 bg-gray-100 border-2 border-black rounded-lg flex items-center justify-center font-black text-xs shrink-0 shadow-[2px_2px_0px_#000]">
                            {{ $loop->iteration }}
                        </span>
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 border-2 border-black rounded-xl text-xs sm:text-sm font-black shadow-[2px_2px_0px_#000] truncate">
                            {{ $category->name }}
                        </span>
                    </div>
                    <div class="flex gap-2 shrink-0">
                        <button type="button" onclick="openKategoriModal('edit', this)" data-id="{{ $category->id }}" data-name="{{ $category->name }}" class="px-3.5 py-1.5 bg-sky-400 text-black border-2 border-black rounded-xl font-black text-xs shadow-[2px_2px_0px_#000] cursor-pointer hover:translate-y-[-1px]">
                            Edit
                        </button>
                        <form action="{{ url('/admin/kategori/'.$category->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Hapus kategori ini?')" class="px-3.5 py-1.5 bg-red-400 text-black border-2 border-black rounded-xl font-black text-xs shadow-[2px_2px_0px_#000] cursor-pointer hover:translate-y-[-1px]">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-10 text-gray-500 font-bold text-sm">Belum ada kategori artikel ditemukan.</div>
            @endforelse
        </div>
    </div>

    {{-- MODAL FORM KATEGORI DINAMIS --}}
    <div id="kategori-modal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-xs flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl border-3 border-black shadow-[6px_6px_0px_#000] max-w-md w-full overflow-hidden">
            <div class="bg-[#ffcc00] border-b-3 border-black p-5 text-black flex items-center justify-between">
                <h3 id="modal-title" class="text-lg font-black tracking-tight">Tambah Kategori Baru</h3>
                <button type="button" onclick="closeKategoriModal()" class="w-8 h-8 bg-white border-2 border-black rounded-lg font-black shadow-[2px_2px_0px_#000] cursor-pointer flex items-center justify-center">✕</button>
            </div>

            <form id="modal-form" method="POST" action="{{ url('/admin/kategori') }}" class="p-6">
                @csrf
                <div id="method-container"></div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-black text-gray-900 mb-1">Nama Kategori</label>
                        <input type="text" id="input-name" name="name" class="w-full px-3 py-2 rounded-xl input-neubrutal text-sm" placeholder="Contoh: Mobile App" required />
                    </div>
                </div>

                <div class="flex gap-3 mt-6 pt-4 border-t-2 border-gray-100">
                    <button type="button" onclick="closeKategoriModal()" class="flex-1 px-4 py-2.5 bg-gray-200 text-gray-800 rounded-xl btn-neubrutal cursor-pointer text-sm">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2.5 bg-[#ffcc00] text-black rounded-xl btn-neubrutal cursor-pointer text-sm">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        window.addEventListener("load", function () {
            const loadingContent = document.getElementById("loading-content");
            if (loadingContent) {
                setTimeout(() => {
                    loadingContent.classList.add("opacity-0");
                    setTimeout(() => loadingContent.classList.add("hidden"), 300);
                }, 800);
            }
        });

        const kategoriForm = document.getElementById("modal-form");
        const baseAction = "{{ url('/admin/kategori') }}";

        function openKategoriModal(mode, element = null) {
            const title = document.getElementById("modal-title");
            const input = document.getElementById("input-name");
            const methodContainer = document.getElementById("method-container");

            if (mode === "tambah") {
                title.innerHTML = "Tambah Kategori Baru";
                input.value = "";
                kategoriForm.action = baseAction;
                methodContainer.innerHTML = "";
            } else {
                title.innerHTML = "Edit Kategori";
                input.value = element.dataset.name;
                kategoriForm.action = baseAction + "/" + element.dataset.id;
                methodContainer.innerHTML = '<input type="hidden" name="_method" value="PUT">';
            }

            document.getElementById("kategori-modal").classList.remove("hidden");
        }

        function closeKategoriModal() {
            document.getElementById("kategori-modal").classList.add("hidden");
        }
    </script>
@endpush