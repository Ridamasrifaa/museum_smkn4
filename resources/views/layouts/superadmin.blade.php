<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <title>@yield('title', 'Super Admin') - Museum Karya PPLG</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/admin/style.css') }}">
</head>
<body class="bg-[#F5F1E8]">
    @php
        $navActive   = 'flex items-center gap-3 px-4 py-3 rounded-2xl border-[3px] border-black bg-amber-300 text-black font-black shadow-[4px_4px_0px_0px_#000]';
        $navInactive = 'flex items-center gap-3 px-4 py-3 rounded-2xl border-[3px] border-black bg-white text-black font-bold hover:bg-gray-50 transition';
        $navItem = fn($active) => $active ? $navActive : $navInactive;
    @endphp

    <div class="lg:flex lg:h-screen lg:overflow-hidden">

        {{-- ================= DESKTOP SIDEBAR (lg+) ================= --}}
        <aside class="hidden lg:flex lg:flex-col lg:w-72 lg:h-screen lg:shrink-0 p-5 gap-4">
            <div class="flex items-center gap-3 bg-white border-[3px] border-black rounded-2xl shadow-[4px_4px_0px_0px_#000] p-4 shrink-0">
                <div class="w-11 h-11 rounded-xl border-[3px] border-black bg-violet-400 flex items-center justify-center font-black text-black">SA</div>
                <div>
                    <p class="font-black text-sm leading-tight">Museum Karya SMKN 4</p>
                    <p class="text-xs text-gray-500 font-bold uppercase">Super Admin</p>
                </div>
            </div>

            <nav class="flex-1 overflow-y-auto space-y-3">
                <a href="{{ url('/superadmin/dashboard') }}" class="{{ $navItem(Request::is('superadmin/dashboard*')) }}"><span>Dashboard</span></a>
                <a href="{{ url('/superadmin/manajemen-admin') }}" class="{{ $navItem(Request::is('superadmin/manajemen-admin*')) }}"><span>Manajemen Admin</span></a>
                <a href="{{ url('/admin/karya') }}" class="{{ $navItem(Request::is('admin/karya*')) }}"><span>Karya</span></a>
                <a href="{{ url('/admin/siswa') }}" class="{{ $navItem(Request::is('admin/siswa*')) }}"><span>Siswa</span></a>
                <a href="{{ url('/admin/kategori') }}" class="{{ $navItem(Request::is('admin/kategori*')) }}"><span>Kategori</span></a>
                <a href="{{ url('/admin/artikel') }}" class="{{ $navItem(Request::is('admin/artikel*')) }}"><span>Artikel</span></a>
                <a href="{{ route('admin.kode-undangan.index') }}" class="{{ $navItem(request()->routeIs('admin.kode-undangan.*')) }}"><span>Kode Unik</span></a>
            </nav>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
            <button type="button" onclick="openLogoutModal()"
                class="shrink-0 w-full px-4 py-3 bg-red-400 text-white border-[3px] border-black rounded-2xl shadow-[4px_4px_0px_0px_#000] font-black uppercase text-sm hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition cursor-pointer">
                Logout
            </button>
        </aside>

        {{-- ================= MOBILE TOPBAR (<lg) ================= --}}
        <div class="lg:hidden sticky top-0 z-30 bg-[#F5F1E8] p-4">
            <div class="flex items-center justify-between gap-3 bg-white border-[3px] border-black rounded-2xl shadow-[4px_4px_0px_0px_#000] px-4 py-3">
                <button type="button" onclick="toggleMobileNav()" id="mobileNavToggle" class="w-10 h-10 shrink-0 border-[3px] border-black rounded-xl bg-amber-300 flex items-center justify-center font-black text-lg">☰</button>
                <h1 class="font-black uppercase text-sm text-center flex-1 truncate">@yield('page_title', 'Dashboard')</h1>
                <div class="text-right leading-tight shrink-0">
                    <p class="font-black text-xs">{{ Auth::user()->name ?? 'Super Admin' }}</p>
                    <p class="text-[10px] text-violet-600 font-bold uppercase">Super Admin</p>
                </div>
            </div>
        </div>

        {{-- ================= MOBILE FULLSCREEN NAV PANEL ================= --}}
        <div id="mobileNavPanel" class="hidden lg:hidden fixed inset-0 z-40 bg-[#F5F1E8] p-4 overflow-y-auto">
            <div class="flex items-center justify-between gap-3 bg-white border-[3px] border-black rounded-2xl shadow-[4px_4px_0px_0px_#000] px-4 py-3 mb-4">
                <button type="button" onclick="toggleMobileNav()" class="w-10 h-10 shrink-0 border-[3px] border-black rounded-xl bg-violet-400 flex items-center justify-center font-black text-lg">✕</button>
                <h1 class="font-black uppercase text-sm text-center flex-1 truncate">Menu</h1>
                <div class="text-right leading-tight shrink-0">
                    <p class="font-black text-xs">{{ Auth::user()->name ?? 'Super Admin' }}</p>
                    <p class="text-[10px] text-violet-600 font-bold uppercase">Super Admin</p>
                </div>
            </div>

            <nav class="space-y-3">
                <a href="{{ url('/superadmin/dashboard') }}" class="{{ $navItem(Request::is('superadmin/dashboard*')) }}"><span>Dashboard</span></a>
                <a href="{{ url('/superadmin/manajemen-admin') }}" class="{{ $navItem(Request::is('superadmin/manajemen-admin*')) }}"><span>Manajemen Admin</span></a>
                <a href="{{ url('/admin/karya') }}" class="{{ $navItem(Request::is('admin/karya*')) }}"><span>Karya</span></a>
                <a href="{{ url('/admin/siswa') }}" class="{{ $navItem(Request::is('admin/siswa*')) }}"><span>Siswa</span></a>
                <a href="{{ url('/admin/kategori') }}" class="{{ $navItem(Request::is('admin/kategori*')) }}"><span>Kategori</span></a>
                <a href="{{ url('/admin/artikel') }}" class="{{ $navItem(Request::is('admin/artikel*')) }}"><span>Artikel</span></a>
                <a href="{{ route('admin.kode-undangan.index') }}" class="{{ $navItem(request()->routeIs('admin.kode-undangan.*')) }}"><span>Kode Unik</span></a>
            </nav>

            <button type="button" onclick="openLogoutModal()"
                class="w-full mt-4 px-4 py-3 bg-red-400 text-white border-[3px] border-black rounded-2xl shadow-[4px_4px_0px_0px_#000] font-black uppercase text-sm cursor-pointer">
                Logout
            </button>
        </div>

        {{-- ================= MAIN CONTENT ================= --}}
        <div class="flex-1 flex flex-col lg:overflow-hidden">
            <header class="hidden lg:flex items-center justify-between px-8 pt-8 pb-2 shrink-0">
                <h1 class="text-2xl font-black text-black uppercase">@yield('page_title', 'Dashboard')</h1>
                <div class="flex items-center gap-4">
                    @yield('header_action')
                    <div class="text-right border-[3px] border-black rounded-xl px-3 py-1.5 bg-violet-200">
                        <p class="font-black text-gray-900 text-sm">{{ Auth::user()->name ?? 'Super Admin' }}</p>
                        <p class="text-xs text-violet-700 font-bold uppercase">Super Admin</p>
                    </div>
                </div>
            </header>

            <div class="flex-1 lg:overflow-y-auto p-4 lg:p-8 lg:pt-4 relative">
                @yield('content')
            </div>
        </div>
    </div>

    {{-- MODAL LOGOUT --}}
    <div id="logoutModal" class="hidden fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
        <div class="bg-white border-[3px] border-black rounded-2xl shadow-[8px_8px_0px_0px_#000] max-w-md w-full overflow-hidden">
            <div class="bg-red-300 border-b-[3px] border-black p-5 text-black flex items-center gap-3">
                <div class="p-2 bg-white border-[3px] border-black rounded-xl">
                    <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-black uppercase">Konfirmasi Keluar</h3>
            </div>

            <div class="p-6 text-center">
                <p class="text-gray-800 font-bold leading-relaxed text-base">Yakin mau logout?</p>
            </div>

            <div class="bg-gray-100 border-t-[3px] border-black px-6 py-4 flex gap-3 justify-end">
                <button type="button" onclick="closeLogoutModal()" class="px-5 py-2.5 bg-white text-black font-black uppercase border-[3px] border-black rounded-xl hover:bg-gray-200 transition text-sm cursor-pointer">Batal</button>
                <button type="button" onclick="confirmLogout()" class="px-5 py-2.5 bg-red-400 text-white font-black uppercase border-[3px] border-black rounded-xl hover:bg-red-500 transition text-sm cursor-pointer">Ya, Logout</button>
            </div>
        </div>
    </div>

    <script>
        function openLogoutModal() {
            document.getElementById('logoutModal').classList.remove('hidden');
        }
        function closeLogoutModal() {
            document.getElementById('logoutModal').classList.add('hidden');
        }
        function confirmLogout() {
            document.getElementById('logout-form').submit();
        }
        function toggleMobileNav() {
            document.getElementById('mobileNavPanel').classList.toggle('hidden');
        }
    </script>

    @stack('scripts')
</body>
</html>