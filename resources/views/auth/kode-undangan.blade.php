@extends('layouts.auth')

@section('title', 'Kode Undangan - Karya PPLG')

@section('content')
    <div class="login-container">
        {{-- Kiri: Form Kode Undangan --}}
        <div class="login-left">
            <div class="login-logo">
                <div class="login-logo-circle">K</div>
                <div class="login-logo-text">Karya PPLG</div>
            </div>

            <h1 class="login-title">Kode Undangan</h1>
            <p class="login-subtitle">Masukkan kode undangan untuk menyelesaikan pendaftaran dengan Google</p>

            @if ($errors->any())
                <div class="login-alert" style="background-color: #fee2e2; color: #b91c1c; padding: 10px; border-radius: 8px; margin-bottom: 15px; font-size: 14px;">
                    {{ $errors->first() }}
                </div>
            @endif

            <form class="login-form kode-form" action="{{ route('auth.kode-undangan.submit') }}" method="POST">
                @csrf

                <div class="login-form-group">
                    <label class="login-label" for="kode_unik">Kode Unik / Kode Undangan</label>
                    <input type="text" id="kode_unik" name="kode_unik"
                           placeholder="Contoh: XII-PPLG-2-2026"
                           value="{{ old('kode_unik') }}"
                           class="login-input @error('kode_unik') error @enderror"
                           required autofocus />
                    @error('kode_unik')
                        <p class="login-error-message" style="color: red; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="login-button kode-button">Lanjutkan Pendaftaran</button>
            </form>

            <p class="login-register-text">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="login-register-link">Kembali ke Login</a>
            </p>
        </div>

        {{-- Kanan: Info --}}
        <div class="login-right">
            <div>
                <h2 class="right-title">Satu Langkah Lagi!</h2>
                <p class="right-subtitle">Karena kamu login dengan Google, kami butuh kode undangan untuk menentukan kelas &amp; jurusan kamu.</p>
                <div class="right-features">
                    <div class="right-feature-item">
                        <div>
                            <div class="right-feature-title">Kode dari Guru / Admin</div>
                            <p>Mintalah kode undangan kepada guru atau Ketua Murid (KM) kelas kamu</p>
                        </div>
                    </div>
                    <div class="right-feature-item">
                        <div>
                            <div class="right-feature-title">Otomatis Masuk Kelas</div>
                            <p>Setelah valid, akun Google kamu langsung terdaftar sebagai siswa</p>
                        </div>
                    </div>
                    <div class="right-feature-item">
                        <div>
                            <div class="right-feature-title">Aman &amp; Cepat</div>
                            <p>Tidak perlu isi data lagi, langsung masuk dashboard</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@push('scripts')
    <script>
        document.querySelector(".kode-form").addEventListener("submit", function () {
            const b = document.querySelector(".kode-button");
            b.classList.add("opacity-75", "cursor-not-allowed", "loading");
            b.disabled = true;
            b.textContent = "Tunggu bentar yaa.....";
        });
    </script>
@endpush