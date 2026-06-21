<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PasienLuarController extends Controller
{
    // Alias methods to match route naming
    public function entryLuar()
    {
        return $this->create();
    }

    public function storeLuar(Request $request)
    {
        return $this->store($request);
    }

    public function create()
    {
        $nasabah = DB::table('mt_nasabah')
            ->where('kode_kelompok', '<>', 2)
            ->select('nama_kelompok', 'kode_kelompok')
            ->get();

        $asuransi = DB::table('mt_perusahaan')
            ->where('flag', 1)
            ->where('kode_kelompok', 3)
            ->select('nama_perusahaan', 'kode_perusahaan')
            ->orderBy('nama_perusahaan')
            ->get();

        $asuransiCob = DB::table('mt_perusahaan')
            ->where('flag', 1)
            ->where('kode_kelompok', 3)
            ->where('flag_cob', 1)
            ->select('nama_perusahaan', 'kode_perusahaan')
            ->orderBy('nama_perusahaan')
            ->get();

        $pt = DB::table('mt_perusahaan')
            ->where(function ($query) {
                $query->whereNull('flag')
                    ->orWhere('flag', 0);
            })
            ->select('nama_perusahaan', 'kode_perusahaan')
            ->orderBy('nama_perusahaan')
            ->get();

        $penunjang = DB::table('mt_bagian')
            ->where('kode_bagian', 'like', '05%')
            ->where('status_aktif', 1)
            ->where('group_bag', '<>', 'Group')
            ->select('nama_bagian', 'kode_bagian')
            ->get();

        return Inertia::render('Poli/EntryPasienLuar', [
            'nasabah' => $nasabah,
            'asuransi' => $asuransi,
            'asuransiCob' => $asuransiCob,
            'pt' => $pt,
            'penunjang' => $penunjang,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pasien' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'tempat_lahir' => 'nullable|string|max:255',
            'alamat_pasien' => 'nullable|string',
            'jen_kelamin' => 'required|in:L,P',
            'kode_kelompok' => 'required',
            'kode_perusahaan' => 'nullable',
            'kode_bagian' => 'required',
            'dokter_pengirim' => 'nullable|string|max:255',
        ]);

        try {
            DB::beginTransaction();

            $tgl_masuk = Carbon::now();
            $kode_bagian_masuk = $validated['kode_bagian'];
            $stat_pasien = 'Baru';
            $status_cito = 0;

            // Generate ID and no_pm
            $id_mt_pasien_penunjang = (DB::table('mt_pasien_penunjang')->max('id_mt_pasien_penunjang') ?? 0) + 1;
            $kode_penunjang = (DB::table('pm_tc_penunjang')->max('kode_penunjang') ?? 0) + 1;

            $iRecNumber = $id_mt_pasien_penunjang;
            $no_pm = str_pad($iRecNumber, 7, '0', STR_PAD_LEFT).'L';

            // 1. Insert mt_pasien_penunjang
            DB::table('mt_pasien_penunjang')->insert([
                'id_mt_pasien_penunjang' => $id_mt_pasien_penunjang,
                'no_pm' => $no_pm,
                'kode_penunjang' => $kode_penunjang,
                'nama_pasien' => strtoupper($validated['nama_pasien']),
                'tgl_lahir' => $validated['tgl_lahir'],
                'tempat_lahir' => $validated['tempat_lahir'] ?? '',
                'alamat_pasien' => $validated['alamat_pasien'] ?? '',
                'jen_kelamin' => $validated['jen_kelamin'],
                'kode_kelompok' => $validated['kode_kelompok'],
                'kode_perusahaan' => $validated['kode_perusahaan'] ?: 0,
                'kode_bagian' => $validated['kode_bagian'],
                'dokter_pengirim' => $validated['dokter_pengirim'] ?? '',
            ]);

            // 2. tc_registrasi
            $tgl_cek = date('d');
            $bln_cek = date('m');
            $thn_cek = date('Y');
            $tgl_ymd = date('ymd');

            $no_urut_reg = (DB::table('tc_registrasi')
                ->whereDay('tgl_jam_masuk', $tgl_cek)
                ->whereMonth('tgl_jam_masuk', $bln_cek)
                ->whereYear('tgl_jam_masuk', $thn_cek)
                ->max('no_urut') ?? 0) + 1;

            $no_urut1 = sprintf('%03s', $no_urut_reg);
            $no_registrasi = $tgl_ymd.''.$no_urut1;

            DB::table('tc_registrasi')->insert([
                'no_registrasi' => $no_registrasi,
                'no_mr' => $no_pm,
                'kode_perusahaan' => $validated['kode_perusahaan'] ?: 0,
                'kode_kelompok' => $validated['kode_kelompok'],
                'tgl_jam_masuk' => $tgl_masuk,
                'kode_bagian_masuk' => $kode_bagian_masuk,
                'stat_pasien' => $stat_pasien,
                'no_urut' => $no_urut_reg,
            ]);

            // 3. tc_kunjungan
            $no_kunjungan = (DB::table('tc_kunjungan')->max('no_kunjungan') ?? 0) + 1;
            DB::table('tc_kunjungan')->insert([
                'no_kunjungan' => $no_kunjungan,
                'no_registrasi' => $no_registrasi,
                'no_mr' => $no_pm,
                'kode_dokter' => 0,
                'kode_bagian_tujuan' => $kode_bagian_masuk,
                'kode_bagian_asal' => $kode_bagian_masuk,
                'tgl_masuk' => $tgl_masuk,
                'status_masuk' => 0,
                'status_cito' => $status_cito,
            ]);

            // 4. pm_tc_penunjang
            // Cari antrian poli
            $no_antrian = (DB::table('pm_tc_penunjang')
                ->where('kode_bagian', $kode_bagian_masuk)
                ->whereDate('tgl_daftar', date('Y-m-d'))
                ->max('no_antrian') ?? 0) + 1;

            DB::table('pm_tc_penunjang')->insert([
                'kode_penunjang' => $kode_penunjang,
                'tgl_daftar' => $tgl_masuk,
                'kode_bagian' => $kode_bagian_masuk,
                'no_kunjungan' => $no_kunjungan,
                'no_antrian' => $no_antrian,
                'kode_klas' => 7,
                'dr_pengirim' => $validated['dokter_pengirim'] ?? '',
                'petugas_input' => auth()->user()->no_induk ?? '',
            ]);

            // 5. tc_trans_pelayanan (Administrasi)
            $bill = DB::table('mt_tarif_v')
                ->where('kode_bagian', $kode_bagian_masuk)
                ->where('nama_tarif', 'like', 'ADMINISTRASI%')
                ->select('bill_rs', 'bill_dr1', 'jenis_tindakan', 'nama_tarif', 'kode_tarif')
                ->first();

            if ($bill && $bill->kode_tarif) {
                $kode_trans_pelayanan = (DB::table('tc_trans_pelayanan')->max('kode_trans_pelayanan') ?? 0) + 1;

                DB::table('tc_trans_pelayanan')->insert([
                    'kode_trans_pelayanan' => $kode_trans_pelayanan,
                    'no_kunjungan' => $no_kunjungan,
                    'no_registrasi' => $no_registrasi,
                    'no_mr' => $no_pm,
                    'nama_pasien_layan' => strtoupper($validated['nama_pasien']),
                    'bill_rs' => $bill->bill_rs ?? 0,
                    'bill_dr1' => $bill->bill_dr1 ?? 0,
                    'kode_tarif' => $bill->kode_tarif,
                    'nama_tindakan' => $bill->nama_tarif,
                    'jenis_tindakan' => $bill->jenis_tindakan,
                    'jumlah' => 1,
                    'kode_perusahaan' => $validated['kode_perusahaan'] ?: 0,
                    'tgl_transaksi' => $tgl_masuk,
                    'kode_bagian' => $kode_bagian_masuk,
                    'kode_dokter1' => ($kode_bagian_masuk == '050401') ? 0 : 0, // Simplified for now
                    'kode_bagian_asal' => $kode_bagian_masuk,
                    'kode_klas' => 7,
                    'kode_kelompok' => $validated['kode_kelompok'],
                    'status_selesai' => 1,
                    'kode_penunjang' => $kode_penunjang,
                ]);
            }

            DB::commit();

            return redirect()->back()->with('success', 'Pendaftaran Pasien Luar Berhasil (No PM: '.$no_pm.')');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }
}
