
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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            
            // Foreign Key ke users (siswa yang upload)
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');
            
            // Project details
            $table->string('title', 255);
            $table->longText('description');
            
            // Foreign Key ke categories
            $table->foreignId('category_id')
                ->constrained('categories')
                ->onDelete('restrict');
            
            // File information
            $table->string('file_path')->nullable();
            $table->string('file_type', 50)->nullable();
            $table->bigInteger('file_size')->nullable();
            
            // Additional info
            $table->string('guru_pengampu', 255)->nullable();
            $table->string('live_link', 255)->nullable();
            $table->string('github_link', 255)->nullable();
            $table->string('technology_stack', 255)->nullable();
            
            // Status & Review
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->longText('rejection_reason')->nullable();
            $table->longText('approval_note')->nullable();
            
            // Review by admin
            $table->foreignId('reviewed_by')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');
            
            $table->timestamp('reviewed_at')->nullable();
            
            // Counters
            $table->integer('views_count')->default(0);
            $table->integer('likes_count')->default(0);
            
            $table->timestamps();
            
            // Indexes untuk performa query
            $table->index('user_id');
            $table->index('category_id');
            $table->index('status');
            $table->index('guru_pengampu');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};