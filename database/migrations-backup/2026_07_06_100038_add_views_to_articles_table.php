<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // hanya jalan kalau tabel articles sudah ada DAN belum punya kolom views
        if (Schema::hasTable('articles') && !Schema::hasColumn('articles', 'views')) {
            Schema::table('articles', function (Blueprint $table) {
                $table->unsignedInteger('views')->default(0);
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('articles') && Schema::hasColumn('articles', 'views')) {
            Schema::table('articles', function (Blueprint $table) {
                $table->dropColumn('views');
            });
        }
    }
};