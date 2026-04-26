<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('event_rsvps')) {
            return;
        }

        Schema::table('event_rsvps', function (Blueprint $table) {
            if (!Schema::hasColumn('event_rsvps', 'event_id')) {
                $table->foreignId('event_id')->nullable()->constrained()->nullOnDelete();
            }

            if (!Schema::hasColumn('event_rsvps', 'user_id')) {
                $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            }

            if (!Schema::hasColumn('event_rsvps', 'status')) {
                $table->enum('status', ['confirmed', 'cancelled'])->default('confirmed');
            }
        });
    }

    public function down(): void
    {
    }
};
