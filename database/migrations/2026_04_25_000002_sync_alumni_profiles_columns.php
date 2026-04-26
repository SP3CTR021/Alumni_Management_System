<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('alumni_profiles')) {
            return;
        }

        Schema::table('alumni_profiles', function (Blueprint $table) {
            if (!Schema::hasColumn('alumni_profiles', 'user_id')) {
                $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            }

            if (!Schema::hasColumn('alumni_profiles', 'student_id')) {
                $table->string('student_id')->nullable();
            }

            if (!Schema::hasColumn('alumni_profiles', 'course')) {
                $table->string('course')->nullable();
            }

            if (!Schema::hasColumn('alumni_profiles', 'batch_year')) {
                $table->string('batch_year')->nullable();
            }

            if (!Schema::hasColumn('alumni_profiles', 'department')) {
                $table->string('department')->nullable();
            }

            if (!Schema::hasColumn('alumni_profiles', 'phone')) {
                $table->string('phone')->nullable();
            }

            if (!Schema::hasColumn('alumni_profiles', 'address')) {
                $table->string('address')->nullable();
            }

            if (!Schema::hasColumn('alumni_profiles', 'civil_status')) {
                $table->enum('civil_status', ['single', 'married', 'widowed', 'separated'])->nullable();
            }

            if (!Schema::hasColumn('alumni_profiles', 'sex')) {
                $table->enum('sex', ['male', 'female'])->nullable();
            }

            if (!Schema::hasColumn('alumni_profiles', 'employer')) {
                $table->string('employer')->nullable();
            }

            if (!Schema::hasColumn('alumni_profiles', 'job_title')) {
                $table->string('job_title')->nullable();
            }

            if (!Schema::hasColumn('alumni_profiles', 'industry')) {
                $table->string('industry')->nullable();
            }

            if (!Schema::hasColumn('alumni_profiles', 'employment_type')) {
                $table->string('employment_type')->nullable();
            }

            if (!Schema::hasColumn('alumni_profiles', 'linkedin')) {
                $table->string('linkedin')->nullable();
            }
        });
    }

    public function down(): void
    {
    }
};
