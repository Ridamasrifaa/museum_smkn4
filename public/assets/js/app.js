document.addEventListener("DOMContentLoaded", function () {
    // Data Riwayat Update & Catatan Bug (Khusus Developer / Internal)
    const changelogData = [
        {
            version: "v1.1",
            date: "27 Juni 2026",
            features: [
                "Pembaruan struktur tata letak grid kartu tim pengembang",
                "Optimasi animasi interaktif pada mode terang dan gelap"
            ],
            bugs: [
                "Memperbaiki bug layout card yang patah pada layar ukuran tablet",
                "Menyesuaikan posisi margin card baris kedua agar presisi di tengah"
            ]
        },
        {
            version: "v1.0.0",
            date: "28 Desember 2026", // (Atau sesuaikan tanggal rilisnya)
            features: [
                "Merilis platform awal Museum Karya SMKN 4 Tasikmalaya",
                "Menambahkan menu Beranda, Karya, Artikel, dan Tentang",
                "Integrasi mode tema Terang/Gelap (Dark/Light mode)"
            ],
            bugs: [
                "Memperbaiki error saat pertama kali tombol dark mode ditekan",
                "Membersihkan console log yang tidak terpakai pada skrip utama"
            ]
        }
    ];

    // Set teks versi terbaru pada elemen HTML utama
    const versionEl = document.getElementById("app-version");
    if (versionEl && changelogData.length > 0) {
        versionEl.textContent = changelogData[0].version;
    }

    // Render HTML untuk Modal Changelog & Catatan Bug Internal
    const changelogList = document.getElementById("changelogList");
    if (changelogList) {
        changelogList.innerHTML = changelogData.map(item => `
            <div class="border-2 border-black dark:border-white rounded-xl p-4 bg-gray-50 dark:bg-zinc-800 shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff]">
                <div class="flex items-center justify-between mb-2">
                    <span class="px-2.5 py-0.5 bg-yellow-300 text-black font-black text-xs border border-black rounded">${item.version}</span>
                    <span class="text-xs font-bold text-gray-500 dark:text-gray-400">${item.date}</span>
                </div>
                
                <!-- Daftar Fitur -->
                <div class="mt-2">
                    <p class="text-xs font-black uppercase text-black dark:text-white mb-1">✨ Fitur & Pembaruan:</p>
                    <ul class="list-disc list-inside text-xs font-medium space-y-1 text-gray-700 dark:text-gray-300">
                        ${item.features.map(f => `<li>${f}</li>`).join('')}
                    </ul>
                </div>

                <!-- Catatan Bug (Khusus Developer) -->
                ${item.bugs && item.bugs.length > 0 ? `
                <div class="mt-3 pt-2 border-t border-dashed border-black dark:border-white">
                    <p class="text-xs font-black uppercase text-red-600 dark:text-red-400 mb-1">🛠️ Catatan Bug (Internal Dev):</p>
                    <ul class="list-disc list-inside text-xs font-medium space-y-1 text-red-500 dark:text-red-300">
                        ${item.bugs.map(b => `<li>${b}</li>`).join('')}
                    </ul>
                </div>` : ''}
            </div>
        `).join('');
    }
});