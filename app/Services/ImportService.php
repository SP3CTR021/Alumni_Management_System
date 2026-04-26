<?php

namespace App\Services;

use App\Models\ImportBatch;
use App\Models\ImportRecord;

class ImportService
{
    // Flag reasons — hardcoded array, no table needed
    private $flagReasons = [
        'incomplete_units'    => 'Incomplete units',
        'unpaid_fees'         => 'Unpaid fees / balance',
        'missing_requirements'=> 'Missing requirements',
        'pending_clearance'   => 'Pending clearance',
    ];

    public function run()
    {
        // For demo: use fake student data
        // In real system, this would pull from school DB
        $fakeStudents = $this->getFakeStudents();

        // Create a new import batch for this school year
        $batch = ImportBatch::create([
            'batch_year' => now()->year,
            'status'     => 'pending',
        ]);

        foreach ($fakeStudents as $student) {
            $flagReasons = $this->checkFlags($student);

            ImportRecord::create([
                'import_batch_id' => $batch->id,
                'name'            => $student['name'],
                'email'           => $student['email'],
                'student_id'      => $student['student_id'],
                'course'          => $student['course'],
                'batch_year'      => $student['batch_year'],
                'department'      => $student['department'],
                'flag_status'     => empty($flagReasons) ? 'cleared' : 'flagged',
                'flag_reasons'    => empty($flagReasons) ? null : $flagReasons,
            ]);
        }

        return $batch;
    }

    // Check if a student has any flags — returns array of flag reason strings
    private function checkFlags(array $student): array
    {
        $reasons = [];

        if (!empty($student['has_incomplete_units'])) {
            $reasons[] = $this->flagReasons['incomplete_units'];
        }
        if (!empty($student['has_unpaid_fees'])) {
            $reasons[] = $this->flagReasons['unpaid_fees'];
        }
        if (!empty($student['has_missing_requirements'])) {
            $reasons[] = $this->flagReasons['missing_requirements'];
        }
        if (!empty($student['has_pending_clearance'])) {
            $reasons[] = $this->flagReasons['pending_clearance'];
        }

        return $reasons;
    }

    // Fake student data for demo/testing
    private function getFakeStudents(): array
    {
        return [
            ['name' => 'Liza Magtibay',  'email' => 'liza@school.edu.ph',  'student_id' => '2025-001', 'course' => 'BSIT', 'batch_year' => '2025', 'department' => 'CCS', 'has_incomplete_units' => false, 'has_unpaid_fees' => false, 'has_missing_requirements' => false, 'has_pending_clearance' => false],
            ['name' => 'Carlo Mendoza',  'email' => 'carlo@school.edu.ph', 'student_id' => '2025-002', 'course' => 'BSCS', 'batch_year' => '2025', 'department' => 'CCS', 'has_incomplete_units' => false, 'has_unpaid_fees' => false, 'has_missing_requirements' => false, 'has_pending_clearance' => false],
            ['name' => 'Ana Gomez',      'email' => 'ana@school.edu.ph',   'student_id' => '2025-003', 'course' => 'BSBA', 'batch_year' => '2025', 'department' => 'COB', 'has_incomplete_units' => false, 'has_unpaid_fees' => true,  'has_missing_requirements' => false, 'has_pending_clearance' => false],
            ['name' => 'Pedro Reyes',    'email' => 'pedro@school.edu.ph', 'student_id' => '2025-004', 'course' => 'BSIT', 'batch_year' => '2025', 'department' => 'CCS', 'has_incomplete_units' => true,  'has_unpaid_fees' => false, 'has_missing_requirements' => false, 'has_pending_clearance' => false],
        ];
    }
}