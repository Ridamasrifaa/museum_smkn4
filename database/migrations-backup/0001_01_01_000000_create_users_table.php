<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            // Database Migration
            // ROLE: 0 = Superadmin, 1 = Admin, 2 = Siswa
            $table->tinyInteger('role')->default(2);

            // Nomor WhatsApp siswa (diisi sendiri lewat halaman profil).
            // Nullable karena admin/superadmin tidak memakainya.
            $table->string('phone_number', 20)->nullable();

            $table->rememberToken();
            $table->timestamps();

            // Index untuk performa
            $table->index('email');
            $table->index('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};