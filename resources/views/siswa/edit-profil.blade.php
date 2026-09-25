@extends('layouts.siswa')

@section('title', 'Edit Profil')
@section('page_title', 'Edit Profil')

@section('content')
    @php
        $avatar = Auth::user()->avatar;
        $avatarUrl = !empty($avatar)
            ? (str_starts_with($avatar, 'http')
                ? $avatar
                : (str_starts_with($avatar, '/storage') ? asset($avatar) : asset('storage/' . $avatar)))
            : null;

        // Class input neo-brutalist (dipakai berulang)
        $input = 'w-full rounded-xl neo-input px-4 py-2.5 text-sm font-bold text-slate-900 bg-[#FFFDF9]';
    @endphp

    <div class="flex-1 p-4 sm:p-6 md:p-10">
        <div class="max-w-3xl mx-auto">

            <div class="flex flex-wrap items-center justify-between gap-3 mb-4 sm:mb-6">
                <h2 class="text-lg sm:text-xl font-black text-slate-900">Form Perubahan Profil</h2>
                <a href="{{ url('/siswa/profil') }}"
                    class="inline-flex items-center gap-1 px-4 py-2 bg-white text-slate-800 text-xs font-black rounded-xl neo-border neo-shadow-sm neo-btn">
                    ← Kembali ke Profil
                </a>
            </div>

            {{-- Notifikasi sukses --}}
            @if (session('success'))
                <div class="mb-6 rounded-xl bg-[#BBF7D0] text-emerald-950 neo-border neo-shadow-sm text-sm font-extrabold px-4 py-3">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Notifikasi error validasi umum --}}
            @if ($errors->any())
                <div class="mb-6 rounded-xl bg-[#FDA4AF] text-rose-950 neo-border neo-shadow-sm text-sm font-extrabold px-4 py-3">
                    Terdapat kesalahan pada input. Mohon periksa kembali form di bawah.
                </div>
            @endif

            {{-- Card Form --}}
            <form action="{{ url('/siswa/profil') }}" method="POST" enctype="multipart/form-data"
                class="bg-white rounded-2xl neo-border neo-shadow-lg p-4 sm:p-6 md:p-10">
                @csrf
                @method('PUT')

                {{-- ============ FOTO PROFIL ============ --}}
                <div class="flex flex-col items-center text-center mb-8">
                    <div class="relative">
                        <div class="p-1 bg-[#818CF8] rounded-full neo-border neo-shadow-sm">
                            <div class="w-28 h-28 md:w-32 md:h-32 rounded-full overflow-hidden relative border-2 border-slate-900 bg-[#C7D2FE] flex items-center justify-center">
                                @if ($avatarUrl)
                                    <img id="avatar-preview" src="{{ $avatarUrl }}" alt="Foto Profil"
                                        class="w-full h-full object-cover absolute inset-0">
                                @else
                                    <div id="avatar-initial-preview" class="w-full h-full flex items-center justify-center text-slate-900 text-4xl font-black">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                    <img id="avatar-preview" src="" alt="Foto Profil"
                                        class="w-full h-full object-cover absolute inset-0 hidden">
                                @endif
                            </div>
                        </div>

                        <label for="avatar"
                            class="absolute bottom-1 right-1 bg-[#FEF3C7] hover:bg-[#FDE68A] text-slate-900 p-2.5 rounded-full cursor-pointer neo-border neo-shadow-sm neo-btn z-10">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 112.828 2.828L11.828 15.828H9V13z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 19h14" />
                            </svg>
                        </label>
                        <input type="file" name="avatar" id="avatar" accept="image/*" class="hidden"
                            onchange="previewAvatar(event)">
                    </div>
                    <p class="mt-3 text-xs font-extrabold text-slate-500">JPG atau PNG, maksimal 2MB</p>
                    @error('avatar')
                        <p class="mt-1 text-xs font-extrabold text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="border-b-[3px] border-slate-900 mb-8"></div>

                {{-- ============ DATA DIRI ============ --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div class="md:col-span-2">
                        <label for="name" class="block text-sm font-black text-slate-900 mb-1.5">Nama Lengkap</label>
                        <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}"
                            class="{{ $input }}">
                        @error('name')
                            <p class="mt-1 text-xs font-extrabold text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- FIX: field ini sebelumnya name="jurusan" (salah target kolom), sekarang benar ke kolom "kelas" --}}
                    <div class="md:col-span-2">
                        <label for="kelas" class="block text-sm font-black text-slate-900 mb-1.5">Kelas</label>
                        <input type="text" name="kelas" id="kelas" value="{{ old('kelas', $user->kelas ?? '') }}"
                            placeholder="Contoh: XII PPLG 1"
                            class="{{ $input }}">
                        @error('kelas')
                            <p class="mt-1 text-xs font-extrabold text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                            <label for="instagram" class="block text-sm font-black text-slate-900 mb-1.5">Akun Instagram</label>
                            <input type="text" name="instagram" id="instagram"
                                value="{{ old('instagram', $user->instagram ?? '') }}"
                                placeholder="Contoh: @namakun atau https://instagram.com/namakun"
                                class="{{ $input }}">
                            <p class="mt-1.5 text-xs font-bold text-slate-500">Masukkan username atau link profil Instagram kamu agar pengunjung bisa melihat sosial mediamu.</p>
                            @error('instagram')
                                <p class="mt-1 text-xs font-extrabold text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label for="bio" class="block text-sm font-black text-slate-900 mb-1.5">Bio / Deskripsi Singkat</label>
                        <textarea name="bio" id="bio" rows="3" placeholder="Ceritakan sedikit tentang dirimu..."
                            class="{{ $input }}">{{ old('bio', $user->bio ?? '') }}</textarea>
                        @error('bio')
                            <p class="mt-1 text-xs font-extrabold text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <div class="border-b-[3px] border-slate-900 my-8"></div>

                {{-- ============ GANTI PASSWORD ============ --}}
                <div>
                    <h3 class="font-black text-base text-slate-900 mb-1">Ganti Password</h3>
                    <p class="text-xs font-bold text-slate-500 mb-4">Kosongkan bagian ini jika tidak ingin mengganti password.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="password" class="block text-sm font-black text-slate-900 mb-1.5">Password Baru</label>
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                class="{{ $input }}">
                            @error('password')
                                <p class="mt-1 text-xs font-extrabold text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-sm font-black text-slate-900 mb-1.5">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••"
                                class="{{ $input }}">
                        </div>
                    </div>
                </div>

                {{-- ============ TOMBOL AKSI ============ --}}
                <div class="flex flex-col-reverse sm:flex-row sm:items-center sm:justify-end gap-3 mt-8 sm:mt-10 pt-6 border-t-[3px] border-slate-900">
                    <a href="{{ url('/siswa/profil') }}"
                        class="px-5 py-2.5 rounded-xl text-center text-xs font-black text-slate-800 bg-[#F1F5F9] hover:bg-[#E2E8F0] neo-border neo-btn">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-5 py-2.5 rounded-xl text-xs font-black bg-[#818CF8] hover:bg-[#6366F1] text-white neo-border neo-shadow-sm neo-btn cursor-pointer">
                        Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function previewAvatar(event) {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function (e) {
                const previewImg = document.getElementById('avatar-preview');
                const initialDiv = document.getElementById('avatar-initial-preview');

                previewImg.src = e.target.result;
                previewImg.classList.remove('hidden');
                if (initialDiv) initialDiv.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }
    </script>
@endpush