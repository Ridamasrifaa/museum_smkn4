<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Services\MuseumCache;

class PublicController extends Controller
{
    public function index()
    {
        $projects = MuseumCache::remember('karya', 'beranda', function () {
            return Project::with(['user'])
                ->where('status', 'approved')
                ->latest()
                ->get();
        });

        $totalKarya = MuseumCache::remember('stat', 'totalKarya', function () {
            return Project::where('status', 'approved')->count();
        });

        $totalSiswa = MuseumCache::remember('stat', 'totalSiswa', function () {
            return User::where('role', 2)->count();
        });

        $totalAdmin = MuseumCache::remember('stat', 'totalAdmin', function () {
            return User::where('role', 1)->count();
        });

        return view('index', compact(
            'projects',
            'totalKarya',
            'totalSiswa',
            'totalAdmin'
        ));
    }
}