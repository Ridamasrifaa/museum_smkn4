<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('google_id')->nullable()->unique()->after('id');
            $table->string('kelas')->nullable()->after('avatar');
            $table->string('jurusan')->nullable()->after('kelas');
            $table->text('bio')->nullable()->after('jurusan'); // Mengganti angkatan jadi bio
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('role');
            $table->foreignId('invitation_code_id')->nullable()->after('status')
                  ->constrained('invitation_codes')->nullOnDelete();
            
            // Password boleh kosong (untuk Google Login)
            $table->string('password')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['invitation_code_id']);
            $table->dropColumn([
                'google_id',
                'kelas',
                'jurusan',
                'bio',
                'status',
                'invitation_code_id',
            ]);
            $table->string('password')->nullable(false)->change();
        });
    }
};