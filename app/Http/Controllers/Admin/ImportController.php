<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImportBatch;
use App\Models\ImportRecord;

class ImportController extends Controller
{
    
    public function index()
    {
        $batches = ImportBatch::latest()->get();
        return view('admin.import.index', compact('batches'));
    }

    // import service - ayuhon pa
    public function trigger()
    {
        $service = new \App\Services\ImportService();
        $service->run();

        return redirect()->route('admin.import.index')->with('success', 'Import scan completed.');
    }
}