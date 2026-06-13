<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PendaftaranLanjutan2Controller extends Controller
{
    // === PAKET POLI ===
    public function createPaketPoli(Request $request)
    {
        $no_mr = $request->input('no_mr');
        $patient = null;
        if ($no_mr) {
            $patient = DB::table('mt_master_pasien')->where('no_mr', $no_mr)->first();
        }

        $bagian = DB::table('mt_bagian')->where('nama_bagian', 'like', '%paket%')->get();
        if($bagian->isEmpty()){
            // fallback
            $bagian = DB::table('mt_bagian')->where('pelayanan', 1)->get();
        }
        
        $dokter = DB::table('mt_karyawan')
            ->whereNotNull('kode_dokter')
            ->where('kode_dokter', '<>', 0)
            ->get();

        return Inertia::render('Registrasi/PaketPoli', [
            'patient' => $patient,
            'bagian' => $bagian,
            'dokter' => $dokter
        ]);
    }

    public function storePaketPoli(Request $request)
    {
        $request->validate([
            'no_mr' => 'required',
            'kode_bagian' => 'required',
            'kode_dokter' => 'required',
            'tgl_masuk' => 'required|date'
        ]);

        try {
            DB::beginTransaction();

            $no_mr = $request->no_mr;
            $kode_bagian = $request->kode_bagian;
            $kode_dokter = $request->kode_dokter;
            $tgl_masuk = Carbon::parse($request->tgl_masuk)->format('Y-m-d H:i:s');
            
            $patient = DB::table('mt_master_pasien')->where('no_mr', $no_mr)->first();
            
            // Generate no_registrasi
            $datePart = Carbon::parse($tgl_masuk)->format('ymd');
            $day = Carbon::parse($tgl_masuk)->format('d');
            $month = Carbon::parse($tgl_masuk)->format('m');
            $year = Carbon::parse($tgl_masuk)->format('Y');

            $maxNoUrut = DB::table('tc_registrasi')
                ->whereRaw('DAY(tgl_jam_masuk) = ? AND MONTH(tgl_jam_masuk) = ? AND YEAR(tgl_jam_masuk) = ?', [$day, $month, $year])
                ->max('no_urut');
            
            $no_urut = $maxNoUrut ? $maxNoUrut + 1 : 1;
            $no_urut_str = str_pad($no_urut, 3, '0', STR_PAD_LEFT);
            $no_registrasi = $datePart . $no_urut_str;

            // tc_registrasi
            DB::table('tc_registrasi')->insert([
                'no_registrasi' => $no_registrasi,
                'no_registrasi_old' => 1,
                'no_mr' => $no_mr,
                'kode_perusahaan' => $patient->kode_perusahaan ?? 0,
                'kode_kelompok' => $patient->kode_kelompok ?? 0,
                'kode_dokter' => $kode_dokter,
                'no_induk' => session('no_induk', '0'),
                'tgl_jam_masuk' => $tgl_masuk,
                'prioritas' => $request->prioritas ?? '',
                'kode_bagian_masuk' => $kode_bagian,
                'stat_pasien' => $request->stat_pasien ?? 'Lama',
                'flag_daftar' => 0,
                'no_urut' => $no_urut,
                'status_milik' => 0,
                'kode_penanggung' => 0,
                'no_jaminan' => $request->no_jaminan ?? ''
            ]);

            // tc_kunjungan
            $maxNoKunjungan = DB::table('tc_kunjungan')->max('no_kunjungan');
            $no_kunjungan = $maxNoKunjungan ? $maxNoKunjungan + 1 : 1;

            DB::table('tc_kunjungan')->insert([
                'no_kunjungan' => $no_kunjungan,
                'no_registrasi' => $no_registrasi,
                'no_registrasi_old' => 1,
                'no_mr' => $no_mr,
                'kode_dokter' => $kode_dokter,
                'kode_bagian_tujuan' => $kode_bagian,
                'kode_bagian_asal' => $kode_bagian,
                'tgl_masuk' => $tgl_masuk,
                'status_masuk' => 0,
                'status_cito' => $request->status_cito ?? 0,
                'keterangan' => $request->keterangan ?? ''
            ]);

            // pl_tc_poli
            $maxKodePoli = DB::table('pl_tc_poli')->max('kode_poli');
            $kode_poli = $maxKodePoli ? $maxKodePoli + 1 : 1;

            $maxNoAntrian = DB::table('pl_tc_poli')
                ->whereRaw('YEAR(tgl_jam_poli) = ? AND MONTH(tgl_jam_poli) = ? AND DAY(tgl_jam_poli) = ? AND kode_bagian = ? AND kode_dokter = ?', 
                    [$year, $month, $day, $kode_bagian, $kode_dokter])
                ->max('no_antrian');
            $no_antrian = $maxNoAntrian ? $maxNoAntrian + 1 : 1;

            DB::table('pl_tc_poli')->insert([
                'kode_poli' => $kode_poli,
                'no_kunjungan' => $no_kunjungan,
                'kode_bagian' => $kode_bagian,
                'tgl_jam_poli' => $tgl_masuk,
                'kode_dokter' => $kode_dokter,
                'no_antrian' => $no_antrian,
                'no_induk' => session('no_induk', '0')
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Pendaftaran Paket Poli Berhasil. No Antrian: ' . $no_antrian);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Gagal mendaftar: ' . $e->getMessage()]);
        }
    }

    // === MCU ===
    public function createMcu(Request $request)
    {
        $no_mr = $request->input('no_mr');
        $patient = null;
        if ($no_mr) {
            $patient = DB::table('mt_master_pasien')->where('no_mr', $no_mr)->first();
        }

        $bagian = DB::table('mt_bagian')->where('nama_bagian', 'like', '%MCU%')->orWhere('nama_bagian', 'like', '%Medical Check%')->get();
        if($bagian->isEmpty()){
            // fallback
            $bagian = DB::table('mt_bagian')->where('pelayanan', 1)->get();
        }
        
        $dokter = DB::table('mt_karyawan')
            ->whereNotNull('kode_dokter')
            ->where('kode_dokter', '<>', 0)
            ->get();

        return Inertia::render('Registrasi/Mcu', [
            'patient' => $patient,
            'bagian' => $bagian,
            'dokter' => $dokter
        ]);
    }

    public function storeMcu(Request $request)
    {
        $request->validate([
            'no_mr' => 'required',
            'kode_bagian' => 'required',
            'kode_dokter' => 'required',
            'tgl_masuk' => 'required|date'
        ]);

        try {
            DB::beginTransaction();

            $no_mr = $request->no_mr;
            $kode_bagian = $request->kode_bagian;
            $kode_dokter = $request->kode_dokter;
            $tgl_masuk = Carbon::parse($request->tgl_masuk)->format('Y-m-d H:i:s');
            
            $patient = DB::table('mt_master_pasien')->where('no_mr', $no_mr)->first();
            
            // Generate no_registrasi
            $datePart = Carbon::parse($tgl_masuk)->format('ymd');
            $day = Carbon::parse($tgl_masuk)->format('d');
            $month = Carbon::parse($tgl_masuk)->format('m');
            $year = Carbon::parse($tgl_masuk)->format('Y');

            $maxNoUrut = DB::table('tc_registrasi')
                ->whereRaw('DAY(tgl_jam_masuk) = ? AND MONTH(tgl_jam_masuk) = ? AND YEAR(tgl_jam_masuk) = ?', [$day, $month, $year])
                ->max('no_urut');
            
            $no_urut = $maxNoUrut ? $maxNoUrut + 1 : 1;
            $no_urut_str = str_pad($no_urut, 3, '0', STR_PAD_LEFT);
            $no_registrasi = $datePart . $no_urut_str;

            // tc_registrasi
            DB::table('tc_registrasi')->insert([
                'no_registrasi' => $no_registrasi,
                'no_registrasi_old' => 1,
                'no_mr' => $no_mr,
                'kode_perusahaan' => $patient->kode_perusahaan ?? 0,
                'kode_kelompok' => $patient->kode_kelompok ?? 0,
                'kode_dokter' => $kode_dokter,
                'no_induk' => session('no_induk', '0'),
                'tgl_jam_masuk' => $tgl_masuk,
                'prioritas' => $request->prioritas ?? '',
                'kode_bagian_masuk' => $kode_bagian,
                'stat_pasien' => $request->stat_pasien ?? 'Lama',
                'flag_daftar' => 0,
                'no_urut' => $no_urut,
                'status_milik' => 0,
                'kode_penanggung' => 0,
                'no_jaminan' => $request->no_jaminan ?? ''
            ]);

            // tc_kunjungan
            $maxNoKunjungan = DB::table('tc_kunjungan')->max('no_kunjungan');
            $no_kunjungan = $maxNoKunjungan ? $maxNoKunjungan + 1 : 1;

            DB::table('tc_kunjungan')->insert([
                'no_kunjungan' => $no_kunjungan,
                'no_registrasi' => $no_registrasi,
                'no_registrasi_old' => 1,
                'no_mr' => $no_mr,
                'kode_dokter' => $kode_dokter,
                'kode_bagian_tujuan' => $kode_bagian,
                'kode_bagian_asal' => $kode_bagian,
                'tgl_masuk' => $tgl_masuk,
                'status_masuk' => 0,
                'status_cito' => $request->status_cito ?? 0,
                'keterangan' => $request->keterangan ?? ''
            ]);

            // pl_tc_poli
            $maxKodePoli = DB::table('pl_tc_poli')->max('kode_poli');
            $kode_poli = $maxKodePoli ? $maxKodePoli + 1 : 1;

            $maxNoAntrian = DB::table('pl_tc_poli')
                ->whereRaw('YEAR(tgl_jam_poli) = ? AND MONTH(tgl_jam_poli) = ? AND DAY(tgl_jam_poli) = ? AND kode_bagian = ? AND kode_dokter = ?', 
                    [$year, $month, $day, $kode_bagian, $kode_dokter])
                ->max('no_antrian');
            $no_antrian = $maxNoAntrian ? $maxNoAntrian + 1 : 1;

            DB::table('pl_tc_poli')->insert([
                'kode_poli' => $kode_poli,
                'no_kunjungan' => $no_kunjungan,
                'kode_bagian' => $kode_bagian,
                'tgl_jam_poli' => $tgl_masuk,
                'kode_dokter' => $kode_dokter,
                'no_antrian' => $no_antrian,
                'no_induk' => session('no_induk', '0')
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Pendaftaran Medical Check Up Berhasil. No Antrian: ' . $no_antrian);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Gagal mendaftar: ' . $e->getMessage()]);
        }
    }
}
