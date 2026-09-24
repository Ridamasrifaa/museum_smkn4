@extends('layouts.admin')

@section('title', 'Tambah Artikel')
@section('page_title', 'Tambah Artikel Baru')

@section('header_action')
    <a href="{{ route('articles.index') }}" class="px-3.5 py-2 bg-gray-200 text-gray-800 rounded-xl btn-neubrutal text-xs sm:text-sm">
        ← Kembali
    </a>
@endsection

@section('content')

    <div id="loading-content" class="absolute inset-0 bg-[#fcfcfc]/90 z-40 flex flex-col items-center justify-center transition-opacity duration-300 ease-out">
        <div class="flex items-center gap-3 bg-white px-6 py-3 rounded-xl border-3 border-black shadow-[4px_4px_0px_#000]">
            <div class="w-5 h-5 border-3 border-black border-t-[#ffcc00] rounded-full animate-spin"></div>
            <p class="text-gray-900 font-extrabold text-sm tracking-wide">Memuat formulir artikel...</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="max-w-3xl mx-auto mb-5 bg-red-100 border-2 border-black rounded-xl p-4 shadow-[2px_2px_0px_#000]">
            <ul class="list-disc ml-5 text-red-700 text-sm font-bold">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="max-w-3xl mx-auto neubrutal-card p-5 sm:p-8">
        <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5 sm:space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-black text-gray-900 mb-2">Judul Artikel <span class="text-red-500">*</span></label>
                <input type="text" name="title" required value="{{ old('title') }}" class="w-full px-4 py-2.5 rounded-xl input-neubrutal text-sm text-gray-900" placeholder="Masukkan Judul Artikel...">
            </div>

            <div>
                <label class="block text-sm font-black text-gray-900 mb-2">Kategori Artikel <span class="text-red-500">*</span></label>
                <select name="category_id" required class="w-full px-4 py-2.5 rounded-xl input-neubrutal text-sm text-gray-900 bg-white">
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-black text-gray-900 mb-2">Ringkasan Singkat <span class="text-red-500">*</span></label>
                <textarea name="excerpt" rows="2" required class="w-full px-4 py-2.5 rounded-xl input-neubrutal text-sm text-gray-900" placeholder="Masukkan ringkasan singkat untuk artikel...">{{ old('excerpt') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-black text-gray-900 mb-2">Status Artikel <span class="text-red-500">*</span></label>
                <select name="status" required class="w-full px-4 py-2.5 rounded-xl input-neubrutal text-sm text-gray-900 bg-white">
                    <option value="">Pilih Status</option>
                    <option value="draft" @selected(old('status') == 'draft')>Draft</option>
                    <option value="published" @selected(old('status') == 'published')>Published (Terbit)</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-black text-gray-900 mb-2">Isi Artikel <span class="text-red-500">*</span></label>
                <textarea name="content" rows="8" required class="w-full px-4 py-2.5 rounded-xl input-neubrutal text-sm text-gray-900" placeholder="Masukkan Isi Artikelnya yang berunsur 5W + 1H....">{{ old('content') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-black text-gray-900 mb-2">Gambar Sampul (Cover) <span class="text-red-500">*</span></label>
                <input type="file" name="cover" accept="image/*" required onchange="previewCover(event)" class="w-full p-2 border-2 border-black rounded-xl text-xs sm:text-sm bg-gray-50 file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-2 file:border-black file:bg-[#ffcc00] file:font-black file:text-xs file:cursor-pointer">

                <div id="coverPreviewWrap" class="hidden mt-3 p-2 bg-gray-100 border-2 border-black rounded-xl">
                    <p class="text-xs font-black text-gray-700 mb-2">Preview Cover:</p>
                    <img id="coverPreview" class="w-full max-h-56 object-cover rounded-lg border-2 border-black shadow-[2px_2px_0px_#000]" />
                </div>
            </div>

            <div class="pt-1">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured')) class="w-4 h-4 rounded border-2 border-black focus:ring-0">
                    <span class="text-sm font-black text-gray-900">⭐ Jadikan artikel sorotan (tampil di hero)</span>
                </label>
            </div>

            <div class="flex gap-3 sm:gap-4 pt-4 border-t-3 border-black">
                <button type="button" onclick="resetForm()" class="flex-1 px-4 py-2.5 bg-gray-200 text-gray-800 rounded-xl btn-neubrutal cursor-pointer text-sm">
                    Reset
                </button>
                <button type="submit" class="flex-1 px-4 py-2.5 bg-[#ffcc00] text-black rounded-xl btn-neubrutal cursor-pointer text-sm">
                    Simpan Artikel
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        window.addEventListener("load", () => {
            const loadingContent = document.getElementById("loading-content");
            if (loadingContent) {
                setTimeout(() => {
                    loadingContent.classList.add("opacity-0");
                    setTimeout(() => loadingContent.classList.add("hidden"), 300);
                }, 700);
            }
        });

        function resetForm() {
            document.querySelector('form').reset();
            document.getElementById("coverPreviewWrap").classList.add("hidden");
        }

        function previewCover(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    document.getElementById("coverPreview").src = e.target.result;
                    document.getElementById("coverPreviewWrap").classList.remove("hidden");
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
@endpush