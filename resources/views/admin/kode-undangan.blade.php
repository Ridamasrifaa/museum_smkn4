@extends('layouts.admin')

@section('title', 'Kode Undangan')
@section('page_title', 'Kelola Kode Unik')

@section('header_action')
    <button type="button" onclick="openModal('create')" class="px-3 py-2 sm:px-4 sm:py-2 bg-[#ffcc00] text-black rounded-xl btn-neubrutal flex items-center gap-1.5 text-xs sm:text-sm cursor-pointer">
        <span class="font-black text-base leading-none">+</span>
        <span class="hidden sm:inline">Tambah Kode</span>
        <span class="sm:hidden">Tambah</span>
    </button>
@endsection

@section('content')

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border-2 border-black rounded-xl shadow-[2px_2px_0px_#000] text-green-800 font-bold text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- ALERT ERROR VALIDASI --}}
    @if($errors->any())
        <div class="mb-6 p-4 bg-red-100 border-2 border-black rounded-xl shadow-[2px_2px_0px_#000]">
            <ul class="list-disc list-inside text-red-700 text-sm font-bold">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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
                    @forelse($codes as $index => $code)
                        <tr class="hover:bg-yellow-50/50">
                            <td class="px-4 py-4 text-sm font-bold text-gray-900">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-mono font-black text-black {{ $code->is_active ? 'bg-yellow-200' : 'bg-gray-200' }} px-2.5 py-1 rounded-lg text-sm border-2 border-black shadow-[2px_2px_0px_#000]">
                                    {{ $code->code }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900 font-extrabold whitespace-nowrap">{{ $code->kelas }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700 font-bold whitespace-nowrap">{{ $code->jurusan }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700 font-medium max-w-xs truncate">{{ $code->description ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm font-black {{ $code->used_count >= $code->max_uses ? 'text-red-600' : 'text-gray-900' }} whitespace-nowrap">
                                {{ $code->used_count }} / {{ $code->max_uses }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($code->is_active)
                                    <span class="inline-block px-3 py-1 rounded-lg text-xs font-black bg-green-200 text-green-900 border-2 border-black shadow-[2px_2px_0px_#000]">Aktif</span>
                                @else
                                    <span class="inline-block px-3 py-1 rounded-lg text-xs font-black bg-red-200 text-red-900 border-2 border-black shadow-[2px_2px_0px_#000]">Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700 font-semibold whitespace-nowrap">
                                {{ $code->expires_at ? \Carbon\Carbon::parse($code->expires_at)->format('d M Y') : '-' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-center whitespace-nowrap">
                                <button type="button"
                                    onclick="openModal('edit', this)"
                                    data-id="{{ $code->id }}"
                                    data-code="{{ $code->code }}"
                                    data-kelas="{{ $code->kelas }}"
                                    data-jurusan="{{ $code->jurusan }}"
                                    data-description="{{ $code->description }}"
                                    data-max-uses="{{ $code->max_uses }}"
                                    data-used-count="{{ $code->used_count }}"
                                    data-expires-at="{{ $code->expires_at ? \Carbon\Carbon::parse($code->expires_at)->format('Y-m-d') : '' }}"
                                    data-is-active="{{ $code->is_active ? '1' : '0' }}"
                                    data-update-url="{{ route('admin.kode-undangan.update', $code) }}"
                                    class="px-3 py-1.5 bg-sky-400 text-black border-2 border-black rounded-lg font-black text-xs shadow-[2px_2px_0px_#000] inline-block mr-2 hover:translate-y-[-1px] cursor-pointer">
                                    Edit
                                </button>
                                <form action="{{ route('admin.kode-undangan.destroy', $code) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kode ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 bg-red-400 text-black border-2 border-black rounded-lg font-black text-xs shadow-[2px_2px_0px_#000] cursor-pointer hover:translate-y-[-1px]">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-12 text-gray-500 font-bold text-sm">Belum ada kode undangan. Silakan tambah terlebih dahulu.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- 2. TAMPILAN MOBILE (CARD LIST) --}}
        <div class="block md:hidden divide-y-2 divide-gray-200">
            @forelse($codes as $code)
                <div class="p-4 space-y-3 hover:bg-yellow-50/40 transition">
                    <div class="flex items-start justify-between gap-2">
                        <span class="font-mono font-black text-black {{ $code->is_active ? 'bg-yellow-200' : 'bg-gray-200' }} px-2.5 py-1 rounded-lg text-xs border-2 border-black shadow-[2px_2px_0px_#000]">
                            {{ $code->code }}
                        </span>
                        @if($code->is_active)
                            <span class="px-2.5 py-0.5 rounded-lg text-[10px] font-black bg-green-200 text-green-900 border-2 border-black shadow-[2px_2px_0px_#000]">Aktif</span>
                        @else
                            <span class="px-2.5 py-0.5 rounded-lg text-[10px] font-black bg-red-200 text-red-900 border-2 border-black shadow-[2px_2px_0px_#000]">Nonaktif</span>
                        @endif
                    </div>

                    <div class="space-y-1">
                        <p class="text-sm font-extrabold text-gray-900">{{ $code->kelas }} <span class="font-normal text-xs text-gray-600">({{ $code->jurusan }})</span></p>
                        <p class="text-xs text-gray-600 font-medium">{{ $code->description ?? '-' }}</p>
                    </div>

                    <div class="flex flex-wrap items-center justify-between text-xs font-bold text-gray-700 pt-1">
                        <span>Pemakaian: <strong class="{{ $code->used_count >= $code->max_uses ? 'text-red-600' : 'text-black' }}">{{ $code->used_count }} / {{ $code->max_uses }}</strong></span>
                        <span>Kadaluarsa: {{ $code->expires_at ? \Carbon\Carbon::parse($code->expires_at)->format('d M Y') : '-' }}</span>
                    </div>

                    <div class="flex items-center justify-end gap-2 pt-2 border-t border-gray-100">
                        <button type="button"
                            onclick="openModal('edit', this)"
                            data-id="{{ $code->id }}"
                            data-code="{{ $code->code }}"
                            data-kelas="{{ $code->kelas }}"
                            data-jurusan="{{ $code->jurusan }}"
                            data-description="{{ $code->description }}"
                            data-max-uses="{{ $code->max_uses }}"
                            data-used-count="{{ $code->used_count }}"
                            data-expires-at="{{ $code->expires_at ? \Carbon\Carbon::parse($code->expires_at)->format('Y-m-d') : '' }}"
                            data-is-active="{{ $code->is_active ? '1' : '0' }}"
                            data-update-url="{{ route('admin.kode-undangan.update', $code) }}"
                            class="px-3 py-1 bg-sky-400 text-black border-2 border-black rounded-lg font-black text-xs shadow-[2px_2px_0px_#000] cursor-pointer">
                            Edit
                        </button>
                        <form action="{{ route('admin.kode-undangan.destroy', $code) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kode ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-400 text-black border-2 border-black rounded-lg font-black text-xs shadow-[2px_2px_0px_#000] cursor-pointer">Hapus</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-10 text-gray-500 font-bold text-sm">Belum ada kode undangan. Silakan tambah terlebih dahulu.</div>
            @endforelse
        </div>
    </div>

    {{-- MODAL POPUP (Tambah / Edit dalam satu modal) --}}
    <div id="codeModal" class="hidden fixed inset-0 z-50 bg-black/50 backdrop-blur-xs flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl border-3 border-black shadow-[6px_6px_0px_#000] max-w-md w-full overflow-hidden max-h-[90vh] overflow-y-auto">
            <div id="modalHeader" class="bg-[#ffcc00] border-b-3 border-black p-4 text-black flex justify-between items-center sticky top-0">
                <h3 id="modalTitle" class="text-lg font-black">Tambah Kode Unik</h3>
                <button type="button" onclick="closeModal()" class="text-black hover:opacity-75 text-2xl font-black cursor-pointer leading-none">&times;</button>
            </div>

            <form id="codeForm" method="POST" action="{{ route('admin.kode-undangan.store') }}" class="p-5 sm:p-6 space-y-4">
                @csrf
                <div id="methodContainer"></div>

                <div>
                    <label class="block text-sm font-black text-gray-900 mb-1">Kode Unik <span class="text-red-500">*</span></label>
                    <input type="text" name="code" id="input_code" required placeholder="Contoh: XII-PPLG-2-2026" class="w-full px-4 py-2 rounded-xl input-neubrutal text-sm text-gray-900">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-black text-gray-900 mb-1">Kelas <span class="text-red-500">*</span></label>
                        <input type="text" name="kelas" id="input_kelas" required placeholder="XII PPLG 2" class="w-full px-4 py-2 rounded-xl input-neubrutal text-sm text-gray-900">
                    </div>
                    <div>
                        <label class="block text-sm font-black text-gray-900 mb-1">Jurusan <span class="text-red-500">*</span></label>
                        <input type="text" name="jurusan" id="input_jurusan" required placeholder="PPLG" class="w-full px-4 py-2 rounded-xl input-neubrutal text-sm text-gray-900">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-black text-gray-900 mb-1">Deskripsi</label>
                    <input type="text" name="description" id="input_description" placeholder="Opsional" class="w-full px-4 py-2 rounded-xl input-neubrutal text-sm text-gray-900">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-black text-gray-900 mb-1">Maks. Pemakaian <span class="text-red-500">*</span></label>
                        <input type="number" name="max_uses" id="input_max_uses" value="36" min="1" required class="w-full px-4 py-2 rounded-xl input-neubrutal text-sm text-gray-900">
                        <p id="usedCountText" class="text-[11px] font-bold text-gray-600 mt-1 hidden"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-black text-gray-900 mb-1">Tanggal Kadaluarsa</label>
                        <input type="date" name="expires_at" id="input_expires_at" class="w-full px-4 py-2 rounded-xl input-neubrutal text-sm text-gray-900">
                    </div>
                </div>

                <div class="pt-1">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" id="input_is_active" value="1" checked class="w-4 h-4 rounded border-2 border-black focus:ring-0 cursor-pointer">
                        <span class="text-sm font-black text-gray-900">Aktifkan kode ini</span>
                    </label>
                </div>

                <div class="pt-3 flex gap-3 justify-end border-t-3 border-black">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-xl btn-neubrutal text-xs sm:text-sm cursor-pointer">
                        Batal
                    </button>
                    <button type="submit" id="submitBtn" class="px-4 py-2 bg-[#ffcc00] text-black rounded-xl btn-neubrutal text-xs sm:text-sm cursor-pointer">
                        Simpan Kode
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const modal = document.getElementById('codeModal');
        const modalHeader = document.getElementById('modalHeader');
        const form = document.getElementById('codeForm');
        const modalTitle = document.getElementById('modalTitle');
        const submitBtn = document.getElementById('submitBtn');
        const methodContainer = document.getElementById('methodContainer');
        const usedCountText = document.getElementById('usedCountText');
        const storeUrl = "{{ route('admin.kode-undangan.store') }}";

        function openModal(mode, el = null) {
            modal.classList.remove('hidden');

            if (mode === 'create') {
                modalTitle.innerText = 'Tambah Kode Unik';
                submitBtn.innerText = 'Simpan Kode';
                modalHeader.classList.remove('bg-sky-400');
                modalHeader.classList.add('bg-[#ffcc00]');
                form.action = storeUrl;
                methodContainer.innerHTML = '';
                form.reset();
                document.getElementById('input_max_uses').value = 36;
                document.getElementById('input_is_active').checked = true;
                usedCountText.classList.add('hidden');
            } else if (mode === 'edit' && el) {
                const d = el.dataset;

                modalTitle.innerText = 'Edit Kode Unik';
                submitBtn.innerText = 'Update Kode';
                modalHeader.classList.remove('bg-[#ffcc00]');
                modalHeader.classList.add('bg-sky-400');

                form.action = d.updateUrl;
                methodContainer.innerHTML = '<input type="hidden" name="_method" value="PUT">';

                document.getElementById('input_code').value = d.code || '';
                document.getElementById('input_kelas').value = d.kelas || '';
                document.getElementById('input_jurusan').value = d.jurusan || '';
                document.getElementById('input_description').value = d.description || '';
                document.getElementById('input_max_uses').value = d.maxUses || 1;
                document.getElementById('input_expires_at').value = d.expiresAt || '';
                document.getElementById('input_is_active').checked = d.isActive === '1';

                usedCountText.innerText = 'Sudah dipakai: ' + (d.usedCount || 0);
                usedCountText.classList.remove('hidden');
            }
        }

        function closeModal() {
            modal.classList.add('hidden');
        }

        window.addEventListener('click', function (event) {
            if (event.target === modal) closeModal();
        });
    </script>
@endpush