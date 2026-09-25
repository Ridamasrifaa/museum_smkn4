function openChangelogModal() {
    const modal = document.getElementById("changelogModal");
    modal.classList.remove("opacity-0", "pointer-events-none");
    document.getElementById("changelogContent").classList.remove("scale-95");
    document.getElementById("changelogContent").classList.add("scale-100");
}
function closeChangelogModal() {
    const modal = document.getElementById("changelogModal");
    document.getElementById("changelogContent").classList.remove("scale-100");
    document.getElementById("changelogContent").classList.add("scale-95");
    modal.classList.add("opacity-0", "pointer-events-none");
}
window.addEventListener("click", function (e) {
    if (e.target.id === "changelogModal") closeChangelogModal();
});
document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") closeChangelogModal();
});

document.addEventListener("DOMContentLoaded", function () {
    // Data Riwayat Update (Tanpa Catatan Bug Internal)
    const changelogData = [
        {
            version: "v1.0",
            date: "25 September 2026",
            features: [
                "Merilis platform awal Museum Karya SMKN 4 Tasikmalaya",
                "Menambahkan menu Beranda, Karya, Artikel, dan Tentang",
                "Integrasi mode tema Terang/Gelap (Dark/Light mode)",
            ],
            bugs: [
                "Memperbaiki error saat pertama kali tombol dark mode ditekan",
                "Membersihkan console log yang tidak terpakai pada skrip utama",
                "Membersihkan semuanya",
            ],
        },
    ];

    // Set teks versi terbaru pada elemen HTML utama
    const versionEl = document.getElementById("app-version");
    if (versionEl && changelogData.length > 0) {
        versionEl.textContent = changelogData[0].version;
    }

    // Render HTML untuk Modal Changelog
    const changelogList = document.getElementById("changelogList");
    if (changelogList) {
        changelogList.innerHTML = changelogData
            .map(
                (item) => `
                    <div class="border-2 border-black dark:border-white rounded-xl p-4 bg-gray-50 dark:bg-zinc-800 shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff]">
                        <div class="flex items-center justify-between mb-2">
                            <span class="px-2.5 py-0.5 bg-yellow-300 text-black font-black text-xs border border-black rounded">${item.version}</span>
                            <span class="text-xs font-bold text-gray-500 dark:text-gray-400">${item.date}</span>
                        </div>
                        
                        <!-- Daftar Fitur -->
                        <div class="mt-2">
                            <p class="text-xs font-black uppercase text-black dark:text-white mb-1">✨ Fitur & Pembaruan:</p>
                            <ul class="list-disc list-inside text-xs font-medium space-y-1 text-gray-700 dark:text-gray-300">
                                ${item.features.map((f) => `<li>${f}</li>`).join("")}
                            </ul>
                        </div>
                    </div>
                `,
            )
            .join("");
    }
});
