@extends('layouts.auth')

@section('title', 'Daftar - Karya PPLG')

@section('content')
    <div class="main-wrapper p-4 lg:p-8 w-full">
      <div class="login-container dark:bg-gray-900 dark:border-gray-700">
        <div class="login-left dark:bg-gray-900">
          <div class="login-logo">
            <div class="login-logo-circle">K</div>
            <div class="login-logo-text dark:text-white">Karya PPLG</div>
          </div>
          <h1 class="login-title dark:text-white">Buat Akun Baru</h1>
          <p class="login-subtitle dark:text-gray-400">Daftar untuk mulai memamerkan karya Anda</p>

          {{-- ALERT ERROR VALIDASI --}}
          @if ($errors->any())
            <div class="mb-4 p-3 rounded-xl bg-red-100 border border-red-300 text-red-700 text-sm">
              <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form class="login-form" action="{{ route('register') }}" method="POST">
            @csrf
            <div class="login-form-group">
              <label class="login-label dark:text-gray-300" for="name">Nama</label>
              <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap Anda" class="login-input dark:bg-gray-800 dark:text-white dark:border-gray-700" required autofocus />
            </div>

            <div class="login-form-group">
              <label class="login-label dark:text-gray-300" for="email">Email</label>
              <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Masukan Email Anda" class="login-input dark:bg-gray-800 dark:text-white dark:border-gray-700" required />
            </div>

            <div class="login-form-group">
              <label class="login-label dark:text-gray-300" for="password">Password</label>
              <input type="password" id="password" name="password" placeholder="Masukkan password Anda" class="login-input dark:bg-gray-800 dark:text-white dark:border-gray-700" required />
            </div>

            <div class="login-form-group">
              <label class="login-label dark:text-gray-300" for="kode_unik">Kode Unik</label>
              <input type="text" id="kode_unik" name="kode_unik" value="{{ old('kode_unik') }}" placeholder="Masukan Kode unik" class="login-input dark:bg-gray-800 dark:text-white dark:border-gray-700" required />
            </div>

            <div class="login-checkbox dark:text-gray-300">
              <input type="checkbox" id="show-password" />
              <label for="show-password">Tampilkan Password</label>
            </div>

            <button type="submit" class="login-button">Daftar Sekarang</button>
          </form>

          <p class="login-register-text dark:text-gray-400">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="login-register-link">Login disini</a>
          </p>
        </div>

        <div class="login-right">
          <div>
            <h2 class="right-title">Museum Karya SMK Negeri 4 Tasikmalaya</h2>
            <p class="right-subtitle">kamu siswa smk 4 kamu punya karya? pamerkan disini</p>
            <div class="right-features">
              <div class="right-feature-item">
                <div>
                  <div class="right-feature-title">Portofolio Siswa</div>
                  <p>Tunjukkan karya terbaik Anda kepada dunia</p>
                </div>
              </div>
              <div class="right-feature-item">
                <div>
                  <div class="right-feature-title">Apresiasi Karya</div>
                  <p>Dapatkan feedback dan apresiasi dari komunitas</p>
                </div>
              </div>
              <div class="right-feature-item">
                <div>
                  <div class="right-feature-title">Pengembangan Karir</div>
                  <p>Terhubung dengan peluang kerja yang relevan</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection

@push('scripts')
    <script>
      const showPasswordCheckbox = document.getElementById('show-password');
      const passwordInput = document.getElementById('password');

      if (showPasswordCheckbox && passwordInput) {
        showPasswordCheckbox.addEventListener('change', function () {
          passwordInput.type = this.checked ? 'text' : 'password';
        });
      }
    </script>
@endpush