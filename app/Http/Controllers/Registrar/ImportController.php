<?php

namespace App\Http\Controllers\Registrar;

use App\Http\Controllers\Controller;
use App\Models\ImportBatch;
use App\Models\User;
use App\Models\AlumniProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ImportController extends Controller
{
    public function index()
    {
        $batch = ImportBatch::where('status', 'pending')->latest()->first();
        return view('registrar.import.index', compact('batch'));
    }

    public function confirm(ImportBatch $batch)
    {
        // Create alumni accounts from all cleared records
        foreach ($batch->clearedRecords as $record) {
            $user = User::updateOrCreate(
                ['email' => $record->email],
                [
                    'name'     => $record->name,
                    'password' => Hash::make('password123'),
                    'role'     => 'alumni',
                    'status'   => 'dormant', // dormant until they activate
                ]
            );

            AlumniProfile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'student_id' => $record->student_id,
                    'course'     => $record->course,
                    'batch_year' => $record->batch_year,
                    'department' => $record->department,
                ]
            );
        }

        $batch->update([
            'status'       => 'confirmed',
            'confirmed_by' => Auth::id(),
            'confirmed_at' => now(),
        ]);

        return redirect()->route('registrar.import.index')->with('success', 'Import confirmed. Alumni accounts created.');
    }

    public function reject(ImportBatch $batch)
    {
        $batch->update(['status' => 'rejected']);
        return redirect()->route('registrar.import.index')->with('success', 'Import rejected and returned for correction.');
    }
}