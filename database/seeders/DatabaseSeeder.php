<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\AlumniProfile;
use App\Models\Event;
use App\Models\Announcement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin account
        User::create([
            'name'     => 'Admin User',
            'email'    => 'admin@school.edu.ph',
            'password' => Hash::make('password'),
            'role'     => 'admin',
            'status'   => 'active',
        ]);

        // Registrar account
        User::create([
            'name'     => 'Registrar User',
            'email'    => 'registrar@school.edu.ph',
            'password' => Hash::make('password'),
            'role'     => 'registrar',
            'status'   => 'active',
        ]);

        // Sample alumni
        $alumni = User::create([
            'name'     => 'Juan Dela Cruz',
            'email'    => 'juan@school.edu.ph',
            'password' => Hash::make('password'),
            'role'     => 'alumni',
            'status'   => 'active',
        ]);
        AlumniProfile::create([
            'user_id'    => $alumni->id,
            'student_id' => '2024-0123',
            'course'     => 'BSIT',
            'batch_year' => '2024',
            'department' => 'CCS',
        ]);

        // Sample events
        Event::create([
            'title'      => 'Alumni Homecoming 2026',
            'description'=> 'Annual homecoming event for all batches.',
            'venue'      => 'University Gymnasium',
            'event_date' => '2026-06-15',
            'start_time' => '09:00',
            'max_slots'  => 200,
            'status'     => 'published',
            'created_by' => 1,
        ]);

        Event::create([
            'title'      => 'Career Fair & Networking Night',
            'description'=> 'Meet company partners and fellow alumni.',
            'venue'      => 'Covered Court',
            'event_date' => '2026-07-10',
            'start_time' => '13:00',
            'max_slots'  => 150,
            'status'     => 'published',
            'created_by' => 1,
        ]);

        // Sample announcements
        Announcement::create([
            'title'        => '2026 Grand Alumni Reunion Registration Open',
            'body'         => 'Registration for the Grand Alumni Reunion is now open. Slots are limited. Register early to secure your spot.',
            'category'     => 'news',
            'status'       => 'published',
            'published_at' => now(),
            'created_by'   => 1,
        ]);

        Announcement::create([
            'title'        => 'Hiring: Frontend Developer at TechCorp Davao',
            'body'         => 'TechCorp is looking for BSIT/BSCS graduates. 1-2 years experience. On-site, Davao City.',
            'category'     => 'job',
            'status'       => 'published',
            'published_at' => now(),
            'created_by'   => 1,
        ]);
    }
}