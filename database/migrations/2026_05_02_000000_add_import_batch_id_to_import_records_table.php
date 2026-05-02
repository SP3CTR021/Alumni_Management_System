<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('import_records', function (Blueprint $table) {
            if (!Schema::hasColumn('import_records', 'import_batch_id')) {
                $table->foreignId('import_batch_id')
                      ->after('id')
                      ->constrained('import_batches')
                      ->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('import_records', function (Blueprint $table) {
            if (Schema::hasColumn('import_records', 'import_batch_id')) {
                $table->dropForeign(['import_batch_id']);
                $table->dropColumn('import_batch_id');
            }
        });
    }
};
