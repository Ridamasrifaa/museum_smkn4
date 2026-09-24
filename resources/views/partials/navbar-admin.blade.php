{{--
    Partial ini di-include dua kali oleh layouts/admin.blade.php:
    1. Di dalam <aside> (sidebar desktop, lg ke atas)
    2. Di dalam #mobileDropdown (navbar dropdown, di bawah lg)
    Supaya link & state "active" selalu sinkron di kedua tampilan.
--}}
<a href="{{ url('/admin/dashboard') }}"
   class="flex items-center gap-3 px-4 py-3 rounded-xl {{ Request::is('admin/dashboard*') ? 'nav-link-active' : 'nav-link-idle' }}">
    <span>Dashboard</span>
</a>

<a href="{{ url('/admin/karya') }}"
   class="flex items-center gap-3 px-4 py-3 rounded-xl {{ Request::is('admin/karya*') ? 'nav-link-active' : 'nav-link-idle' }}">
    <span>Karya</span>
</a>

<a href="{{ url('/admin/siswa') }}"
   class="flex items-center gap-3 px-4 py-3 rounded-xl {{ Request::is('admin/siswa*') ? 'nav-link-active' : 'nav-link-idle' }}">
    <span>Siswa</span>
</a>

<a href="{{ url('/admin/kategori') }}"
   class="flex items-center gap-3 px-4 py-3 rounded-xl {{ Request::is('admin/kategori*') ? 'nav-link-active' : 'nav-link-idle' }}">
    <span>Kategori</span>
</a>

{{-- MENU USERS KHUSUS SUPER ADMIN --}}
@if(auth()->check() && auth()->user()->isSuperAdmin())
    <a href="{{ url('/superadmin/manajemen-admin') }}"
       class="flex items-center gap-3 px-4 py-3 rounded-xl {{ Request::is('superadmin/manajemen-admin*') || Request::is('admin/manajemen-admin*') ? 'nav-link-active' : 'nav-link-idle' }}">
        <span>Users</span>
    </a>
@endif

<a href="{{ url('/admin/artikel') }}"
   class="flex items-center gap-3 px-4 py-3 rounded-xl {{ Request::is('admin/artikel*') ? 'nav-link-active' : 'nav-link-idle' }}">
    <span>Artikel</span>
</a>

<a href="{{ route('admin.kode-undangan.index') }}"
   class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.kode-undangan.*') ? 'nav-link-active' : 'nav-link-idle' }}">
    <span>Kode Unik</span>
</a>

<a href="{{ url('/admin/profile') }}"
   class="flex items-center gap-3 px-4 py-3 rounded-xl {{ Request::is('admin/profile*') ? 'nav-link-active' : 'nav-link-idle' }}">
    <span>Profil Saya</span>
</a>

@if(auth()->check() && auth()->user()->isSuperAdmin())
    <a href="{{ url('/superadmin/dashboard') }}"
       class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('superadmin.dashboard*') ? 'nav-link-active' : 'nav-link-idle' }}">
        <span>Kembali ke Super Admin</span>
    </a>
@endif