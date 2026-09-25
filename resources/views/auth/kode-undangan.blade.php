@extends('layouts.auth')

@section('title', 'Kode Unik - Karya PPLG')

@section('content')
    <div class="max-w-4xl w-full bg-white dark:bg-gray-900 rounded-3xl shadow-xl overflow-hidden border border-gray-100 dark:border-gray-800 grid grid-cols-1 md:grid-cols-2 transition-all my-8">
      
      <!-- Kiri: Form -->
      <div class="p-8 lg:p-12 flex flex-col justify-between bg-white dark:bg-gray-900">
        <div>
          <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 bg-blue-600 text-white font-bold rounded-xl flex items-center justify-center text-lg shadow-md">
              K
            </div>
            <div class="font-bold text-lg text-gray-800 dark:text-white">Karya PPLG</div>
          </div>

          <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Kode Undangan</h1>
          <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">
            Masukkan kode undangan untuk menyelesaikan pendaftaran dengan Google
          </p>

          {{-- ALERT ERROR VALIDASI (kode_unik salah/penuh/nonaktif) --}}
          @if ($errors->any())
            <div class="mb-4 p-3 rounded-xl bg-red-100 dark:bg-red-900/40 border border-red-300 dark:border-red-700 text-red-700 dark:text-red-300 text-sm">
              <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form action="{{ route('auth.kode-undangan.submit') }}" method="POST" class="login-form space-y-4">
            @csrf
            <div>
              <label for="kode_unik" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                Kode Unik / Kode Undangan
              </label>
              <input 
                type="text" 
                id="kode_unik" 
                name="kode_unik" 
                value="{{ old('kode_unik') }}"
                placeholder="Masukan Kode Undangan" 
                class="login-input w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition text-sm font-medium" 
                required 
                autofocus 
              />
            </div>

            <button 
              type="submit" 
              class="login-button w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl shadow-md transition-all duration-200 cursor-pointer text-sm">
              Lanjutkan Pendaftaran
            </button>
          </form>
        </div>

        <p class="text-xs text-center text-gray-500 dark:text-gray-400 mt-8">
          Sudah punya akun?
          <a href="{{ route('login') }}" class="text-blue-600 dark:text-blue-400 font-semibold hover:underline">Kembali ke Login</a>
        </p>
      </div>

      <!-- Kanan: Info -->
      <div class="bg-gradient-to-br from-blue-600 to-indigo-800 p-8 lg:p-12 text-white flex flex-col justify-center">
        <div>
          <h2 class="text-2xl font-bold mb-3">Satu Langkah Lagi!</h2>
          <p class="text-blue-100 text-sm mb-8 leading-relaxed">
            Karena kamu login dengan Google, kami butuh kode undangan untuk menentukan kelas & jurusan kamu.
          </p>

          <div class="space-y-6">
            <div class="flex items-start gap-4">
              <div class="p-2 bg-white/10 rounded-xl shrink-0">
                <svg class="w-5 h-5 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 0121 9z"/>
                </svg>
              </div>
              <div>
                <div class="font-semibold text-sm text-white">Kode dari Guru / Admin</div>
                <p class="text-xs text-blue-100 mt-0.5">Mintalah kode undangan kepada guru atau Ketua Murid (km) kelas kamu</p>
              </div>
            </div>

            <div class="flex items-start gap-4">
              <div class="p-2 bg-white/10 rounded-xl shrink-0">
                <svg class="w-5 h-5 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
              </div>
              <div>
                <div class="font-semibold text-sm text-white">Otomatis Masuk Kelas</div>
                <p class="text-xs text-blue-100 mt-0.5">Setelah valid, akun Google kamu langsung terdaftar sebagai siswa</p>
              </div>
            </div>

            <div class="flex items-start gap-4">
              <div class="p-2 bg-white/10 rounded-xl shrink-0">
                <svg class="w-5 h-5 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
              </div>
              <div>
                <div class="font-semibold text-sm text-white">Aman & Cepat</div>
                <p class="text-xs text-blue-100 mt-0.5">Tidak perlu isi data lagi, langsung masuk dashboard</p>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
@endsection

@push('scripts')
    <script>
      const formEl = document.querySelector(".login-form");
      if (formEl) {
        formEl.addEventListener("submit", function () {
          const b = this.querySelector(".login-button");
          if(b) {
            b.classList.add("loading");
            b.disabled = true;
            b.textContent = "Tunggu Bentar yaa.....";
          }
        });
      }
    </script>
@endpush