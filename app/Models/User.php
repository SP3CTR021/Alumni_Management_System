<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role', 'status'];

    protected $hidden = ['password', 'remember_token'];

    // Simple role helpers
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isAlumni()
    {
        return $this->role === 'alumni';
    }

    public function isRegistrar()
    {
        return $this->role === 'registrar';
    }

    public function isActive()
    {
        return $this->status === 'active';
    }

    // Relationships
    public function alumniProfile()
    {
        return $this->hasOne(AlumniProfile::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_rsvps')->withPivot('status')->withTimestamps();
    }
}