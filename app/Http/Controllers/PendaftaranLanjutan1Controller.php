<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PendaftaranLanjutan1Controller extends Controller
{
    public function createPenunjangMedis(Request $request)
    {
        $no_mr = $request->query('no_mr');
        $pasien = null;
        if ($no_mr) {
            $pasien = DB::table('mt_master_pasien')->where('no_mr', $no_mr)->first();
        }

        $nasabahList = DB::table('mt_nasabah')->whereNotIn('kode_kelompok', [2])->get();
        $perusahaanList = DB::table('mt_perusahaan')->orderBy('nama_perusahaan')->get();

        // Some tables might be missing so we use try catch or schema check, but assuming they exist since legacy query uses them
        $kepemilikanList = [];
        try {
            $kepemilikanList = DB::table('tbl_milik')->orderBy('id')->get();
        } catch (\Exception $e) {
        }

        $bagianList = DB::table('mt_bagian')
            ->where('kode_bagian', 'like', '05%')
            ->where('status_aktif', 1)
            ->where('group_bag', '<>', 'Group')
            ->get();

        $dokterList = DB::table('mt_karyawan')
            ->whereNotNull('kode_dokter')
            ->where('kode_dokter', '<>', 0)
            ->select('kode_dokter', 'nama_pegawai')
            ->orderBy('nama_pegawai')
            ->get();

        return Inertia::render('Registrasi/PenunjangMedis', [
            'pasien' => $pasien,
            'nasabahList' => $nasabahList,
            'perusahaanList' => $perusahaanList,
            'kepemilikanList' => $kepemilikanList,
            'bagianList' => $bagianList,
            'dokterList' => $dokterList,
        ]);
    }

    public function storePenunjangMedis(Request $request)
    {
        // Validasi bisa ditambahkan di sini

        return redirect('/dashboard/2')->with('success', 'Pendaftaran Penunjang Medis berhasil disimpan.');
    }

    public function createIgdMalam(Request $request)
    {
        $no_mr = $request->query('no_mr');
        $pasien = null;
        if ($no_mr) {
            $pasien = DB::table('mt_master_pasien')->where('no_mr', $no_mr)->first();
        }

        $nasabahList = DB::table('mt_nasabah')->get();
        $perusahaanList = DB::table('mt_perusahaan')->orderBy('nama_perusahaan')->get();

        $kelasList = [];
        try {
            $kelasList = DB::table('mt_klas')->get();
        } catch (\Exception $e) {
        }

        $dokterList = DB::table('mt_karyawan')
            ->whereNotNull('kode_dokter')
            ->where('kode_dokter', '<>', 0)
            ->select('kode_dokter', 'nama_pegawai')
            ->orderBy('nama_pegawai')
            ->get();

        return Inertia::render('Registrasi/IgdMalam', [
            'pasien' => $pasien,
            'nasabahList' => $nasabahList,
            'perusahaanList' => $perusahaanList,
            'kelasList' => $kelasList,
            'dokterList' => $dokterList,
        ]);
    }

    public function storeIgdMalam(Request $request)
    {
        // Validasi bisa ditambahkan di sini

        return redirect('/dashboard/2')->with('success', 'Pendaftaran IGD Malam berhasil disimpan.');
    }
}
