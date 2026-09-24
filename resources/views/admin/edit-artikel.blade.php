@extends('layouts.admin')

@section('title', 'Edit Artikel')
@section('page_title', 'Edit Artikel')

@section('header_action')
    <a href="{{ route('articles.index') }}" class="px-3.5 py-2 bg-gray-200 text-gray-800 rounded-xl btn-neubrutal text-xs sm:text-sm">
        ← Kembali
    </a>
@endsection

@section('content')

    <div id="loading-content" class="absolute inset-0 bg-[#fcfcfc]/90 z-40 flex flex-col items-center justify-center transition-opacity duration-300 ease-out">
        <div class="flex items-center gap-3 bg-white px-6 py-3 rounded-xl border-3 border-black shadow-[4px_4px_0px_#000]">
            <div class="w-5 h-5 border-3 border-black border-t-[#ffcc00] rounded-full animate-spin"></div>
            <p class="text-gray-900 font-extrabold text-sm tracking-wide">Memuat data artikel...</p>
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
        <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5 sm:space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-black text-gray-900 mb-2">Judul Artikel <span class="text-red-500">*</span></label>
                <input type="text" name="title" required value="{{ old('title', $article->title) }}" class="w-full px-4 py-2.5 rounded-xl input-neubrutal text-sm text-gray-900" />
            </div>

            <div>
                <label class="block text-sm font-black text-gray-900 mb-2">Kategori Artikel <span class="text-red-500">*</span></label>
                <select name="category_id" class="w-full px-4 py-2.5 rounded-xl input-neubrutal text-sm text-gray-900 bg-white" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $article->category_id) == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-black text-gray-900 mb-2">Ringkasan Singkat <span class="text-red-500">*</span></label>
                <textarea name="excerpt" rows="2" required class="w-full px-4 py-2.5 rounded-xl input-neubrutal text-sm text-gray-900">{{ old('excerpt', $article->excerpt) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-black text-gray-900 mb-2">Isi Artikel <span class="text-red-500">*</span></label>
                <textarea name="content" rows="10" required class="w-full px-4 py-2.5 rounded-xl input-neubrutal text-sm text-gray-900">{{ old('content', $article->content) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-black text-gray-900 mb-2">Gambar Sampul (Cover)</label>
                <div id="coverPreviewWrap" class="hidden md:block mb-3 p-2 bg-gray-100 border-2 border-black rounded-xl">
                    @if($article->cover)
                        <img id="coverPreview" src="{{ asset('storage/'.$article->cover) }}" class="w-full h-48 object-cover rounded-lg border-2 border-black shadow-[2px_2px_0px_#000]" />
                    @else
                        <img id="coverPreview" class="hidden w-full h-48 object-cover rounded-lg border-2 border-black" />
                    @endif
                </div>
                <input type="file" name="cover" accept="image/*" onchange="previewCover(event)" class="w-full p-2 border-2 border-black rounded-xl text-xs sm:text-sm bg-gray-50 file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-2 file:border-black file:bg-[#ffcc00] file:font-black file:text-xs file:cursor-pointer" />
                <p class="text-xs text-gray-500 font-bold mt-1">Kosongkan jika tidak ingin mengganti gambar sampul yang lama.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-black text-gray-900 mb-2">Status <span class="text-red-500">*</span></label>
                    <select name="status" required class="w-full px-4 py-2.5 rounded-xl input-neubrutal text-sm text-gray-900 bg-white">
                        <option value="draft" @selected(old('status', $article->status) == 'draft')>Draft</option>
                        <option value="published" @selected(old('status', $article->status) == 'published')>Published</option>
                    </select>
                </div>

                <div class="flex items-center gap-3 pt-8">
                    <input type="checkbox" id="isFeatured" name="is_featured" value="1" @checked(old('is_featured', $article->is_featured)) class="w-4 h-4 rounded border-2 border-black focus:ring-0 cursor-pointer" />
                    <label for="isFeatured" class="text-sm font-black text-gray-900 cursor-pointer select-none">
                        ⭐ Jadikan artikel sorotan (tampil di hero)
                    </label>
                </div>
            </div>

            <div class="flex items-center justify-between text-xs text-gray-500 font-bold pt-2 border-t-2 border-gray-100">
                <span>Dibuat oleh: {{ $article->author->name }}</span>
                <span>Terakhir diperbarui: {{ $article->updated_at->format('d M Y') }}</span>
            </div>

            <div class="flex gap-3 sm:gap-4 pt-4 border-t-3 border-black">
                <a href="{{ route('articles.index') }}" class="flex-1 text-center px-6 py-2.5 bg-gray-200 text-gray-800 rounded-xl btn-neubrutal text-sm">Batal</a>
                <button type="submit" class="flex-1 px-6 py-2.5 bg-[#ffcc00] text-black rounded-xl btn-neubrutal cursor-pointer text-sm">Simpan Perubahan</button>
            </div>
        </form>
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

        function previewCover(event) {
            const file = event.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById("coverPreviewWrap").classList.remove("hidden");
                document.getElementById("coverPreviewWrap").innerHTML =
                    `<img id="coverPreview" src="${e.target.result}" class="w-full h-48 object-cover rounded-lg border-2 border-black shadow-[2px_2px_0px_#000]" />`;
            };
            reader.readAsDataURL(file);
        }
    </script>
@endpush