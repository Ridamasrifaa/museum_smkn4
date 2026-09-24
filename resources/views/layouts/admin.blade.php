<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <title>@yield('title', 'Admin Dashboard') - Museum Karya SMKN 4</title>

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    {{-- CSS Internal Khusus Admin (Neubrutalism) --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    @stack('styles')
</head>
<body class="overflow-x-hidden">

    <div class="flex h-screen overflow-hidden relative">

        {{-- ============================ --}}
        {{-- SIDEBAR DESKTOP (lg ke atas) --}}
        {{-- ============================ --}}
        <aside class="hidden lg:flex w-64 custom-nav-bg text-gray-800 flex-col justify-between shrink-0">
            <div>
                <div class="p-6 sidebar-brand flex items-center gap-3">
                    <div class="w-10 h-10 bg-[#ffcc00] border-2 border-black rounded-full flex items-center justify-center font-black text-black shadow-[2px_2px_0px_#000]">M</div>
                    <p class="font-extrabold text-gray-900 text-sm">Museum Karya SMKN 4</p>
                </div>

                <nav class="mt-6 space-y-2 px-4 overflow-y-auto max-h-[calc(100vh-200px)]">
                    @include('partials.navbar-admin')
                </nav>
            </div>

            <div class="p-6 sidebar-logout bg-[#fffdf9]">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
                <button type="button" onclick="openLogoutModal()" class="w-full px-4 py-2.5 bg-red-500 text-white rounded-xl btn-neubrutal cursor-pointer">
                    Logout
                </button>
            </div>
        </aside>

        {{-- ============================ --}}
        {{-- AREA KONTEN UTAMA --}}
        {{-- ============================ --}}
        <div class="flex-1 flex flex-col overflow-hidden w-full relative">

            {{-- HEADER UTAMA (berisi hamburger + dropdown khusus mobile) --}}
            <header class="admin-header z-20 relative">
                <div class="px-4 sm:px-8 py-4 flex justify-between items-center gap-4">
                    <div class="flex items-center gap-3 min-w-0">
                        {{-- Tombol Hamburger: hanya tampil di bawah lg --}}
                        <button onclick="toggleMobileDropdown()" class="lg:hidden p-2 bg-[#ffcc00] border-2 border-black rounded-xl shadow-[2px_2px_0px_#000] font-bold cursor-pointer hover:bg-yellow-400 active:translate-y-0.5 transition shrink-0">
                            🍔
                        </button>
                        <h1 class="text-base sm:text-2xl font-black text-gray-900 tracking-tight truncate">@yield('page_title', 'Dashboard Admin')</h1>
                    </div>

                    <div class="flex items-center gap-3 sm:gap-4 shrink-0">
                        @yield('header_action')

                        <div class="text-right hidden md:block">
                            <p class="font-extrabold text-gray-900 text-xs sm:text-sm">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] sm:text-xs text-gray-500 font-bold">
                                {{ Auth::user()->isSuperAdmin() ? 'Super Admin' : 'Admin ' . (Auth::user()->jurusan ?? 'Jurusan') }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- DROPDOWN NAVIGASI MOBILE SLOWMOTION (hanya di bawah lg) --}}
                <div id="mobileDropdown" class="lg:hidden bg-[#fffdf9] border-b-3 border-black shadow-[0_6px_0px_#000] px-4 py-3 absolute top-full left-0 right-0 z-30">
                    <nav class="space-y-2">
                        @include('partials.navbar-admin')
                    </nav>

                    <div class="pt-3 mt-3 border-t-2 border-black">
                        <button type="button" onclick="openLogoutModal()" class="w-full px-4 py-2 bg-red-500 text-white rounded-xl btn-neubrutal cursor-pointer text-sm">
                            Logout
                        </button>
                    </div>
                </div>
            </header>

            {{-- KONTEN HALAMAN --}}
            <div class="flex-1 overflow-auto p-4 sm:p-8 relative">
                @yield('content')
            </div>
        </div>
    </div>

    {{-- MODAL POP-UP LOGOUT --}}
    <div id="logoutModal" class="hidden fixed inset-0 z-50 bg-black/50 backdrop-blur-xs flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl border-3 border-black shadow-[6px_6px_0px_#000] max-w-md w-full overflow-hidden transform transition-all scale-100">
            <div class="bg-[#ffcc00] border-b-3 border-black p-5 text-black flex items-center gap-3">
                <div class="p-2 bg-white border-2 border-black rounded-lg shadow-[2px_2px_0px_#000]">
                    <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-black tracking-tight">Konfirmasi Keluar</h3>
            </div>

            <div class="p-6 text-center">
                <p class="text-gray-800 font-bold leading-relaxed text-base">
                    Yakin ingin keluar? Periksa dulu karya siswanya.
                </p>
            </div>

            <div class="bg-gray-50 px-6 py-4 flex gap-3 justify-end border-t-3 border-black">
                <button type="button" onclick="closeLogoutModal()" class="px-5 py-2.5 bg-gray-200 text-gray-800 rounded-xl btn-neubrutal cursor-pointer">
                    Tidak
                </button>
                <button type="button" onclick="confirmLogout()" class="px-5 py-2.5 bg-red-500 text-white rounded-xl btn-neubrutal cursor-pointer">
                    Yaa
                </button>
            </div>
        </div>
    </div>

    <script>
        // Toggle dropdown navigasi mobile (dengan animasi class, khusus < lg)
        function toggleMobileDropdown() {
            const dropdown = document.getElementById('mobileDropdown');
            dropdown.classList.toggle('dropdown-open');
        }

        // Modal Logout
        function openLogoutModal() {
            document.getElementById('logoutModal').classList.remove('hidden');
        }
        function closeLogoutModal() {
            document.getElementById('logoutModal').classList.add('hidden');
        }
        function confirmLogout() {
            document.getElementById('logout-form').submit();
        }
    </script>

    @stack('scripts')
</body>
</html>