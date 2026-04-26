<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('events')) {
            return;
        }

        Schema::table('events', function (Blueprint $table) {
            if (!Schema::hasColumn('events', 'title')) {
                $table->string('title')->nullable();
            }

            if (!Schema::hasColumn('events', 'description')) {
                $table->text('description')->nullable();
            }

            if (!Schema::hasColumn('events', 'venue')) {
                $table->string('venue')->nullable();
            }

            if (!Schema::hasColumn('events', 'event_date')) {
                $table->date('event_date')->nullable();
            }

            if (!Schema::hasColumn('events', 'start_time')) {
                $table->time('start_time')->nullable();
            }

            if (!Schema::hasColumn('events', 'max_slots')) {
                $table->integer('max_slots')->default(100);
            }

            if (!Schema::hasColumn('events', 'status')) {
                $table->enum('status', ['draft', 'published'])->default('draft');
            }

            if (!Schema::hasColumn('events', 'created_by')) {
                $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
    }
};
