<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('import_records', function (Blueprint $table) {
            if (!Schema::hasColumn('import_records', 'name')) {
                $table->string('name')->after('import_batch_id');
            }
            if (!Schema::hasColumn('import_records', 'email')) {
                $table->string('email')->after('name');
            }
            if (!Schema::hasColumn('import_records', 'student_id')) {
                $table->string('student_id')->nullable()->after('email');
            }
            if (!Schema::hasColumn('import_records', 'course')) {
                $table->string('course')->nullable()->after('student_id');
            }
            if (!Schema::hasColumn('import_records', 'batch_year')) {
                $table->string('batch_year')->nullable()->after('course');
            }
            if (!Schema::hasColumn('import_records', 'department')) {
                $table->string('department')->nullable()->after('batch_year');
            }
            if (!Schema::hasColumn('import_records', 'flag_status')) {
                $table->enum('flag_status', ['cleared', 'flagged'])->default('cleared')->after('department');
            }
            if (!Schema::hasColumn('import_records', 'flag_reasons')) {
                $table->json('flag_reasons')->nullable()->after('flag_status');
            }
        });
    }

    public function down(): void
    {
        Schema::table('import_records', function (Blueprint $table) {
            if (Schema::hasColumn('import_records', 'name')) {
                $table->dropColumn('name');
            }
            if (Schema::hasColumn('import_records', 'email')) {
                $table->dropColumn('email');
            }
            if (Schema::hasColumn('import_records', 'student_id')) {
                $table->dropColumn('student_id');
            }
            if (Schema::hasColumn('import_records', 'course')) {
                $table->dropColumn('course');
            }
            if (Schema::hasColumn('import_records', 'batch_year')) {
                $table->dropColumn('batch_year');
            }
            if (Schema::hasColumn('import_records', 'department')) {
                $table->dropColumn('department');
            }
            if (Schema::hasColumn('import_records', 'flag_status')) {
                $table->dropColumn('flag_status');
            }
            if (Schema::hasColumn('import_records', 'flag_reasons')) {
                $table->dropColumn('flag_reasons');
            }
        });
    }
};
