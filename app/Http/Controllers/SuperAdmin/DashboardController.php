<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
use App\Models\InvitationCode;

class DashboardController extends Controller
{
    public function index()
    {
        // ================= RINGKASAN / TOTAL DATA =================
        $totalKarya    = Project::count();
        $totalSiswa    = User::where('role', 2)->count();
        $totalKodeUnik = InvitationCode::count();

        // ================= KARYA TERBARU DARI SISWA =================
        $karyaTerbaru = Project::with(['user', 'reviewer'])
            ->latest()
            ->take(5)
            ->get();

        // ================= DAFTAR ADMIN & AKTIVITASNYA =================
        $daftarAdmin = User::where('role', 1)
            ->withCount('reviewedProjects')
            ->latest()
            ->take(10)
            ->get();

        // ================= KARYA PER JURUSAN (buat donut chart) =================
        $karyaPerJurusan = Project::selectRaw('jurusan, count(*) as total')
            ->groupBy('jurusan')
            ->orderByDesc('total')
            ->get();

        // jurusan yang paling banyak ngirim karya
        $jurusanTerbanyak = $karyaPerJurusan->first();

        return view('superadmin.dashboard', compact(
            'totalKarya',
            'totalSiswa',
            'totalKodeUnik',
            'karyaTerbaru',
            'daftarAdmin',
            'karyaPerJurusan',
            'jurusanTerbanyak'
        ));
    }
}