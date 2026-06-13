<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use Inertia\Inertia;

class PendaftaranLanjutan3Controller extends Controller
{
    public function createPendaftaranRi(Request $request)
    {
        // Mock data options for the form
        $patients = Patient::select('id', 'mr_number', 'name')->limit(50)->get();
        
        return Inertia::render('Registrasi/PendaftaranRi', [
            'patients' => $patients
        ]);
    }

    public function storePendaftaranRi(Request $request)
    {
        // Validate the request logic here if needed
        return redirect('/dashboard/2')->with('success', 'Pendaftaran Rawat Inap Berhasil Disimpan.');
    }

    public function editDataUmum(Request $request)
    {
        $patient = null;
        if ($request->has('mr_number')) {
            $patient = Patient::where('mr_number', $request->input('mr_number'))->first();
        }
        
        if (!$patient) {
            $patient = Patient::first();
        }

        return Inertia::render('Registrasi/EditDataUmum', [
            'patient' => $patient
        ]);
    }

    public function updateDataUmum(Request $request)
    {
        // Update patient logic here
        return redirect('/dashboard/2')->with('success', 'Data Umum Berhasil Diupdate.');
    }
}
