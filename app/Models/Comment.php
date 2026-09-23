<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'user_id',
        'parent_id',
        'body',
        'type',
        'attachment',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Project yang dikomentari
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Relasi untuk Komentar Utama ke Balasan-balasannya
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')->with('user')->oldest();
    }

    // Relasi ke Komentar Induk (jika ini adalah balasan)
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }
}