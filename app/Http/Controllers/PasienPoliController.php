<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PasienPoliController extends Controller
{
    /**
     * Redirects to the default tab (Tindakan) for the patient.
     */
    public function show($kode_poli)
    {
        return redirect()->route('poli.pasien.tindakan', ['kode_poli' => $kode_poli]);
    }

    /**
     * Get patient header metadata
     */
    private function getPatientData($kode_poli)
    {
        // Try id_pl_tc_poli first, then fallback to kode_poli if it exists
        $pasien = DB::table('pl_mt_pasien_v')
            ->where('id_pl_tc_poli', $kode_poli)
            ->orWhere('kode_poli', $kode_poli)
            ->first();

        if (! $pasien) {
            abort(404, 'Data Pasien tidak ditemukan');
        }

        // Determine Nasabah/Penanggung
        $nm_nasabah = '';
        if ($pasien->kode_kelompok == 1) {
            $nasabah = DB::table('mt_nasabah')->where('kode_kelompok', $pasien->kode_kelompok)->first();
            $nm_nasabah = $nasabah ? $nasabah->nama_kelompok : '';
        } elseif (in_array($pasien->kode_kelompok, [3, 5, 11])) {
            $perusahaan = DB::table('mt_perusahaan')->where('kode_perusahaan', $pasien->kode_perusahaan)->first();
            $nm_nasabah = $perusahaan ? $perusahaan->nama_perusahaan : '';
            if ($pasien->kode_kelompok == 11) {
                $kelompok = DB::table('mt_nasabah')->where('kode_kelompok', 11)->first();
                $nm_nasabah = ($kelompok ? $kelompok->nama_kelompok.' ' : '').$nm_nasabah;
            }
        } else {
            $nasabah = DB::table('mt_nasabah')->where('kode_kelompok', $pasien->kode_kelompok)->first();
            $nm_nasabah = $nasabah ? $nasabah->nama_kelompok : '';
        }

        $nama_penanggung = '';
        if ($pasien->kode_penanggung && is_numeric($pasien->kode_penanggung) && $pasien->kode_penanggung > 0) {
            $penanggung = DB::table('mt_perusahaan')->where('kode_perusahaan', $pasien->kode_penanggung)->first();
            $nama_penanggung = $penanggung ? $penanggung->nama_perusahaan : '';
        }

        // Calculate age
        $umur = $pasien->tgl_lhr ? Carbon::parse($pasien->tgl_lhr)->age : 0;

        return [
            'kode_poli' => $kode_poli,
            'no_mr' => $pasien->no_mr,
            'no_registrasi' => $pasien->no_registrasi,
            'no_kunjungan' => $pasien->no_kunjungan,
            'nama_pasien' => $pasien->nama_pasien,
            'jen_kelamin' => $pasien->jen_kelamin,
            'umur' => $umur,
            'gol_darah' => $pasien->gol_darah,
            'nm_poli' => $pasien->nama_poli,
            'nama_dokter' => $pasien->nama_dokter,
            'kode_dokter' => $pasien->kode_dokter,
            'kode_bagian' => $pasien->kode_bagian ?? $pasien->kode_bagian_poli,
            'nm_nasabah' => $nm_nasabah.($nama_penanggung ? ' / '.$nama_penanggung : ''),
            'kode_kelompok' => $pasien->kode_kelompok,
            'kode_perusahaan' => $pasien->kode_perusahaan,
            'status_periksa' => $pasien->status_periksa,
        ];
    }

    /**
     * Show Tindakan Tab
     */
    public function tindakan($kode_poli)
    {
        $patient = $this->getPatientData($kode_poli);

        // Fetch Tindakan List
        $tindakanList = DB::table('tc_trans_pelayanan')
            ->where('no_kunjungan', $patient['no_kunjungan'])
            ->where('kode_bagian', 'like', '01%')
            ->where('status_selesai', '<>', 3)
            ->whereNotIn('jenis_tindakan', [9, 11])
            ->get();

        // Build Query for Master Tarif (Tingkatan 5 in mt_master_tarif or mt_tarif_v depending on kelompok)
        // Simplified mapping for the frontend dropdown
        $tarifQuery = DB::table('mt_tarif_v')
            ->where('kode_bagian', $patient['kode_bagian'])
            ->where('tingkatan', 5)
            ->orderBy('nama_tarif');

        $tarifData = $tarifQuery->get()->map(function ($item) use ($patient) {
            $total = $item->total;
            if ($patient['kode_kelompok'] == 3) {
                $total = ($patient['kode_perusahaan'] != '50') ? $item->total_ass : $item->total_inhealth;
            } elseif ($patient['kode_kelompok'] == 5) {
                $total = $item->total_pt;
            } elseif ($patient['kode_kelompok'] > 5) {
                $total = $item->total_bpjs;
            }

            return [
                'kode_tarif' => $item->kode_tarif,
                'nama_tarif' => $item->nama_tarif,
                'kode_tindakan' => $item->kode_tindakan,
                'total' => $total,
            ];
        });

        // Riwayat / Diagnosa info
        $riwayat = DB::table('th_riwayat_pasien')
            ->where('no_kunjungan', $patient['no_kunjungan'])
            ->select('diagnosa_akhir', 'pengobatan', 'kode_icd_diagnosa')
            ->first();

        // Paramedis (Perawat) List
        $paramedisList = DB::table('mt_karyawan')
            ->select('kode_paramedis', 'nama_pegawai')
            ->whereNotNull('flag_paramedis')
            ->where('kode_bagian', 'like', '01%')
            ->orderBy('nama_pegawai')
            ->get();

        return Inertia::render('Poli/Tabs/TindakanTab', [
            'patient' => $patient,
            'tindakanList' => $tindakanList,
            'tarifList' => $tarifData,
            'paramedisList' => $paramedisList,
            'riwayat' => $riwayat,
        ]);
    }

    /**
     * Store new Tindakan
     */
    public function storeTindakan(Request $request, $kode_poli)
    {
        $patient = $this->getPatientData($kode_poli);

        $kode_tarif = $request->input('kode_tarif');
        $jumlah = $request->input('jumlah', 1);

        if (! $kode_tarif) {
            return redirect()->back()->withErrors(['kode_tarif' => 'Pilih tindakan/tarif terlebih dahulu']);
        }

        $tarif = DB::table('mt_tarif_v')->where('kode_tarif', $kode_tarif)->first();
        if (! $tarif) {
            return redirect()->back()->withErrors(['kode_tarif' => 'Tarif tidak ditemukan']);
        }

        $kode_trans_pelayanan = DB::table('tc_trans_pelayanan')->max('kode_trans_pelayanan') + 1;

        // Tentukan tarif total berdasarkan jenis kelompok nasabah (Sederhana dari mt_tarif_v)
        $total = $tarif->total;
        $bill_dr1 = $tarif->bill_dr1;
        $bill_dr2 = $tarif->bill_dr2;

        if ($patient['kode_kelompok'] == 3) {
            $total = ($patient['kode_perusahaan'] != '50') ? $tarif->total_ass : $tarif->total_inhealth;
            $bill_dr1 = ($patient['kode_perusahaan'] != '50') ? $tarif->bill_dr1_ass : $tarif->bill_dr1_inhealth;
            $bill_dr2 = ($patient['kode_perusahaan'] != '50') ? $tarif->bill_dr2_ass : $tarif->bill_dr2_inhealth;
        } elseif ($patient['kode_kelompok'] == 5) {
            $total = $tarif->total_pt;
            $bill_dr1 = $tarif->bill_dr1_pt;
            $bill_dr2 = $tarif->bill_dr2_pt;
        } elseif ($patient['kode_kelompok'] > 5) {
            $total = $tarif->total_bpjs;
            $bill_dr1 = $tarif->bill_dr1_bpjs;
            $bill_dr2 = $tarif->bill_dr2_bpjs;
        }

        // Tentukan bill_rs, untuk simplifikasi kita mapping total - bill_dr1 - bill_dr2
        // karena dalam legacy bill_rs = (total atau Tarif ERP asli)
        // Di sini kita masukkan sesuai field masing-masing
        $bill_rs = ($total !== null && $total > 0 && $tarif->bill_rs == 0 && $tarif->bill_dr1 == 0) ? $total : $tarif->bill_rs;

        // Namun, jika menggunakan tarif BPJS, mt_tarif_v memiliki bill_rs_bpjs
        if ($patient['kode_kelompok'] > 5) {
            $bill_rs = $tarif->bill_rs_bpjs;
        } elseif ($patient['kode_kelompok'] == 5) {
            $bill_rs = $tarif->bill_rs_pt;
        } elseif ($patient['kode_kelompok'] == 3) {
            $bill_rs = ($patient['kode_perusahaan'] != '50') ? $tarif->bill_rs_ass : $tarif->bill_rs_inhealth;
        }

        DB::table('tc_trans_pelayanan')->insert([
            'kode_trans_pelayanan' => $kode_trans_pelayanan,
            'no_kunjungan' => $patient['no_kunjungan'],
            'no_registrasi' => $patient['no_registrasi'],
            'no_mr' => $patient['no_mr'],
            'kode_perusahaan' => $patient['kode_perusahaan'] ?: '0',
            'kode_kelompok' => $patient['kode_kelompok'],
            'tgl_transaksi' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
            'jenis_tindakan' => $tarif->jenis_tindakan ?? '2',
            'nama_tindakan' => $tarif->nama_tarif,
            'kode_dokter1' => $patient['kode_dokter'],
            'kode_bagian' => $patient['kode_bagian'] ?? '0100', // Default poli
            'kode_bagian_asal' => $patient['kode_bagian'] ?? '0100',
            'nama_pasien_layan' => $patient['nama_pasien'],
            'kode_tarif' => $kode_tarif,
            'kode_klas' => 16, // AV_POLI_KODE_KLAS_RAWAT_JALAN
            'jumlah' => $jumlah,
            'bill_rs' => $bill_rs,
            'bill_dr1' => $bill_dr1,
            'bill_dr2' => $bill_dr2,
            'status_selesai' => 0,
            'status_nk' => 0,
            'status_kredit' => 0,
            'flag_jurnal' => 0,
            'status_batal' => null,
            'user_input' => auth()->id() ?: null,
            'kode_paramedis' => $request->input('kode_paramedis') ?: null,
        ]);

        try {
            DB::statement('EXEC diskon_flat_perusahaan @no_registrasi = ?', [$patient['no_registrasi']]);
        } catch (\Exception $e) {
            // Ignore error in execution of stored procedure for now
        }

        return redirect()->back()->with('success', 'Tindakan berhasil ditambahkan.');
    }

    /**
     * Destroy Tindakan
     */
    public function destroyTindakan($kode_poli, $kode_trans)
    {
        $patient = $this->getPatientData($kode_poli);

        DB::table('tc_trans_pelayanan')->where('kode_trans_pelayanan', $kode_trans)->delete();
        // Option to delete from tc_oksigen if needed, like legacy:
        DB::table('tc_oksigen')->where('kode_trans_pelayanan', $kode_trans)->delete();

        return redirect()->back()->with('success', 'Tindakan berhasil dihapus');
    }

    /**
     * Pasien Selesai
     */
    public function selesaiPasien(Request $request, $kode_poli)
    {
        $patient = $this->getPatientData($kode_poli);

        DB::beginTransaction();
        try {
            // Update tc_kunjungan
            DB::table('tc_kunjungan')
                ->where('no_kunjungan', $patient['no_kunjungan'])
                ->update([
                    'tgl_blpl' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
                    'status_blpl' => 1,
                ]);

            // Update pl_tc_poli
            DB::table('pl_tc_poli')
                ->where('no_kunjungan', $patient['no_kunjungan'])
                ->update([
                    'status_keluar' => 1,
                    'status_periksa' => 1, // 1 = Selesai
                ]);

            DB::commit();

            return redirect()->route('poli.antrian-poli')->with('success', 'Pasien telah selesai ditindak.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->withErrors(['error' => 'Gagal memproses pasien selesai: '.$e->getMessage()]);
        }
    }

    /**
     * Rujuk Pasien ke Rawat Inap
     */
    public function rujukPasien(Request $request, $kode_poli)
    {
        $patient = $this->getPatientData($kode_poli);

        DB::beginTransaction();
        try {
            // Update pl_tc_poli
            DB::table('pl_tc_poli')
                ->where('no_kunjungan', $patient['no_kunjungan'])
                ->update([
                    'status_periksa' => 2, // 2 = Rujuk Rawat Inap
                ]);

            // Generate kode_rujukan
            $maxRujukan = DB::table('rg_tc_rujukan')->max('kode_rujukan') ?: 0;
            $kode_rujukan = $maxRujukan + 1;

            // Insert rg_tc_rujukan
            DB::table('rg_tc_rujukan')->insert([
                'kode_rujukan' => $kode_rujukan,
                'rujukan_dari' => $patient['kode_bagian'],
                'no_mr' => $patient['no_mr'],
                'no_kunjungan_lama' => $patient['no_kunjungan'],
                'no_registrasi' => $patient['no_registrasi'],
                'status' => '0',
                'tgl_input' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
            ]);

            // Insert tc_kunjungan baru untuk RI (kode bagian 030001)
            $maxKunjungan = DB::table('tc_kunjungan')->max('no_kunjungan') ?: 0;
            $no_kunjungan_baru = $maxKunjungan + 1;

            DB::table('tc_kunjungan')->insert([
                'no_kunjungan' => $no_kunjungan_baru,
                'no_registrasi' => $patient['no_registrasi'],
                'no_registrasi_old' => 1,
                'no_mr' => $patient['no_mr'],
                'kode_dokter' => $patient['kode_dokter'],
                'kode_bagian_tujuan' => '030001', // Ranap
                'kode_bagian_asal' => $patient['kode_bagian'],
                'tgl_masuk' => now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'status_masuk' => 1,
            ]);

            DB::commit();

            return redirect()->route('poli.antrian-poli')->with('success', 'Pasien berhasil dirujuk ke Rawat Inap.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->withErrors(['error' => 'Gagal merujuk pasien: '.$e->getMessage()]);
        }
    }
}
