<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('import_records')) {
            return;
        }

        Schema::create('import_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('import_batch_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('student_id')->nullable();
            $table->string('course')->nullable();
            $table->string('batch_year')->nullable();
            $table->string('department')->nullable();
            $table->enum('flag_status', ['cleared', 'flagged'])->default('cleared');
            $table->json('flag_reasons')->nullable(); // stores array of reasons
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('import_records');
    }
};
