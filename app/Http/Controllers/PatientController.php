<?php

namespace App\Http\Controllers;

use App\Models\Patient;

class PatientController extends Controller
{
    public function testConnection()
    {
        try {
            $totalPatients = Patient::count();
            $latestPatient = Patient::latest()->first();

            return view('test_db', [
                'total' => $totalPatients,
                'latest' => $latestPatient,
                'status' => 'Connected',
            ]);
        } catch (\Exception $e) {
            return view('test_db', [
                'status' => 'Error',
                'message' => $e->getMessage(),
            ]);
        }
    }
}
