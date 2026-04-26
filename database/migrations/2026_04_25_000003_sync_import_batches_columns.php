<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('import_batches')) {
            return;
        }

        Schema::table('import_batches', function (Blueprint $table) {
            if (!Schema::hasColumn('import_batches', 'batch_year')) {
                $table->string('batch_year')->nullable();
            }

            if (!Schema::hasColumn('import_batches', 'status')) {
                $table->enum('status', ['pending', 'confirmed', 'rejected'])->default('pending');
            }

            if (!Schema::hasColumn('import_batches', 'confirmed_by')) {
                $table->foreignId('confirmed_by')->nullable()->constrained('users')->nullOnDelete();
            }

            if (!Schema::hasColumn('import_batches', 'confirmed_at')) {
                $table->timestamp('confirmed_at')->nullable();
            }
        });
    }

    public function down(): void
    {
    }
};
