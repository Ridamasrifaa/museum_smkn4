// Loading Screen Timer - Langsung hilangkan setelah page selesai load
window.addEventListener("load", function () {
    const loadingContent = document.getElementById("loading-content");
    if (loadingContent) {
        loadingContent.classList.add("opacity-0");
        setTimeout(() => {
            loadingContent.classList.add("hidden");
        }, 200); // 200ms hanya untuk animasi fade-out yang mulus
    }
});

// Modal Controller Logika Backend
function openSiswaModal(element) {
    const modal = document.getElementById("siswa-modal");
    const form = document.getElementById("modal-form");

    const id = element.getAttribute("data-id");
    const nama = element.getAttribute("data-nama");
    const kelas = element.getAttribute("data-kelas");
    const email = element.getAttribute("data-email");

    form.action = `/admin/siswa/${id}/update`;

    document.getElementById("input-nama").value = nama;
    document.getElementById("input-kelas").value = kelas;
    document.getElementById("input-email").value = email;

    modal.classList.remove("hidden");
}

function closeSiswaModal() {
    document.getElementById("siswa-modal").classList.add("hidden");
}

// Logout Form Trigger
function handleLogout() {
    if (confirm("Anda yakin ingin logout?")) {
        document.getElementById("logout-form").submit();
    }
}