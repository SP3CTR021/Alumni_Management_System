<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportRecord extends Model
{
    protected $fillable = [
        'import_batch_id', 'name', 'email', 'student_id',
        'course', 'batch_year', 'department', 'flag_status', 'flag_reasons',
    ];

    protected $casts = [
        'flag_reasons' => 'array', // automatically converts JSON to array
    ];

    public function batch()
    {
        return $this->belongsTo(ImportBatch::class, 'import_batch_id');
    }
}