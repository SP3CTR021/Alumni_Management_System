<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title', 'description', 'venue', 'event_date',
        'start_time', 'max_slots', 'status', 'created_by',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function attendees()
    {
        return $this->belongsToMany(User::class, 'event_rsvps')->withPivot('status')->withTimestamps();
    }

    // Count only confirmed RSVPs
    public function confirmedRsvps()
    {
        return $this->belongsToMany(User::class, 'event_rsvps')
                    ->wherePivot('status', 'confirmed');
    }
}