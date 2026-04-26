<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportBatch extends Model
{
    protected $fillable = ['batch_year', 'status', 'confirmed_by', 'confirmed_at'];

    public function records()
    {
        return $this->hasMany(ImportRecord::class);
    }

    public function confirmedBy()
    {
        return $this->belongsTo(User::class, 'confirmed_by');
    }

    public function clearedRecords()
    {
        return $this->hasMany(ImportRecord::class)->where('flag_status', 'cleared');
    }

    public function flaggedRecords()
    {
        return $this->hasMany(ImportRecord::class)->where('flag_status', 'flagged');
    }
}