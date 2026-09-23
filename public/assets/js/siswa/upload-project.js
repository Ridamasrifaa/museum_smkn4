/**
 * Halaman Kirim Project (siswa)
 *
 * Kontrak dengan resources/views/siswa/upload.blade.php:
 *  - tombol jurusan  : .btn-jurusan, onclick="pilihJurusan('X', event)"
 *                      (data-jurusan="X" disarankan; kalau tidak ada, teks tombol dipakai sebagai nama jurusan)
 *  - form per jurusan: #form_X
 *                      data-submit-class = warna tombol kirim (kelas Tailwind dari controller)
 *  - checkbox setuju : #agree_X  -> onchange="toggleSubmitButton('X')"
 *  - tombol kirim    : #submit_X
 *  - reset           : onclick="resetForm('X')"
 *  - #pageData       : data-success ("true"/"false"), data-active-jurusan
 *  - #successModal   : modal berhasil kirim
 *
 * Jurusan baru (mis. TKJ, TSM) tidak perlu diubah di sini: cukup ditambah di controller.
 */
(function () {
    'use strict';

    const GRAY_CLASSES = ['bg-gray-400', 'cursor-not-allowed'];
    const DEFAULT_SUBMIT_CLASS = 'bg-blue-600 hover:bg-blue-700';

    const byId = (id) => document.getElementById(id);
    const allForms = () => document.querySelectorAll('form[id^="form_"]');

    // ===== Pilih jurusan: tampilkan form yang sesuai =====
    // Parameter kedua (event) opsional: kalau ada, tombol yang diklik langsung ditandai aktif.
    function pilihJurusan(nama, event = null) {
        const form = byId('form_' + nama);
        if (!form) return;

        byId('belumPilihJurusan')?.classList.add('hidden');
        byId('pilihJurusanText')?.classList.add('hidden');

        // Pastikan nilai hidden input jurusan sesuai pilihan
        const jurusanInput = form.querySelector('input[name="jurusan"]');
        if (jurusanInput) jurusanInput.value = nama;

        // Tampilkan form terpilih, sembunyikan yang lain
        allForms().forEach((f) => f.classList.toggle('hidden', f !== form));

        // Tandai tombol jurusan yang aktif
        const clicked = event?.currentTarget ?? null;
        document.querySelectorAll('.btn-jurusan').forEach((btn) => {
            const label = btn.dataset.jurusan ?? btn.textContent.trim();
            btn.classList.toggle('active', clicked ? btn === clicked : label === nama);
        });
    }

    // ===== Validasi sebelum submit (form memakai novalidate) =====
    function validateBeforeSubmit(e) {
        const form = e.currentTarget;

        if (!form.checkValidity()) {
            e.preventDefault();
            form.classList.add('was-validated');

            const firstInvalid = form.querySelector(':invalid');
            if (firstInvalid) {
                firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstInvalid.focus();
            }
            return;
        }

        // Valid: cegah kirim ganda (kompresi gambar di server bisa memakan waktu)
        const submitBtn = form.querySelector('button[type="submit"]');
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.textContent = 'Mengirim...';
        }
    }

    // ===== Tombol kirim aktif hanya jika syarat & ketentuan dicentang =====
    function toggleSubmitButton(nama) {
        const form = byId('form_' + nama);
        const checkbox = byId('agree_' + nama);
        const submitBtn = byId('submit_' + nama);
        if (!form || !checkbox || !submitBtn) return;

        const colorClasses = (form.dataset.submitClass || DEFAULT_SUBMIT_CLASS)
            .split(/\s+/)
            .filter(Boolean);

        if (checkbox.checked) {
            submitBtn.disabled = false;
            submitBtn.classList.remove(...GRAY_CLASSES);
            submitBtn.classList.add(...colorClasses, 'cursor-pointer');
        } else {
            submitBtn.disabled = true;
            submitBtn.classList.remove(...colorClasses, 'cursor-pointer');
            submitBtn.classList.add(...GRAY_CLASSES);
        }
    }

    // ===== Reset form (juga membersihkan nilai lama dari old()) =====
    // form.reset() tidak dipakai karena hanya mengembalikan ke nilai awal (yaitu old()).
    function resetForm(nama) {
        const form = byId('form_' + nama);
        if (!form) return;

        form.querySelectorAll('input, textarea').forEach((el) => {
            if (el.type === 'hidden') return;

            if (el.type === 'checkbox' || el.type === 'radio') {
                el.checked = false;
            } else {
                el.value = '';
            }
        });

        form.classList.remove('was-validated');
        toggleSubmitButton(nama);
    }

    // ===== Modal berhasil kirim =====
    function openSuccessModal() {
        const modal = byId('successModal');
        if (!modal) return;

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeSuccessModal() {
        const modal = byId('successModal');
        if (!modal) return;

        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // Dipanggil dari atribut onclick / onchange di Blade
    window.pilihJurusan = pilihJurusan;
    window.toggleSubmitButton = toggleSubmitButton;
    window.resetForm = resetForm;
    window.closeSuccessModal = closeSuccessModal;

    document.addEventListener('DOMContentLoaded', function () {
        const pageData = byId('pageData');

        // 1. Modal berhasil jika session success bernilai true
        if (pageData?.dataset.success === 'true') {
            openSuccessModal();
        }

        // 2. Buka form jurusan yang aktif (setelah submit / error validasi)
        const activeJurusan = pageData?.dataset.activeJurusan;
        if (activeJurusan) {
            pilihJurusan(activeJurusan);
        }

        // 3. Validasi sebelum submit pada tiap form
        allForms().forEach((form) => form.addEventListener('submit', validateBeforeSubmit));

        // 4. Tutup modal berhasil: klik di luar kartu atau tekan Escape
        byId('successModal')?.addEventListener('click', function (e) {
            if (e.target === this) closeSuccessModal();
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeSuccessModal();
        });
    });
})();