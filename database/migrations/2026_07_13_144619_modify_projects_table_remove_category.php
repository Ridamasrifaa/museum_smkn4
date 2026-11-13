<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('projects', 'category_id')) {
            try {
                Schema::table('projects', function (Blueprint $table) {
                    $table->dropForeign(['category_id']);
                });
            } catch (\Throwable $e) {
                // ignore (sqlite / already dropped)
            }

            try {
                Schema::table('projects', function (Blueprint $table) {
                    $table->dropIndex('projects_category_id_index');
                });
            } catch (\Throwable $e) {
                // ignore
            }

            Schema::table('projects', function (Blueprint $table) {
                $table->dropColumn('category_id');
                $table->string('jurusan')->nullable()->after('description');
            });
        } elseif (!Schema::hasColumn('projects', 'jurusan')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->string('jurusan')->nullable()->after('description');
            });
        }
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {

            $table->foreignId('category_id')->constrained('categories');

            $table->dropColumn('jurusan');
        });
    }
};