<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PasienBaruController extends Controller
{
    public function create()
    {
        return Inertia::render('Registrasi/PasienBaru');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pasien' => 'required|string|max:255',
            'no_ktp' => 'nullable|string|max:50',
            'tempat_lahir' => 'required|string|max:100',
            'tgl_lhr' => 'required|date',
            'almt_ttp_pasien' => 'required|string',
            'jen_kelamin' => 'required|string|in:L,P',
            'tlp_almt_ttp' => 'nullable|string|max:50',
            'kode_agama' => 'nullable|string|max:10',
            'nama_ibu' => 'nullable|string|max:255',
            'nama_ayah' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            // Get last no_mr
            $lastMr = DB::table('mt_master_pasien')->max('no_mr');
            $mrID = (int)$lastMr + 1;
            $mrIDFormatted = str_pad($mrID, 6, '0', STR_PAD_LEFT);

            $data = [
                'no_mr' => $mrIDFormatted,
                'no_urutan' => $mrIDFormatted,
                'nama_pasien' => strtoupper($validated['nama_pasien']),
                'no_ktp' => $validated['no_ktp'] ?? null,
                'tempat_lahir' => $validated['tempat_lahir'],
                'tgl_lhr' => $validated['tgl_lhr'],
                'almt_ttp_pasien' => $validated['almt_ttp_pasien'],
                'jen_kelamin' => $validated['jen_kelamin'],
                'tlp_almt_ttp' => $validated['tlp_almt_ttp'] ?? null,
                'kode_agama' => $validated['kode_agama'] ?? null,
                'nama_ibu' => isset($validated['nama_ibu']) ? strtoupper($validated['nama_ibu']) : null,
                'nama_ayah' => isset($validated['nama_ayah']) ? strtoupper($validated['nama_ayah']) : null,
                'tgl_input' => now(),
                'user_id' => auth()->user()->user_name ?? 'system',
            ];

            DB::table('mt_master_pasien')->insert($data);
            DB::commit();

            return redirect()->route('registrasi.pasien-baru')->with('success', 'Pasien baru berhasil didaftarkan dengan No. MR: ' . $mrIDFormatted);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mendaftar pasien: ' . $e->getMessage())->withInput();
        }
    }
}
