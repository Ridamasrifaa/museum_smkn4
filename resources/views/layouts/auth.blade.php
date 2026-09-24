<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}" />
    <title>@yield('title', 'Karya PPLG')</title>

    <style type="text/tailwindcss">
      @custom-variant dark (&:where(.dark, .dark *));
    </style>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}" />
    
    <style>
      .custom-nav-container {
        border: 3px solid #111827;
        box-shadow: 4px 4px 0px #111827;
        border-radius: 9999px;
      }
      .dark .custom-nav-container {
        border-color: #374151;
        box-shadow: 4px 4px 0px #374151;
      }
      .custom-btn-capsule {
        border: 2px solid #111827;
        box-shadow: 2px 2px 0px #111827;
      }
      .dark .custom-btn-capsule {
        border-color: #374151;
        box-shadow: 2px 2px 0px #111827;
      }
    </style>

    @stack('styles')
  </head>
  <body class="bg-gray-50 text-gray-800 dark:bg-gray-950 dark:text-gray-100 font-sans min-h-screen flex flex-col transition-colors duration-300">

    <!-- NAVBAR UTAMA -->
    <header class="w-full py-4 px-4 lg:px-8 sticky top-0 z-50 bg-gray-50/80 dark:bg-gray-950/80 backdrop-blur-md">
      <nav class="max-w-7xl mx-auto bg-white dark:bg-gray-900 px-6 py-3 custom-nav-container flex items-center justify-between transition-colors duration-300">
        
        <!-- Logo & Nama Brand -->
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 rounded-full border-2 border-gray-900 dark:border-gray-700 overflow-hidden flex items-center justify-center bg-blue-600 text-white font-black">
            <img src="{{ asset('images/smk4.png') }}" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" alt="SMK4 Logo" class="w-full h-full object-cover" />
            <span style="display:none;" class="text-sm">K</span>
          </div>
          <span class="text-sm sm:text-lg font-black tracking-wider text-black dark:text-white whitespace-nowrap">MUSEUM KARYA</span> 
        </div>

        <!-- Menu Navigasi Tengah -->
        <div class="hidden md:flex items-center gap-8">
          <a href="{{ url('/') }}" class="text-sm font-bold text-gray-700 dark:text-gray-300 hover:text-blue-600 transition">BERANDA</a>
          <a href="{{ url('/karya') }}" class="text-sm font-bold text-gray-700 dark:text-gray-300 hover:text-blue-600 transition">KARYA</a>
          <a href="{{ url('/artikel') }}" class="text-sm font-bold text-gray-700 dark:text-gray-300 hover:text-blue-600 transition">ARTIKEL</a>
          <a href="{{ url('/tentang') }}" class="text-sm font-bold text-gray-700 dark:text-gray-300 hover:text-blue-600 transition">TENTANG</a>
        </div>

        <!-- Bagian Kanan (Theme Toggle & Tombol Auth Dinamis) -->
        <div class="flex items-center gap-3">
          <button id="themeToggle" onclick="toggleTheme()" aria-label="Ganti mode terang/gelap" class="w-10 h-10 rounded-full bg-yellow-300 dark:bg-gray-800 text-gray-900 dark:text-yellow-300 custom-btn-capsule flex items-center justify-center hover:translate-x-[-1px] hover:translate-y-[-1px] transition cursor-pointer">
            <svg class="icon-sun w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <svg class="icon-moon w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
            </svg>
          </button>

          @if(Route::is('login'))
            <a href="{{ route('register') }}" class="px-5 py-2 rounded-full bg-blue-400 dark:bg-blue-600 text-gray-900 dark:text-white font-black text-sm custom-btn-capsule hover:translate-x-[-1px] hover:translate-y-[-1px] transition">
              DAFTAR
            </a>
          @else
            <a href="{{ route('login') }}" class="px-5 py-2 rounded-full bg-blue-400 dark:bg-blue-600 text-gray-900 dark:text-white font-black text-sm custom-btn-capsule hover:translate-x-[-1px] hover:translate-y-[-1px] transition">
              LOGIN
            </a>
          @endif
        </div>

      </nav>
    </header>

    <!-- KONTEN UTAMA -->
    <main class="flex-1 flex items-center justify-center">
      @yield('content')
    </main>

    <!-- SCRIPT INTERNAL DARK MODE -->
    <script>
      function toggleTheme() {
        if (document.documentElement.classList.contains('dark')) {
          document.documentElement.classList.remove('dark');
          localStorage.setItem('theme', 'light');
        } else {
          document.documentElement.classList.add('dark');
          localStorage.setItem('theme', 'dark');
        }
      }

      if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
      } else {
        document.documentElement.classList.remove('dark');
      }
    </script>

    @stack('scripts')
  </body>
</html>