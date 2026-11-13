<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\MuseumCache;

class AdminSiswaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $admin = Auth::user();

        $query = User::where('role', 2)
            ->with('invitationCode')
            ->when(!$admin->isSuperAdmin() && $admin->jurusan, function ($q) use ($admin) {
                $q->where('jurusan', $admin->jurusan);
            })
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('kelas', 'like', "%$search%");
                });
            });

        $totalSiswa = (clone $query)->count();

        $siswas = $query->latest()
            ->simplePaginate(10)
            ->withQueryString();

        return view('admin.siswa', compact('siswas', 'totalSiswa'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'kelas' => 'required',
            'email' => 'required|email',
        ]);

        $user->update([
            'name' => $request->name,
            'kelas' => $request->kelas,
            'email' => $request->email,
        ]);

        MuseumCache::flush('stat');

        return back()->with('success','Data siswa berhasil diubah.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        MuseumCache::flush('stat');

        return back()->with('success','Data siswa berhasil dihapus.');
    }
}