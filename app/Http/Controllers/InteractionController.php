<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectLike;
use Illuminate\Support\Facades\Auth;

class InteractionController extends Controller
{
    // Like / Unlike project. Boleh tamu maupun user login.
    public function toggleLike(Project $project)
    {
        $liked = Auth::check()
            ? $this->toggleForUser($project, Auth::id())
            : $this->toggleForGuest($project);

        return response()->json([
            'success'     => true,
            'liked'       => $liked,
            'likes_count' => $project->fresh()->likes_count,
        ]);
    }

    // User login: dicatat di tabel project_likes
    private function toggleForUser(Project $project, $userId): bool
    {
        $existingLike = ProjectLike::where('project_id', $project->id)
                                   ->where('user_id', $userId)
                                   ->first();

        if ($existingLike) {
            // Sudah dilike -> batalkan (Unlike)
            $existingLike->delete();
            $project->decrement('likes_count');
            return false;
        }

        ProjectLike::create([
            'project_id' => $project->id,
            'user_id'    => $userId,
        ]);
        $project->increment('likes_count');
        return true;
    }

    // Tamu: dicatat di session (daftar ID project yang sudah di-like)
    private function toggleForGuest(Project $project): bool
    {
        $ids = session('guest_likes', []);

        if (in_array($project->id, $ids)) {
            session(['guest_likes' => array_values(array_diff($ids, [$project->id]))]);
            $project->decrement('likes_count');
            return false;
        }

        session(['guest_likes' => [...$ids, $project->id]]);
        $project->increment('likes_count');
        return true;
    }
}