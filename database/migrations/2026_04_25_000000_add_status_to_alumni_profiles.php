<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('alumni_profiles', function (Blueprint $table) {
            if (!Schema::hasColumn('alumni_profiles', 'status')) {
                $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            }

            if (!Schema::hasColumn('alumni_profiles', 'submitted_at')) {
                $table->timestamp('submitted_at')->nullable();
            }

            if (!Schema::hasColumn('alumni_profiles', 'reviewed_at')) {
                $table->timestamp('reviewed_at')->nullable();
            }

            if (!Schema::hasColumn('alumni_profiles', 'reviewed_by')) {
                $table->unsignedBigInteger('reviewed_by')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('alumni_profiles', function (Blueprint $table) {
            foreach (['reviewed_by', 'reviewed_at', 'submitted_at', 'status'] as $column) {
                if (Schema::hasColumn('alumni_profiles', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
