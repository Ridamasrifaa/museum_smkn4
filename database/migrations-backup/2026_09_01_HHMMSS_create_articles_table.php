<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Check if the table already exists before creating it
        if (!Schema::hasTable('articles')) {
            Schema::create('articles', function (Blueprint $table) {
                $table->id();

                $table->foreignId('author_id')
                    ->constrained('users')
                    ->cascadeOnDelete();

                $table->foreignId('category_id')
                    ->constrained('categories')
                    ->restrictOnDelete();

                $table->string('title');
                $table->string('slug')->unique();
                $table->text('excerpt');
                $table->longText('content');
                $table->string('cover');

                $table->enum('status', ['draft', 'published'])->default('draft');
                $table->boolean('is_featured')->default(false);
                $table->unsignedInteger('views')->default(0);
                $table->timestamp('published_at')->nullable();

                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
