@extends('layouts.auth')

@section('title', 'Daftar - Karya PPLG')

@section('content')
    <div class="login-container">
        <!-- Kiri: Form Register -->
        <div class="login-left">
            <div class="login-logo">
                <div class="login-logo-circle">K</div>
                <div class="login-logo-text">Karya PPLG</div>
            </div>
            <h1 class="login-title">Buat Akun Baru</h1>
            <p class="login-subtitle">Daftar untuk mulai memamerkan karya Anda</p>

            @if ($errors->any())
                <div class="login-alert" style="background-color: #fee2e2; color: #b91c1c; padding: 10px; border-radius: 8px; margin-bottom: 15px; font-size: 14px;">
                    {{ $errors->first() }}
                </div>
            @endif

            <form class="login-form" action="{{ route('register') }}" method="POST">
                @csrf

                <div class="login-form-group">
                    <label class="login-label" for="name">Nama</label>
                    <input type="text" id="name" name="name" placeholder="Masukkan nama lengkap Anda" value="{{ old('name') }}" class="login-input @error('name') error @enderror" required autofocus autocomplete="name" />
                    @error('name')
                        <p class="login-error-message" style="color: red; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div class="login-form-group">
                    <label class="login-label" for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Masukan Email Anda" value="{{ old('email') }}" class="login-input @error('email') error @enderror" required autocomplete="email" />
                    @error('email')
                        <p class="login-error-message" style="color: red; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div class="login-form-group">
                    <label class="login-label" for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan password Anda" class="login-input @error('password') error @enderror" required autocomplete="new-password" />
                    @error('password')
                        <p class="login-error-message" style="color: red; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div class="login-form-group">
                    <label class="login-label" for="kode_unik">Kode Unik</label>
                    <input type="text" id="kode_unik" name="kode_unik" placeholder="Masukan Kode unik" value="{{ old('kode_unik') }}" class="login-input @error('kode_unik') error @enderror" required />
                    @error('kode_unik')
                        <p class="login-error-message" style="color: red; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div class="login-checkbox">
                    <input type="checkbox" id="show-password" />
                    <label for="show-password">Tampilkan Password</label>
                </div>

                <button type="submit" class="login-button">Daftar Sekarang</button>
            </form>

            <p class="login-register-text">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="login-register-link">Login disini</a>
            </p>
        </div>

        <!-- Kanan: Info & Fitur -->
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
@endsection

@push('scripts')
    <script>
        document.getElementById("show-password").addEventListener("change", function () {
            document.getElementById("password").type = this.checked ? "text" : "password";
        });

        document.querySelector(".login-form").addEventListener("submit", function () {
            const b = this.querySelector(".login-button");
            b.classList.add("loading");
            b.disabled = true;
            b.textContent = "Tunggu bentar....";
        });
    </script>
@endpush