<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            // Untuk fitur balas komentar (menyimpan id komentar induk)
            $table->foreignId('parent_id')->nullable()->constrained('comments')->onDelete('cascade');
            
            // Untuk menyimpan tipe gift atau stiker (misal: 'gift_coffee', 'sticker_fire', dll.)
            $table->string('type')->default('text'); // 'text', 'gift', atau 'sticker'
            $table->string('attachment')->nullable(); // Path atau nama file gift/stiker
        });
    }

    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropColumn(['parent_id', 'type', 'attachment']);
        });
    }
};