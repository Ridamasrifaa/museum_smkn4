<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <title>@yield('title', 'Karya PPLG')</title>

    @verbatim
    <style type="text/tailwindcss">
        @custom-variant dark (&:where(.dark, .dark *));
    </style>
    @endverbatim

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}" />
    <script src="{{ asset('assets/js/auth/theme.js') }}"></script>
    @stack('head')
</head>
<body>

@php
    // URL dashboard sesuai role (hanya dihitung kalau sudah login)
    $dashboardUrl = auth()->check()
        ? match ((int) auth()->user()->role) {
            0 => '/superadmin/dashboard',
            1 => '/admin/dashboard',
            2 => '/siswa/dashboard',
            default => '/',
        }
        : null;

    // Daftar menu — link aktif ditentukan otomatis dari URL yang sedang dibuka
    $menus = [
        ['label' => 'BERANDA', 'url' => url('/'),        'active' => request()->is('/')],
        ['label' => 'KARYA',   'url' => url('/karya'),   'active' => request()->is('karya', 'karya/*')],
        ['label' => 'ARTIKEL', 'url' => url('/artikel'), 'active' => request()->is('artikel', 'artikel/*')],
        ['label' => 'TENTANG', 'url' => url('/tentang'), 'active' => request()->is('tentang', 'tentang/*')],
    ];
@endphp

    <!-- Elemen Dekoratif Grid Background & Floating Shapes -->
    <div class="decorative-shapes" aria-hidden="true">
        <div class="shape shape-1">✨</div>
        <div class="shape shape-2">MUSEUM VIRTUAL</div>
        <div class="shape shape-3"></div>
        <div class="shape shape-4">CURATOR ACCESS</div>
        <div class="shape shape-5"></div>
        <div class="shape shape-6"></div>
    </div>

    <!-- ===== HEADER (Floating Capsule Navbar) ===== -->
    <header class="sticky top-4 z-50 px-4">
        <nav class="relative mx-auto max-w-7xl bg-white dark:bg-zinc-900 rounded-full border-4 border-black dark:border-white shadow-[6px_6px_0px_#000] dark:shadow-[6px_6px_0px_#fff] px-4 sm:px-6 py-3 transition-all duration-300">
            <div class="flex items-center justify-between">

                <!-- 1. Logo & Title -->
                <div class="flex items-center gap-2 sm:gap-3">
                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-white dark:bg-zinc-800 border-3 border-black dark:border-white flex items-center justify-center font-black shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] shrink-0">
                        <img src="{{ asset('assets/img/smk4.png') }}" alt="Logo" class="w-6 h-6 sm:w-7 sm:h-7 object-cover rounded-md" />
                    </div>
                    <span class="text-sm sm:text-lg font-black tracking-wider text-black dark:text-white whitespace-nowrap">MUSEUM.KARYA</span>
                </div>

                <!-- 2. Menu Links (Desktop & Dropdown Melayang di Mobile) -->
                <div id="navLinks"
                    class="hidden md:flex flex-col md:flex-row gap-3 md:gap-8 md:items-center
                        absolute md:static left-0 right-0 top-[calc(100%+16px)] md:top-auto
                        bg-zinc-900/95 md:bg-transparent backdrop-blur-md md:backdrop-blur-none
                        rounded-3xl md:rounded-none border-2 md:border-0 border-zinc-700 md:border-none
                        shadow-xl md:shadow-none
                        p-5 md:p-0 z-50 text-center md:text-left transition-all">

                    @foreach ($menus as $menu)
                        <a href="{{ $menu['url'] }}"
                            @if ($menu['active']) aria-current="page" @endif
                            class="text-sm md:text-xs font-black transition px-4 md:px-0 py-3 md:py-0
                                   rounded-2xl md:rounded-none border-2 md:border-0
                                   {{ $menu['active']
                                        ? 'bg-[#FFD23F] text-black border-black shadow-[3px_3px_0px_#000]
                                           md:bg-transparent md:shadow-none md:pb-1 md:border-b-4 md:border-black
                                           md:dark:border-white md:dark:text-white'
                                        : 'border-transparent text-zinc-300 hover:text-white
                                           md:text-zinc-500 md:dark:text-zinc-400
                                           md:hover:text-black md:dark:hover:text-white' }}">
                            {{ $menu['label'] }}
                        </a>
                    @endforeach

                    @auth
                        <a href="{{ $dashboardUrl }}"
                            class="md:hidden mt-2 text-xs font-black px-5 py-3 bg-[#74B9FF] text-black border-2 border-black rounded-2xl shadow-[2px_2px_0px_#000] active:translate-y-[1px] transition block text-center">
                            DASHBOARD
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="md:hidden mt-2 text-xs font-black px-5 py-3 bg-[#74B9FF] text-black border-2 border-black rounded-2xl shadow-[2px_2px_0px_#000] active:translate-y-[1px] transition block text-center">
                            LOGIN
                        </a>
                    @endauth
                </div>

                <!-- 3. Right Actions (Theme Toggle, Login/Dashboard Desktop, & Hamburger) -->
                <div class="flex items-center gap-2 sm:gap-3">
                    <button
                        id="themeToggle"
                        onclick="toggleTheme()"
                        aria-label="Ganti mode"
                        class="w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center rounded-full bg-[#FFD23F] border-3 border-black dark:border-white shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] text-gray-900 cursor-pointer hover:translate-y-[-2px] transition">
                        🌙
                    </button>

                    @auth
                        <a href="{{ $dashboardUrl }}"
                            class="hidden md:inline-block text-[10px] sm:text-xs font-black px-3 sm:px-5 py-2 sm:py-2.5 bg-[#74B9FF] text-black border-3 border-black dark:border-white rounded-full shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] hover:bg-[#54a0ff] transition whitespace-nowrap">
                            DASHBOARD
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="hidden md:inline-block text-[10px] sm:text-xs font-black px-3 sm:px-5 py-2 sm:py-2.5 bg-[#74B9FF] text-black border-3 border-black dark:border-white rounded-full shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] hover:bg-[#54a0ff] transition whitespace-nowrap">
                            LOGIN
                        </a>
                    @endauth

                    <!-- Hamburger Button (Mobile) -->
                    <button
                        id="menuToggle"
                        aria-label="Open Menu"
                        aria-expanded="false"
                        class="md:hidden w-9 h-9 rounded-xl bg-white dark:bg-zinc-800 border-3 border-black dark:border-white flex items-center justify-center font-black shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#fff] text-black dark:text-white cursor-pointer active:translate-y-[1px]">
                        <svg id="hamburgerIcon" class="w-5 h-5 block" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg id="closeIcon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

            </div>
        </nav>
    </header>

    <div class="main-wrapper">
        @yield('content')
    </div>

    <!-- Script Hamburger Toggle Mobile -->
    <script>
        const menuToggle = document.getElementById('menuToggle');
        const navLinks = document.getElementById('navLinks');
        const hamburgerIcon = document.getElementById('hamburgerIcon');
        const closeIcon = document.getElementById('closeIcon');

        menuToggle.addEventListener('click', () => {
            const isHidden = navLinks.classList.toggle('hidden');
            hamburgerIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
            menuToggle.setAttribute('aria-expanded', String(!isHidden));
        });
    </script>

    @stack('scripts')
</body>
</html>