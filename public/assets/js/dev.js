// ===== MODAL PREVIEW FOTO PROFIL (AVATAR) =====
function openAvatarModal(imgSrc, devName) {
    const modal = document.getElementById('avatarModal');
    const modalImg = document.getElementById('modalImage');
    const modalName = document.getElementById('modalName');

    // Selalu gunakan foto bulat dan object-cover yang konsisten untuk semua modal
    modalImg.src = imgSrc;
    modalName.textContent = devName;

    // Tampilkan modal
    modal.classList.remove('opacity-0', 'pointer-events-none');
    document.getElementById('modalContent').classList.remove('scale-95');
    document.getElementById('modalContent').classList.add('scale-100');
}

function closeAvatarModal() {
    const modal = document.getElementById('avatarModal');
    if (modal) {
        document.getElementById('modalContent').classList.remove('scale-100');
        document.getElementById('modalContent').classList.add('scale-95');
        modal.classList.add('opacity-0', 'pointer-events-none');
    }
}

window.addEventListener('click', function(e) {
    if (e.target.id === 'avatarModal') closeAvatarModal();
});
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeAvatarModal();
});

// ===== RENDER DATA TIM PENGEMBANG =====
document.addEventListener("DOMContentLoaded", function () {
    const teamGrid = document.getElementById("team-grid");

    if (teamGrid) {
        const developers = [
            {
                name: "Rida Masrifa",
                kelas: "XII PPLG 1",
                roles: ["Backend Developer"],
                badgeBgs: ["bg-yellow-300"],
                img: "assets/img/rida.jpg",
                imgPosition: "object-[center_25%]",
                github: "https://github.com/Ridamasrifaa",
                portfolio: "#"
            },
            {
                name: "Salsa Cantika Indriyani",
                kelas: "XII PPLG 1",
                roles: ["Frontend Developer"],
                badgeBgs: ["bg-pink-300"],
                img: "assets/img/salsa.jpg",
                imgPosition: "object-[center_10%]",
                github: "https://github.com/salsacantika",
                portfolio: "#"
            },
            {
                name: "Zaki Nur Faizi",
                kelas: "XII PPLG 2",
                roles: ["Frontend Dev", "Backend Dev"],
                badgeBgs: ["bg-pink-300", "bg-emerald-300"],
                img: "assets/img/zaki.jpg",
                imgPosition: "object-[center_100%]",
                github: "https://github.com/faizinurzaki12",
                portfolio: "https://zackynurfazz.netlify.app"
            },
            {
                name: "Zahra Afifah Hifdillah",
                kelas: "XII PPLG 2",
                roles: ["Frontend Dev", "QA Tester"],
                badgeBgs: ["bg-emerald-300", "bg-yellow-300"],
                img: "assets/img/zahra.jpg",
                imgPosition: "object-[center_25%]",
                github: "https://github.com/zhraaaaa31",
                portfolio: "#"
            },
            {
                name: "All Raffi Ghani Iskandar",
                kelas: "XII PPLG 2",
                roles: ["Backend Developer"],
                badgeBgs: ["bg-orange-300"],
                img: "assets/img/all-Raffi.jpg",
                imgPosition: "object-[center_25%]",
                github: "https://github.com/alrafighani280-art",
                portfolio: "#"
            }
        ];

        // Layout grid: 3 di atas, 2 di bawah rata tengah
        teamGrid.className = "pt-8 pb-12 px-4 max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-8 justify-center [&>*:nth-child(-n+3)]:lg:col-span-2 [&>*:nth-child(4)]:lg:col-span-2 [&>*:nth-child(4)]:lg:col-start-2 [&>*:nth-last-child(1)]:lg:col-span-2 [&>*:nth-last-child(1)]:lg:col-start-4";

        teamGrid.innerHTML = developers.map((dev) => {
            let badgesHtml = dev.roles.map((role, idx) => `
                <span class="inline-block ${dev.badgeBgs[idx]} text-black border-2 border-black px-4 py-1.5 rounded-full text-xs font-black shadow-[2px_2px_0px_#000]">${role}</span>
            `).join('');

            return `
                <div class="p-6 flex flex-col items-center text-center">
                    <!-- Foto Profil Card: Konsisten bentuk bulat (rounded-full) & border tipis (border-2) -->
                    <div class="w-24 h-24 mx-auto rounded-full overflow-hidden bg-blue-600 flex items-center justify-center cursor-pointer hover:scale-105 transition-transform border-2 border-black dark:border-white shadow-[3px_3px_0px_#000] dark:shadow-[3px_3px_0px_#fff]"
                         onclick="openAvatarModal('${dev.img}', '${dev.name}')">
                        <img src="${dev.img}" alt="Foto ${dev.name}" class="w-full h-full object-cover ${dev.imgPosition} rounded-full" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" />
                        <div class="w-full h-full items-center justify-center text-white font-black text-xl hidden">
                            ${dev.name.split(" ").map(n => n[0]).slice(0,2).join('')}
                        </div>
                    </div>
                    
                    <h3 class="font-black text-lg sm:text-xl mt-4 uppercase">${dev.name}</h3>
                    <p class="text-xs sm:text-sm font-bold opacity-80 mt-0.5">${dev.kelas}</p>

                    <div class="flex flex-wrap justify-center gap-2 mt-3">
                        ${badgesHtml}
                    </div>

                    <div class="grid grid-cols-2 gap-3 mt-6 w-full">
                        <a href="${dev.github}" target="_blank" class="neop-btn-box flex items-center justify-center gap-2 py-2.5 rounded-xl text-xs font-black bg-black text-white dark:bg-zinc-800 dark:text-white hover:bg-zinc-800 transition">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 .5C5.73.5.98 5.24.98 11.5c0 4.84 3.14 8.94 7.5 10.39.55.1.75-.24.75-.53 0-.26-.01-1.13-.02-2.05-3.05.66-3.69-1.3-3.69-1.3-.5-1.26-1.22-1.6-1.22-1.6-.99-.68.08-.67.08-.67 1.1.08 1.68 1.13 1.68 1.13.98 1.68 2.57 1.2 3.2.92.1-.71.38-1.2.7-1.48-2.43-.28-4.99-1.22-4.99-5.4 0-1.19.42-2.17 1.12-2.93-.11-.28-.49-1.4.11-2.92 0 0 .92-.29 3 1.12a10.4 10.4 0 0 1 5.46 0c2.08-1.41 3-1.12 3-1.12.6 1.52.22 2.64.11 2.92.7.76 1.12 1.74 1.12 2.93 0 4.19-2.57 5.11-5.01 5.38.39.34.74 1.01.74 2.04 0 1.47-.01 2.66-.01 3.02 0 .29.2.64.76.53 4.35-1.45 7.49-5.55 7.49-10.39C23.02 5.24 18.27.5 12 .5Z"/>
                            </svg>
                            GitHub
                        </a>
                        <a href="${dev.portfolio}" target="_blank" class="neop-btn-box flex items-center justify-center gap-2 py-2.5 rounded-xl text-xs font-black bg-[#74B9FF] text-black hover:bg-sky-400 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13.5 6H18a2 2 0 012 2v9a2 2 0 01-2 2H6a2 2 0 01-2-2v-4.5M14 10l7-7m0 0h-5m5 0v5" />
                            </svg>
                            Portofolio
                        </a>
                    </div>
                </div>
            `;
        }).join('');
    }
});