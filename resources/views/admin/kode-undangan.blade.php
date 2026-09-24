@extends('layouts.admin')

@section('title', 'Kode Unik')
@section('page_title', 'Kode Undangan')

@section('header_action')
    <button onclick="openModal('modalTambah')" class="px-3 py-2 sm:px-4 sm:py-2 bg-[#ffcc00] text-black rounded-xl btn-neubrutal flex items-center gap-1.5 text-xs sm:text-sm cursor-pointer">
        <span class="font-black text-base leading-none">+</span>
        <span class="hidden sm:inline">Tambah Kode</span>
        <span class="sm:hidden">Tambah</span>
    </button>
@endsection

@section('content')

    {{-- RESPONSIVE LIST / TABLE CONTAINER --}}
    <div class="neubrutal-card overflow-hidden">

        {{-- 1. TAMPILAN DESKTOP (TABEL) --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full border-collapse">
                <thead class="bg-gray-100 border-b-3 border-black">
                    <tr>
                        <th class="px-4 py-3.5 text-left text-xs font-black text-gray-900 uppercase">No</th>
                        <th class="px-6 py-3.5 text-left text-xs font-black text-gray-900 uppercase">Kode Unik</th>
                        <th class="px-6 py-3.5 text-left text-xs font-black text-gray-900 uppercase">Kelas</th>
                        <th class="px-6 py-3.5 text-left text-xs font-black text-gray-900 uppercase">Jurusan</th>
                        <th class="px-6 py-3.5 text-left text-xs font-black text-gray-900 uppercase">Deskripsi</th>
                        <th class="px-6 py-3.5 text-left text-xs font-black text-gray-900 uppercase">Pemakaian</th>
                        <th class="px-6 py-3.5 text-left text-xs font-black text-gray-900 uppercase">Status</th>
                        <th class="px-6 py-3.5 text-left text-xs font-black text-gray-900 uppercase">Kadaluarsa</th>
                        <th class="px-6 py-3.5 text-center text-xs font-black text-gray-900 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y-2 divide-gray-200">
                    @forelse($kodeUndangans as $index => $kode)
                        <tr class="hover:bg-yellow-50/50">
                            <td class="px-4 py-4 text-sm font-bold text-gray-900">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-mono font-black text-black {{ $kode->is_active ? 'bg-yellow-200' : 'bg-gray-200' }} px-2.5 py-1 rounded-lg text-sm border-2 border-black shadow-[2px_2px_0px_#000]">
                                    {{ $kode->code }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900 font-extrabold whitespace-nowrap">{{ $kode->kelas }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700 font-bold whitespace-nowrap">{{ $kode->jurusan }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700 font-medium max-w-xs truncate">{{ $kode->description }}</td>
                            <td class="px-6 py-4 text-sm font-black {{ $kode->used_count >= $kode->max_uses ? 'text-red-600' : 'text-gray-900' }} whitespace-nowrap">
                                {{ $kode->used_count }} / {{ $kode->max_uses }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($kode->is_active)
                                    <span class="inline-block px-3 py-1 rounded-lg text-xs font-black bg-green-200 text-green-900 border-2 border-black shadow-[2px_2px_0px_#000]">Aktif</span>
                                @else
                                    <span class="inline-block px-3 py-1 rounded-lg text-xs font-black bg-red-200 text-red-900 border-2 border-black shadow-[2px_2px_0px_#000]">Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700 font-semibold whitespace-nowrap">{{ optional($kode->expires_at)->format('d M Y') ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-center whitespace-nowrap">
                                <button onclick="openEditModal('{{ $kode->id }}', '{{ $kode->code }}', '{{ $kode->kelas }}', '{{ $kode->jurusan }}', '{{ $kode->description }}', {{ $kode->max_uses }}, {{ $kode->used_count }}, '{{ optional($kode->expires_at)->format('Y-m-d') }}', {{ $kode->is_active ? 'true' : 'false' }})" class="px-3 py-1.5 bg-sky-400 text-black border-2 border-black rounded-lg font-black text-xs shadow-[2px_2px_0px_#000] inline-block mr-2 hover:translate-y-[-1px] cursor-pointer">Edit</button>
                                <form action="{{ route('admin.kode-undangan.destroy', $kode->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus kode ini?')" class="px-3 py-1.5 bg-red-400 text-black border-2 border-black rounded-lg font-black text-xs shadow-[2px_2px_0px_#000] cursor-pointer hover:translate-y-[-1px]">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-12 text-gray-500 font-bold text-sm">Belum ada kode unik.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- 2. TAMPILAN MOBILE (CARD LIST) --}}
        <div class="block md:hidden divide-y-2 divide-gray-200">
            @forelse($kodeUndangans as $kode)
                <div class="p-4 space-y-3 hover:bg-yellow-50/40 transition">
                    <div class="flex items-start justify-between gap-2">
                        <span class="font-mono font-black text-black {{ $kode->is_active ? 'bg-yellow-200' : 'bg-gray-200' }} px-2.5 py-1 rounded-lg text-xs border-2 border-black shadow-[2px_2px_0px_#000]">
                            {{ $kode->code }}
                        </span>
                        @if($kode->is_active)
                            <span class="px-2.5 py-0.5 rounded-lg text-[10px] font-black bg-green-200 text-green-900 border-2 border-black shadow-[2px_2px_0px_#000]">Aktif</span>
                        @else
                            <span class="px-2.5 py-0.5 rounded-lg text-[10px] font-black bg-red-200 text-red-900 border-2 border-black shadow-[2px_2px_0px_#000]">Nonaktif</span>
                        @endif
                    </div>

                    <div class="space-y-1">
                        <p class="text-sm font-extrabold text-gray-900">{{ $kode->kelas }} <span class="font-normal text-xs text-gray-600">({{ $kode->jurusan }})</span></p>
                        <p class="text-xs text-gray-600 font-medium">{{ $kode->description }}</p>
                    </div>

                    <div class="flex flex-wrap items-center justify-between text-xs font-bold text-gray-700 pt-1">
                        <span>Pemakaian: <strong class="{{ $kode->used_count >= $kode->max_uses ? 'text-red-600' : 'text-black' }}">{{ $kode->used_count }} / {{ $kode->max_uses }}</strong></span>
                        <span>Kadaluarsa: {{ optional($kode->expires_at)->format('d M Y') ?? '-' }}</span>
                    </div>

                    <div class="flex items-center justify-end gap-2 pt-2 border-t border-gray-100">
                        <button onclick="openEditModal('{{ $kode->id }}', '{{ $kode->code }}', '{{ $kode->kelas }}', '{{ $kode->jurusan }}', '{{ $kode->description }}', {{ $kode->max_uses }}, {{ $kode->used_count }}, '{{ optional($kode->expires_at)->format('Y-m-d') }}', {{ $kode->is_active ? 'true' : 'false' }})" class="px-3 py-1 bg-sky-400 text-black border-2 border-black rounded-lg font-black text-xs shadow-[2px_2px_0px_#000] cursor-pointer">Edit</button>
                        <form action="{{ route('admin.kode-undangan.destroy', $kode->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus kode ini?')" class="px-3 py-1 bg-red-400 text-black border-2 border-black rounded-lg font-black text-xs shadow-[2px_2px_0px_#000] cursor-pointer">Hapus</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-10 text-gray-500 font-bold text-sm">Belum ada kode unik.</div>
            @endforelse
        </div>
    </div>

    {{-- MODAL TAMBAH KODE --}}
    <div id="modalTambah" class="hidden fixed inset-0 z-50 bg-black/50 backdrop-blur-xs flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl border-3 border-black shadow-[6px_6px_0px_#000] max-w-md w-full overflow-hidden">
            <div class="bg-[#ffcc00] border-b-3 border-black p-4 text-black flex justify-between items-center">
                <h3 class="text-lg font-black">Tambah Kode Unik</h3>
                <button type="button" onclick="closeModal('modalTambah')" class="text-black hover:opacity-75 text-2xl font-black cursor-pointer">&times;</button>
            </div>

            <form action="{{ route('admin.kode-undangan.store') }}" method="POST" class="p-5 sm:p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-black text-gray-900 mb-1">Kode Unik *</label>
                    <input type="text" name="code" required placeholder="Contoh: XII-PPLG-2-2026" class="w-full px-4 py-2 rounded-xl input-neubrutal text-sm text-gray-900">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-black text-gray-900 mb-1">Kelas *</label>
                        <input type="text" name="kelas" required placeholder="XII PPLG 2" class="w-full px-4 py-2 rounded-xl input-neubrutal text-sm text-gray-900">
                    </div>
                    <div>
                        <label class="block text-sm font-black text-gray-900 mb-1">Jurusan *</label>
                        <input type="text" name="jurusan" required placeholder="PPLG" class="w-full px-4 py-2 rounded-xl input-neubrutal text-sm text-gray-900">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-black text-gray-900 mb-1">Deskripsi</label>
                    <input type="text" name="description" placeholder="Deskripsi opsional..." class="w-full px-4 py-2 rounded-xl input-neubrutal text-sm text-gray-900">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-black text-gray-900 mb-1">Maks. Pemakaian *</label>
                        <input type="number" name="max_uses" value="36" min="1" required class="w-full px-4 py-2 rounded-xl input-neubrutal text-sm text-gray-900">
                    </div>
                    <div>
                        <label class="block text-sm font-black text-gray-900 mb-1">Tanggal Kadaluarsa</label>
                        <input type="date" name="expires_at" class="w-full px-4 py-2 rounded-xl input-neubrutal text-sm text-gray-900">
                    </div>
                </div>

                <div class="pt-1">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 rounded border-2 border-black text-yellow-500 focus:ring-0">
                        <span class="text-sm font-black text-gray-900">Status Aktif</span>
                    </label>
                </div>

                <div class="pt-3 flex gap-3 justify-end border-t-3 border-black">
                    <button type="button" onclick="closeModal('modalTambah')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-xl btn-neubrutal text-xs sm:text-sm cursor-pointer">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-[#ffcc00] text-black rounded-xl btn-neubrutal text-xs sm:text-sm cursor-pointer">
                        Simpan Kode
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL EDIT KODE --}}
    <div id="modalEdit" class="hidden fixed inset-0 z-50 bg-black/50 backdrop-blur-xs flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl border-3 border-black shadow-[6px_6px_0px_#000] max-w-md w-full overflow-hidden">
            <div class="bg-sky-400 border-b-3 border-black p-4 text-black flex justify-between items-center">
                <h3 class="text-lg font-black">Edit Kode Unik</h3>
                <button type="button" onclick="closeModal('modalEdit')" class="text-black hover:opacity-75 text-2xl font-black cursor-pointer">&times;</button>
            </div>

            <form id="editForm" action="" method="POST" class="p-5 sm:p-6 space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-black text-gray-900 mb-1">Kode Unik *</label>
                    <input type="text" name="code" id="editCode" required class="w-full px-4 py-2 rounded-xl input-neubrutal text-sm text-gray-900">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-black text-gray-900 mb-1">Kelas *</label>
                        <input type="text" name="kelas" id="editKelas" required class="w-full px-4 py-2 rounded-xl input-neubrutal text-sm text-gray-900">
                    </div>
                    <div>
                        <label class="block text-sm font-black text-gray-900 mb-1">Jurusan *</label>
                        <input type="text" name="jurusan" id="editJurusan" required class="w-full px-4 py-2 rounded-xl input-neubrutal text-sm text-gray-900">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-black text-gray-900 mb-1">Deskripsi</label>
                    <input type="text" name="description" id="editDescription" class="w-full px-4 py-2 rounded-xl input-neubrutal text-sm text-gray-900">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-black text-gray-900 mb-1">Maks. Pemakaian *</label>
                        <input type="number" name="max_uses" id="editMaxUses" min="1" required class="w-full px-4 py-2 rounded-xl input-neubrutal text-sm text-gray-900">
                        <p class="text-[11px] font-bold text-gray-600 mt-1">Sudah dipakai: <span id="editUsedCount" class="font-black text-black">0</span></p>
                    </div>
                    <div>
                        <label class="block text-sm font-black text-gray-900 mb-1">Tanggal Kadaluarsa</label>
                        <input type="date" name="expires_at" id="editExpiresAt" class="w-full px-4 py-2 rounded-xl input-neubrutal text-sm text-gray-900">
                    </div>
                </div>

                <div class="pt-1">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" id="editIsActive" value="1" class="w-4 h-4 rounded border-2 border-black text-sky-500 focus:ring-0">
                        <span class="text-sm font-black text-gray-900">Status Aktif</span>
                    </label>
                </div>

                <div class="pt-3 flex gap-3 justify-end border-t-3 border-black">
                    <button type="button" onclick="closeModal('modalEdit')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-xl btn-neubrutal text-xs sm:text-sm cursor-pointer">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-sky-400 text-black rounded-xl btn-neubrutal text-xs sm:text-sm cursor-pointer">
                        Update Kode
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Modal Form Handler
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }
        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

        const editForm = document.getElementById('editForm');
        const baseKodeAction = "{{ url('/admin/kode-undangan') }}";

        function openEditModal(id, code, kelas, jurusan, description, maxUses, usedCount, expiresAt, isActive) {
            editForm.action = baseKodeAction + '/' + id;

            document.getElementById('editCode').value = code;
            document.getElementById('editKelas').value = kelas;
            document.getElementById('editJurusan').value = jurusan;
            document.getElementById('editDescription').value = description;
            document.getElementById('editMaxUses').value = maxUses;
            document.getElementById('editUsedCount').innerText = usedCount;
            document.getElementById('editExpiresAt').value = expiresAt;
            document.getElementById('editIsActive').checked = isActive;

            openModal('modalEdit');
        }
    </script>
@endpush