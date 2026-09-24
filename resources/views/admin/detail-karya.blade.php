@extends('layouts.admin')

@section('title', 'Detail Karya Admin')
@section('page_title', 'Detail Karya')

@section('content')

    <main class="flex-1 flex flex-col justify-center items-center -m-4 sm:-m-8 p-4 sm:p-6 md:p-8">
        <div class="w-full max-w-2xl md:max-w-3xl my-auto">

            {{-- TOMBOL KEMBALI --}}
            <div class="mb-4">
                <a href="{{ url('/admin/karya') }}" class="inline-flex items-center gap-2 text-xs sm:text-sm font-black bg-white px-3 py-1.5 rounded-lg border-2 border-black shadow-[2px_2px_0px_#000] hover:bg-amber-100 transition">
                    ← Kembali ke Data Karya
                </a>
            </div>

            {{-- CARD DETAIL --}}
            <div class="bg-white rounded-xl border-3 border-black shadow-[6px_6px_0px_#000] relative overflow-hidden">

                {{-- LOADING CONTENT --}}
                <div id="loading-content" class="absolute inset-0 bg-amber-200 z-40 flex flex-col items-center justify-center transition-opacity duration-300 ease-out">
                    <div class="flex items-center gap-3 bg-white px-6 py-3 rounded-xl border-3 border-black shadow-[3px_3px_0px_#000]">
                        <div class="w-5 h-5 border-4 border-black border-t-transparent animate-spin rounded-full"></div>
                        <p class="font-black text-xs sm:text-sm uppercase tracking-wider">Memuat detail karya...</p>
                    </div>
                </div>

                {{-- HEADER CARD --}}
                <div class="bg-cyan-400 text-black p-4 sm:p-6 border-b-2 border-black">
                    <h2 class="text-xl sm:text-2xl font-black uppercase">Detail Karya Siswa</h2>
                    <p class="text-xs sm:text-sm font-bold mt-1">Informasi lengkap project yang diupload siswa.</p>
                </div>

                {{-- BODY CARD --}}
                <div class="p-4 sm:p-6 space-y-6">
                    <div class="border-2 border-black rounded-lg overflow-x-auto">
                        <table class="w-full text-xs sm:text-sm text-left font-bold">
                            <tbody class="divide-y-2 divide-black">

                                <tr class="bg-gray-50">
                                    <td class="p-3 sm:p-4 border-r-2 border-black bg-amber-200 w-1/3 sm:w-1/4">Nama Siswa</td>
                                    <td class="p-3 sm:p-4">{{ $project->user->name }}</td>
                                </tr>

                                <tr>
                                    <td class="p-3 sm:p-4 border-r-2 border-black bg-amber-200">Judul Project</td>
                                    <td class="p-3 sm:p-4 font-black">{{ $project->title }}</td>
                                </tr>

                                <tr class="bg-gray-50">
                                    <td class="p-3 sm:p-4 border-r-2 border-black bg-amber-200">Jurusan</td>
                                    <td class="p-3 sm:p-4">
                                        <span class="px-3 py-1 bg-pink-400 text-black border-2 border-black rounded-md text-[11px] sm:text-xs font-black">
                                            {{ $project->jurusan }}
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="p-3 sm:p-4 border-r-2 border-black bg-amber-200">Deskripsi</td>
                                    <td class="p-3 sm:p-4 leading-relaxed">{{ $project->description }}</td>
                                </tr>

                                <tr class="bg-gray-50">
                                    <td class="p-3 sm:p-4 border-r-2 border-black bg-amber-200">Link Project</td>
                                    <td class="p-3 sm:p-4">
                                        @if($project->live_link)
                                            <a href="{{ $project->live_link }}" target="_blank" class="bg-blue-300 px-2 py-1 rounded border-2 border-black hover:bg-blue-400 font-bold underline inline-flex items-center gap-1 break-all">
                                                {{ $project->live_link }} ↗
                                            </a>
                                        @else
                                            <span class="text-gray-500">-</span>
                                        @endif
                                    </td>
                                </tr>

                                @if(strtoupper($project->jurusan) === 'PPLG')
                                <tr>
                                    <td class="p-3 sm:p-4 border-r-2 border-black bg-amber-200">Link GitHub</td>
                                    <td class="p-3 sm:p-4">
                                        @if($project->github_link)
                                            <a href="{{ $project->github_link }}" target="_blank" class="bg-blue-300 px-2 py-1 rounded border-2 border-black hover:bg-blue-400 font-bold underline inline-flex items-center gap-1 break-all">
                                                {{ $project->github_link }} ↗
                                            </a>
                                        @else
                                            <span class="text-gray-500">-</span>
                                        @endif
                                    </td>
                                </tr>
                                @endif

                                <tr class="bg-gray-50">
                                    <td class="p-3 sm:p-4 border-r-2 border-black bg-amber-200">Dokumentasi</td>
                                    <td class="p-3 sm:p-4">
                                        @if($project->file_path)
                                            <div class="relative inline-block">
                                                <img src="{{ asset('storage/' . $project->file_path) }}"
                                                     alt="Dokumentasi"
                                                     class="w-20 h-20 sm:w-28 sm:h-28 object-cover rounded-lg border-2 border-black shadow-[2px_2px_0px_#000] cursor-pointer hover:translate-x-1 hover:translate-y-1 transition"
                                                     onclick="openModal(this.src)">
                                            </div>

                                            {{-- MODAL PREVIEW GAMBAR --}}
                                            <div id="imageModal" class="fixed inset-0 z-50 hidden bg-black/80 flex items-center justify-center p-4" onclick="closeModal()">
                                                <div class="relative max-w-2xl max-h-[85vh] bg-amber-300 rounded-xl border-2 border-black p-3 shadow-[6px_6px_0px_#000]" onclick="event.stopPropagation()">
                                                    <button type="button" onclick="closeModal()" class="absolute -top-4 -right-4 bg-red-500 text-white rounded-full border-2 border-black w-8 h-8 flex items-center justify-center text-sm font-black cursor-pointer shadow-[2px_2px_0px_#000]">
                                                        ✕
                                                    </button>
                                                    <img id="modalImage" src="" alt="Preview" class="max-w-full max-h-[75vh] rounded-lg border-2 border-black bg-white object-contain">
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-gray-500">-</span>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td class="p-3 sm:p-4 border-r-2 border-black bg-amber-200">Status</td>
                                    <td class="p-3 sm:p-4">
                                        @if($project->status == 'pending')
                                            <span class="px-3 py-1 bg-orange-300 text-black border-2 border-black rounded-md text-[11px] sm:text-xs font-black">Menunggu Review</span>
                                        @elseif($project->status == 'approved')
                                            <span class="px-3 py-1 bg-lime-300 text-black border-2 border-black rounded-md text-[11px] sm:text-xs font-black">Disetujui</span>
                                        @else
                                            <span class="px-3 py-1 bg-red-300 text-black border-2 border-black rounded-md text-[11px] sm:text-xs font-black">Ditolak</span>
                                        @endif
                                    </td>
                                </tr>

                                <tr class="bg-gray-50">
                                    <td class="p-3 sm:p-4 border-r-2 border-black bg-amber-200">Upload</td>
                                    <td class="p-3 sm:p-4">{{ $project->created_at->format('d F Y H:i') }}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    {{-- FORM REVIEW (hanya jika masih pending) --}}
                    @if($project->status == 'pending')
                        <div class="border-t-2 border-black pt-5">
                            <h2 class="text-base sm:text-lg font-black uppercase mb-3">Review Project</h2>

                            <form action="{{ url('/admin/karya/'.$project->id.'/update-status') }}" method="POST" class="space-y-4">
                                @csrf
                                @method('PUT')

                                <div>
                                    <label class="block text-xs sm:text-sm font-black mb-2 uppercase">Catatan Admin</label>
                                    <textarea name="catatan" rows="3" class="w-full rounded-lg border-2 border-black p-3 text-xs sm:text-sm font-bold bg-gray-50 focus:bg-white focus:outline-none" placeholder="Tulis catatan persetujuan atau penolakan..."></textarea>
                                </div>

                                <div class="flex flex-wrap gap-3">
                                    <button type="submit" name="status" value="approved" class="flex-1 sm:flex-none bg-lime-400 hover:bg-lime-500 text-black px-5 py-2.5 rounded-xl font-black text-xs sm:text-sm border-2 border-black btn-neubrutal cursor-pointer">
                                        ✔ APPROVE
                                    </button>

                                    <button type="submit" name="status" value="rejected" class="flex-1 sm:flex-none bg-red-400 hover:bg-red-500 text-black px-5 py-2.5 rounded-xl font-black text-xs sm:text-sm border-2 border-black btn-neubrutal cursor-pointer">
                                        ✖ REJECT
                                    </button>
                                </div>
                            </form>
                        </div>
                    @else
                        {{-- HASIL REVIEW --}}
                        <div class="border-t-2 border-black pt-5">
                            <div class="bg-amber-50 border-2 border-black rounded-lg p-4 sm:p-5 shadow-[2px_2px_0px_#000]">
                                <h2 class="font-black text-gray-900 text-sm sm:text-base mb-1.5 uppercase">Hasil Review</h2>

                                @if($project->status == 'approved')
                                    <p class="text-green-800 text-xs sm:text-sm italic font-bold leading-relaxed">
                                        <strong>Catatan:</strong> "{{ $project->approval_note ?? 'Tidak ada catatan.' }}"
                                    </p>
                                @else
                                    <p class="text-red-800 text-xs sm:text-sm italic font-bold leading-relaxed">
                                        <strong>Alasan Penolakan:</strong> "{{ $project->rejection_reason }}"
                                    </p>
                                @endif

                                @if($project->reviewer)
                                    <div class="mt-3 pt-2 border-t-2 border-amber-300">
                                        <span class="inline-block text-[10px] sm:text-[11px] bg-white text-gray-700 px-2.5 py-0.5 rounded border-2 border-black font-bold">
                                            Direview oleh: <strong class="text-gray-900">{{ $project->reviewer->name }}</strong>
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        // Modal Preview Gambar
        function openModal(imageSrc) {
            const modal = document.getElementById("imageModal");
            const modalImg = document.getElementById("modalImage");
            modalImg.src = imageSrc;
            modal.classList.remove("hidden");
            document.body.style.overflow = "hidden";
        }
        function closeModal() {
            document.getElementById("imageModal").classList.add("hidden");
            document.body.style.overflow = "auto";
        }

        // Loading Screen
        window.addEventListener("load", function () {
            const loadingContent = document.getElementById("loading-content");
            if (loadingContent) {
                setTimeout(() => {
                    loadingContent.classList.add("opacity-0");
                    setTimeout(() => loadingContent.classList.add("hidden"), 300);
                }, 800);
            }
        });
    </script>
    <script src="{{ asset('assets/js/admin/detail.js') }}"></script>
@endpush