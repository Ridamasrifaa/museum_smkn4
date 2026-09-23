@extends('layouts.superadmin')

@section('title', 'Manajemen Admin')
@section('page_title', 'Manajemen Akun Admin')

@section('content')
    @php
        // badge warna semantik ala Bootstrap, berdasarkan kolom jurusan asli admin
        $jurusanBadgeMap = [
            'PPLG' => ['label' => 'PPLG', 'class' => 'bg-[#198754] text-white'], // success
            'TKJ'  => ['label' => 'TKJ',  'class' => 'bg-[#0d6efd] text-white'], // primary
            'TJKT' => ['label' => 'TKJ',  'class' => 'bg-[#0d6efd] text-white'], // primary (alias)
            'DKV'  => ['label' => 'DKV',  'class' => 'bg-[#ffc107] text-black'], // warning
            'TOI'  => ['label' => 'TOI',  'class' => 'bg-[#6c757d] text-white'], // secondary
            'TSM'  => ['label' => 'TSM',  'class' => 'bg-[#dc3545] text-white'], // danger
        ];
        $jurusanBadge = function ($jurusan) use ($jurusanBadgeMap) {
            if (!$jurusan) return null;
            return $jurusanBadgeMap[strtoupper(trim($jurusan))] ?? null;
        };
    @endphp

    <div id="loading-content" class="absolute inset-0 bg-[#F5F1E8] z-50 flex flex-col items-center justify-center transition-opacity duration-300 ease-out">
        <div class="flex items-center gap-3 bg-white px-6 py-3 border-[3px] border-black rounded-2xl shadow-[4px_4px_0px_0px_#000]">
            <div class="w-5 h-5 border-4 border-black border-t-transparent rounded-full animate-spin"></div>
            <p class="text-black font-black text-sm uppercase tracking-wide">Memuat data...</p>
        </div>
    </div>

    <div class="mb-6 flex justify-between items-center flex-wrap gap-3">
        <h2 class="text-xl font-black text-black uppercase">Daftar Akun Admin</h2>
        <button onclick="openCreateModal()" class="px-6 py-2.5 bg-green-300 text-black border-[3px] border-black rounded-2xl shadow-[4px_4px_0px_0px_#000] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition font-black uppercase flex items-center gap-2 cursor-pointer">
            <span>+</span> Tambah Admin
        </button>
    </div>

    <div class="bg-white border-[3px] border-black rounded-2xl shadow-[6px_6px_0px_0px_#000] mb-6 p-4">
        <h2 class="text-xl font-black text-black uppercase mb-4">Cari Admin</h2>
        <div class="flex flex-col sm:flex-row gap-3">
            <form method="GET" class="flex flex-1 gap-3">
                <input id="searchInput" name="search" value="{{ request('search') }}" placeholder="Cari username atau email..." class="flex-1 px-4 py-2 border-2 border-black rounded-xl focus:outline-none focus:ring-2 focus:ring-black font-medium">
                <button type="submit" class="bg-amber-300 text-black border-[3px] border-black rounded-xl px-5 font-black uppercase hover:bg-amber-400 transition cursor-pointer">Cari</button>
            </form>
            <a href="{{ url('/superadmin/manajemen-admin') }}" class="px-6 py-2.5 bg-gray-200 text-black border-[3px] border-black rounded-xl font-black uppercase hover:bg-gray-300 transition text-sm whitespace-nowrap text-center cursor-pointer">Reset</a>
        </div>
    </div>

    {{-- ================= CATATAN ROLE ================= --}}
    <div class="bg-amber-100 border-[3px] border-black rounded-2xl px-6 py-4 mb-6 text-sm text-black font-bold shadow-[6px_6px_0px_0px_#000] md:shadow-none md:rounded-none md:rounded-t-2xl md:mb-0 md:border-b-0">
        <span class="uppercase">Catatan Untuk Role</span>
        <div>Role 0 = Super Admin &nbsp;|&nbsp; Role 1 = Admin Biasa</div>
    </div>

    {{-- ================= DESKTOP TABLE (md+) ================= --}}
    <div class="hidden md:block bg-white border-[3px] border-black rounded-b-2xl shadow-[6px_6px_0px_0px_#000] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-black text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-black uppercase tracking-wider w-16">No</th>
                        <th class="px-6 py-3 text-left text-xs font-black uppercase tracking-wider">Username</th>
                        <th class="px-6 py-3 text-left text-xs font-black uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-black uppercase tracking-wider">Role / Jurusan</th>
                        <th class="px-6 py-3 text-center text-xs font-black uppercase tracking-wider w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($admins as $admin)
                        <tr class="border-t-2 border-black hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-bold text-black">
                                {{ $loop->iteration + ($admins->currentPage() - 1) * $admins->perPage() }}
                            </td>
                            <td class="px-6 py-4 text-sm font-black text-black">{{ $admin->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700 font-medium">{{ $admin->email }}</td>
                            <td class="px-6 py-4 text-sm">
                                @php $jb = $admin->role == 0 ? null : $jurusanBadge($admin->jurusan); @endphp
                                @if($admin->role == 0)
                                    <span class="px-2 py-1 text-xs font-black border-2 border-black rounded-lg bg-black text-white">Super Admin</span>
                                @elseif($jb)
                                    <span class="px-2 py-1 text-xs font-black border-2 border-black rounded-lg {{ $jb['class'] }}">{{ $jb['label'] }}</span>
                                @else
                                    <span class="px-2 py-1 text-xs font-black border-2 border-black rounded-lg bg-gray-300 text-black">Admin</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-center">
                                <div class="flex justify-center gap-2">
                                    <button type="button"
                                        data-action="edit"
                                        data-id="{{ $admin->id }}"
                                        data-username="{{ $admin->name }}"
                                        data-email="{{ $admin->email }}"
                                        data-role="{{ $admin->role }}"
                                        data-jurusan="{{ $admin->jurusan }}"
                                        class="px-3 py-1 bg-violet-200 text-black border-2 border-black rounded-lg hover:bg-violet-300 transition font-black text-xs uppercase cursor-pointer">
                                        Edit
                                    </button>

                                    <form id="deleteForm-{{ $admin->id }}" action="{{ url('/superadmin/manajemen-admin/' . $admin->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" data-action="delete" data-id="{{ $admin->id }}" data-username="{{ $admin->name }}" class="px-3 py-1 bg-red-200 text-black border-2 border-black rounded-lg hover:bg-red-300 transition font-black text-xs uppercase cursor-pointer">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-8 text-gray-400 text-sm font-bold">Belum ada admin.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 bg-gray-50 border-t-[3px] border-black flex flex-col sm:flex-row justify-between items-center gap-2 text-sm text-black font-bold">
            <span>Total: <span class="font-black">{{ $admins->total() }}</span> Admin</span>
            <div>{{ $admins->links() }}</div>
        </div>
    </div>

    {{-- ================= MOBILE CARDS (<md) — 1 admin per card ================= --}}
    <div class="md:hidden space-y-3">
        @forelse($admins as $admin)
            <div class="bg-white border-[3px] border-black rounded-2xl shadow-[4px_4px_0px_0px_#000] p-4">
                <div class="flex justify-between items-start mb-3">
                    <div>
                        <p class="text-[10px] font-bold text-gray-500 uppercase">No {{ $loop->iteration + ($admins->currentPage() - 1) * $admins->perPage() }}</p>
                        <p class="text-base font-black text-black">{{ $admin->name }}</p>
                    </div>
                    @php $jbMobile = $admin->role == 0 ? null : $jurusanBadge($admin->jurusan); @endphp
                    @if($admin->role == 0)
                        <span class="px-2 py-1 text-xs font-black border-2 border-black rounded-lg shrink-0 bg-black text-white">Super Admin</span>
                    @elseif($jbMobile)
                        <span class="px-2 py-1 text-xs font-black border-2 border-black rounded-lg shrink-0 {{ $jbMobile['class'] }}">{{ $jbMobile['label'] }}</span>
                    @else
                        <span class="px-2 py-1 text-xs font-black border-2 border-black rounded-lg shrink-0 bg-gray-300 text-black">Admin</span>
                    @endif
                </div>

                <p class="text-[10px] font-bold text-gray-500 uppercase">Email</p>
                <p class="text-sm text-gray-800 font-medium mb-4 break-all">{{ $admin->email }}</p>

                <div class="flex gap-2">
                    <button type="button"
                        data-action="edit"
                        data-id="{{ $admin->id }}"
                        data-username="{{ $admin->name }}"
                        data-email="{{ $admin->email }}"
                        data-role="{{ $admin->role }}"
                        data-jurusan="{{ $admin->jurusan }}"
                        class="flex-1 px-3 py-2 bg-violet-200 text-black border-2 border-black rounded-lg hover:bg-violet-300 transition font-black text-xs uppercase cursor-pointer">
                        Edit
                    </button>

                    <form id="deleteForm-mobile-{{ $admin->id }}" action="{{ url('/superadmin/manajemen-admin/' . $admin->id) }}" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="button" data-action="delete" data-id="{{ $admin->id }}" data-username="{{ $admin->name }}" class="w-full px-3 py-2 bg-red-200 text-black border-2 border-black rounded-lg hover:bg-red-300 transition font-black text-xs uppercase cursor-pointer">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="bg-white border-[3px] border-black rounded-2xl shadow-[4px_4px_0px_0px_#000] p-6 text-center text-gray-400 text-sm font-bold">
                Belum ada admin.
            </div>
        @endforelse

        <div class="bg-white border-[3px] border-black rounded-2xl shadow-[4px_4px_0px_0px_#000] p-4 flex flex-col items-center gap-3 text-sm text-black font-bold">
            <span>Total: <span class="font-black">{{ $admins->total() }}</span> Admin</span>
            <div>{{ $admins->links() }}</div>
        </div>
    </div>

    {{-- Modal Admin (Create/Edit) --}}
    <div id="adminModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white border-[3px] border-black rounded-2xl shadow-[8px_8px_0px_0px_#000] max-w-md w-full overflow-hidden">
            <div class="px-6 py-4 bg-violet-300 border-b-[3px] border-black flex justify-between items-center">
                <h3 id="modalTitle" class="text-lg font-black text-black uppercase">Tambah Admin Baru</h3>
                <button type="button" onclick="closeModal()" class="text-black hover:text-gray-700 font-black cursor-pointer">✕</button>
            </div>

            <form id="adminForm" class="p-6 space-y-4" method="POST" action="{{ url('/superadmin/manajemen-admin') }}">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <input type="hidden" id="adminId">

                <div>
                    <label class="block text-sm font-black text-black mb-1 uppercase">Username</label>
                    <input type="text" name="name" id="username" placeholder="Masukkan username" class="w-full px-4 py-2 border-2 border-black rounded-xl focus:outline-none focus:ring-2 focus:ring-black text-sm" required>
                </div>

                <div>
                    <label class="block text-sm font-black text-black mb-1 uppercase">Email</label>
                    <input type="email" name="email" id="email" placeholder="Masukkan email" class="w-full px-4 py-2 border-2 border-black rounded-xl focus:outline-none focus:ring-2 focus:ring-black text-sm" required>
                </div>

                <div>
                    <label class="block text-sm font-black text-black mb-1 uppercase">Role</label>
                    <select name="role" id="role" class="w-full px-4 py-2 border-2 border-black rounded-xl focus:outline-none focus:ring-2 focus:ring-black text-sm" required>
                        <option value="1">Admin Biasa</option>
                        <option value="0">Super Admin</option>
                    </select>
                </div>

                <div id="jurusanGroup">
                    <label class="block text-sm font-black text-black mb-1 uppercase">Jurusan</label>
                    <select name="jurusan" id="jurusan" class="w-full px-4 py-2 border-2 border-black rounded-xl focus:outline-none focus:ring-2 focus:ring-black text-sm">
                        <option value="">Pilih jurusan</option>
                        <option value="PPLG">PPLG</option>
                        <option value="TKJ">TKJ</option>
                        <option value="DKV">DKV</option>
                        <option value="TOI">TOI</option>
                        <option value="TSM">TSM</option>
                    </select>
                </div>

                <div id="passwordGroup">
                    <label class="block text-sm font-black text-black mb-1 uppercase">Password</label>
                    <input type="password" name="password" id="password" placeholder="Masukkan password" class="w-full px-4 py-2 border-2 border-black rounded-xl focus:outline-none focus:ring-2 focus:ring-black text-sm">
                    <p id="passwordHelp" class="text-xs text-gray-500 font-bold mt-1 hidden">*Kosongkan password jika tidak ingin mengubahnya.</p>
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="button" onclick="closeModal()" class="flex-1 px-4 py-2 border-2 border-black rounded-xl text-black bg-white hover:bg-gray-100 transition font-black uppercase text-sm cursor-pointer">Batal</button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-violet-400 text-black border-2 border-black rounded-xl hover:bg-violet-500 transition font-black uppercase text-sm cursor-pointer">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Konfirmasi Hapus --}}
    <div id="deleteModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white border-[3px] border-black rounded-2xl shadow-[8px_8px_0px_0px_#000] max-w-sm w-full overflow-hidden">
            <div class="px-6 py-4 bg-red-300 border-b-[3px] border-black">
                <h3 class="text-lg font-black text-black uppercase">Hapus Admin?</h3>
            </div>
            <div class="p-6 text-center">
                <p class="text-gray-800 font-bold">
                    Yakin ingin menghapus admin
                    <span id="deleteAdminUsername" class="font-black text-black"></span>?
                    Tindakan ini tidak bisa dibatalkan.
                </p>
            </div>
            <div class="flex gap-3 p-4 border-t-[3px] border-black bg-gray-50">
                <button type="button" onclick="closeDeleteModal()" class="flex-1 px-4 py-2 border-2 border-black rounded-xl text-black bg-white hover:bg-gray-100 transition font-black uppercase text-sm cursor-pointer">Batal</button>
                <button type="button" onclick="confirmDelete()" class="flex-1 px-4 py-2 bg-red-400 text-white border-2 border-black rounded-xl hover:bg-red-500 transition font-black uppercase text-sm cursor-pointer">Hapus</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/superadmin/manajemen-admin.js') }}"></script>
@endpush