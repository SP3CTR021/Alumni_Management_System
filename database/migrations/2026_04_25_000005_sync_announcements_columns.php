<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('announcements')) {
            return;
        }

        Schema::table('announcements', function (Blueprint $table) {
            if (!Schema::hasColumn('announcements', 'title')) {
                $table->string('title')->nullable();
            }

            if (!Schema::hasColumn('announcements', 'body')) {
                $table->text('body')->nullable();
            }

            if (!Schema::hasColumn('announcements', 'category')) {
                $table->enum('category', ['news', 'job', 'scholarship', 'notice'])->default('news');
            }

            if (!Schema::hasColumn('announcements', 'status')) {
                $table->enum('status', ['draft', 'published'])->default('draft');
            }

            if (!Schema::hasColumn('announcements', 'published_at')) {
                $table->timestamp('published_at')->nullable();
            }

            if (!Schema::hasColumn('announcements', 'created_by')) {
                $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
    }
};
