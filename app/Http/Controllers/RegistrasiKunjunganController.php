<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class RegistrasiKunjunganController extends Controller
{
    public function createPoli(Request $request, $no_mr)
    {
        $patient = null;
        if ($no_mr) {
            $patient = DB::table('mt_master_pasien')->where('no_mr', $no_mr)->first();
        }

        $bagian = DB::table('mt_bagian')->where('pelayanan', 1)->get();
        $dokter = DB::table('mt_karyawan')->whereNotNull('kode_dokter')->where('kode_dokter', '<>', 0)->get();

        $nasabah = DB::table('mt_nasabah')->whereNotIn('kode_kelompok', [2])->get();
        $perusahaan = DB::table('mt_perusahaan')->get();
        $milik = DB::table('tbl_milik')->get();
        $asal_pasien = DB::table('dc_asal_pasien')->get();
        $jadwal_dokter = DB::table('jadwal_dokter')->get();

        return Inertia::render('Registrasi/RawatJalan', [
            'patient' => $patient,
            'bagian' => $bagian,
            'dokter' => $dokter,
            'nasabah' => $nasabah,
            'perusahaan' => $perusahaan,
            'milik' => $milik,
            'asal_pasien' => $asal_pasien,
            'jadwal_dokter' => $jadwal_dokter,
        ]);
    }

    public function storePoli(Request $request, $no_mr)
    {
        $request->validate([
            'no_mr' => 'required',
            'kode_bagian' => 'required',
            'kode_dokter' => 'required',
            'tgl_masuk' => 'required|date',
        ]);

        try {
            DB::beginTransaction();

            $no_mr_param = $no_mr;
            $kode_bagian = $request->kode_bagian;
            $kode_dokter = $request->kode_dokter;
            $tgl_masuk = Carbon::parse($request->tgl_masuk)->format('Y-m-d H:i:s');

            $patient = DB::table('mt_master_pasien')->where('no_mr', $no_mr_param)->first();
            $umur = $patient->tgl_lhr ? Carbon::parse($patient->tgl_lhr)->age : 0;

            // generate no_registrasi
            $datePart = Carbon::parse($tgl_masuk)->format('ymd');
            $day = Carbon::parse($tgl_masuk)->format('d');
            $month = Carbon::parse($tgl_masuk)->format('m');
            $year = Carbon::parse($tgl_masuk)->format('Y');

            $maxNoUrut = DB::table('tc_registrasi')
                ->whereRaw('DAY(tgl_jam_masuk) = ? AND MONTH(tgl_jam_masuk) = ? AND YEAR(tgl_jam_masuk) = ?', [$day, $month, $year])
                ->max('no_urut');

            $no_urut = $maxNoUrut ? $maxNoUrut + 1 : 1;
            $no_urut_str = str_pad((string) $no_urut, 3, '0', STR_PAD_LEFT);
            $no_registrasi = $datePart.$no_urut_str;

            $kode_kelompok = $request->kode_kelompok ?? $patient->kode_kelompok ?? 0;
            $kode_perusahaan = $request->kode_perusahaan ?? $patient->kode_perusahaan ?? 0;
            $status_milik = $request->status_milik ?? 0;
            $kode_penanggung = $request->kode_penanggung ?? 0;
            $no_jaminan = $request->no_jaminan ?? '';
            $no_induk = session('no_induk', '0');
            $prioritas = $request->prioritas ?? '';
            $stat_pasien = $request->stat_pasien ?? 'Lama';
            $flag_daftar = $request->flag_daftar ?? 0;

            // tc_registrasi
            DB::table('tc_registrasi')->insert([
                'no_registrasi' => $no_registrasi,
                'no_registrasi_old' => 1,
                'no_mr' => $no_mr,
                'kode_perusahaan' => $kode_perusahaan,
                'kode_kelompok' => $kode_kelompok,
                'kode_dokter' => $kode_dokter,
                'no_induk' => $no_induk,
                'tgl_jam_masuk' => $tgl_masuk,
                'prioritas' => $prioritas,
                'kode_bagian_masuk' => $kode_bagian,
                'stat_pasien' => $stat_pasien,
                'flag_daftar' => $flag_daftar,
                'no_urut' => $no_urut,
                'umur' => $umur,
                'status_milik' => $status_milik > 0 ? $status_milik : 0,
                'kode_penanggung' => $kode_penanggung,
                'no_jaminan' => $no_jaminan,
                'id_dc_asal_pasien' => $request->id_dc_asal_pasien,
                'id_dc_sub_asal_pasien' => $request->id_dc_sub_asal_pasien,
                'memo' => $request->memo,
                'no_sjp' => $request->no_jkn,
                'noSep' => $request->noSep,
                'noRujukan' => $request->no_rjk,
                'jasa_kiriman' => $request->jasa_kiriman,
                'noKartuPeserta' => $request->noKartu,
                'tglSep' => $request->tglSep,
                'tglRujukan' => $request->tglRujukan,
                'ppkRujukan' => $request->ppkRujukan,
                'ppkPelayanan' => $request->ppkPelayanan,
                'jnsPelayanan' => $request->jnsPelayanan,
                'catatan' => $request->catatan,
                'kdDiag' => $request->kdDiag,
                'diagAwal' => $request->diagAwal,
                'poliTujuan' => $request->poliTujuan,
                'klsRawat' => $request->klsRawat,
                'userInp' => $request->userInp,
                'noMr' => $request->noMr,
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
                'keterangan' => $request->keterangan ?? '',
                'flag_titipan' => $request->flag_titipan ?? null,
            ]);

            // tc_trans_kartu (jika pasien baru)
            if (strtolower($stat_pasien) === 'baru') {
                $kode_trans_kartu = DB::table('tc_trans_kartu')->max('kode_trans_kartu') + 1;
                DB::table('tc_trans_kartu')->insert([
                    'kode_trans_kartu' => $kode_trans_kartu,
                    'no_registrasi' => $no_registrasi,
                    'no_mr' => $no_mr,
                    'nama_pasien' => $patient->nama_pasien ?? '',
                    'tgl_transaksi' => $tgl_masuk,
                    'jumlah_transaksi' => 1,
                    'no_kunjungan' => $no_kunjungan,
                ]);
            }

            // pl_tc_poli
            $maxKodePoli = DB::table('pl_tc_poli')->max('kode_poli');
            $kode_poli = $maxKodePoli ? $maxKodePoli + 1 : 1;

            $jadwalQuery = '';
            $bindings = [$year, $month, $day, $kode_bagian, $kode_dokter];
            if ($request->kode_jadwal) {
                $jadwalQuery = ' AND kode_jadwal = ?';
                $bindings[] = $request->kode_jadwal;
            }

            $maxNoAntrian = DB::table('pl_tc_poli')
                ->whereRaw("YEAR(tgl_jam_poli) = ? AND MONTH(tgl_jam_poli) = ? AND DAY(tgl_jam_poli) = ? AND kode_bagian = ? AND kode_dokter = ?$jadwalQuery", $bindings)
                ->max('no_antrian');
            $no_antrian = $maxNoAntrian ? $maxNoAntrian + 1 : 1;

            DB::table('pl_tc_poli')->insert([
                'kode_poli' => $kode_poli,
                'no_kunjungan' => $no_kunjungan,
                'kode_bagian' => $kode_bagian,
                'tgl_jam_poli' => $tgl_masuk,
                'kode_dokter' => $kode_dokter,
                'no_antrian' => $no_antrian,
                'no_induk' => $no_induk,
                'kode_jadwal' => $request->kode_jadwal,
            ]);

            // pesanan
            if ($request->id_tc_pesanan) {
                DB::table('tc_pesanan')
                    ->where('id_tc_pesanan', $request->id_tc_pesanan)
                    ->update([
                        'tgl_masuk' => Carbon::now()->format('Y-m-d H:i:s'),
                        'ket_antrian' => $request->ket_antrian,
                    ]);
            }

            // flag_daftar for mt_master_pasien
            if ($request->flag_daftar) {
                DB::table('mt_master_pasien')
                    ->where('no_mr', $no_mr)
                    ->update([
                        'flag_daftar' => $request->flag_daftar,
                        'nik' => $no_jaminan,
                        'memo' => $request->memo,
                    ]);
            }

            // mt_tarif_v administrasi
            $bill_adm = DB::table('mt_tarif_v')
                ->where('kode_bagian', $kode_bagian)
                ->where('flag_reg', 1)
                ->get();

            foreach ($bill_adm as $resbill_adm) {
                $jumlah = 1;
                $bill_rs = 0;
                $bill_dr1 = 0;

                if (strtolower($stat_pasien) === 'baru') {
                    $bill_rs = $resbill_adm->adm_baru ?? 0;
                } else {
                    switch ($kode_kelompok) {
                        case '1':
                            $bill_rs = $resbill_adm->bill_rs ?? 0;
                            $bill_dr1 = $resbill_adm->bill_dr1 ?? 0;
                            break;
                        case '3':
                        case '5':
                            $rPengecualian = DB::table('pola_tarif_perusahaan_v')
                                ->where('kode_klas', '16')
                                ->where('kode_tarif', $resbill_adm->kode_tarif)
                                ->where('kode_perusahaan', $kode_perusahaan)
                                ->first();
                            if ($rPengecualian && $rPengecualian->id_pola_tarif > 0) {
                                $bill_rs = ($rPengecualian->bill_rs ?? 0) * $jumlah;
                                $bill_dr1 = ($rPengecualian->bill_dr1 ?? 0) * $jumlah;
                            } else {
                                if ($kode_kelompok == '3') {
                                    $bill_rs = $resbill_adm->bill_rs_ass ?? 0;
                                    $bill_dr1 = $resbill_adm->bill_dr1_ass ?? 0;
                                } else {
                                    $bill_rs = $resbill_adm->bill_rs_pt ?? 0;
                                    $bill_dr1 = $resbill_adm->bill_dr1_pt ?? 0;
                                }
                            }
                            break;
                        case '8': case '9': case '11': case '12': case '13': case '10':
                            $bill_rs = $resbill_adm->bill_rs_bpjs ?? 0;
                            $bill_dr1 = $resbill_adm->bill_dr1_bpjs ?? 0;
                            break;
                        default:
                            $bill_rs = $resbill_adm->bill_rs ?? 0;
                            $bill_dr1 = $resbill_adm->bill_dr1 ?? 0;
                            break;
                    }
                }

                $kode_trans_pelayanan = DB::table('tc_trans_pelayanan')->max('kode_trans_pelayanan') + 1;
                DB::table('tc_trans_pelayanan')->insert([
                    'kode_trans_pelayanan' => $kode_trans_pelayanan,
                    'no_kunjungan' => $no_kunjungan,
                    'kode_perusahaan' => $kode_perusahaan,
                    'no_registrasi' => $no_registrasi,
                    'no_mr' => $no_mr,
                    'bill_rs' => $bill_rs,
                    'bill_dr1' => $bill_dr1,
                    'jumlah' => $jumlah,
                    'kode_tarif' => $resbill_adm->kode_tarif,
                    'nama_tindakan' => $resbill_adm->nama_tarif,
                    'jenis_tindakan' => $resbill_adm->jenis_tindakan,
                    'kode_kelompok' => $kode_kelompok,
                    'tgl_transaksi' => $tgl_masuk,
                    'kode_bagian' => $kode_bagian,
                    'kode_bagian_asal' => $kode_bagian,
                    'kode_klas' => '16',
                    'nama_pasien_layan' => $patient->nama_pasien ?? '',
                ]);
            }

            // mt_tarif_v konsultasi
            if ($kode_bagian != '011101') {
                $bill_dr = DB::table('mt_tarif_v')
                    ->where('kode_bagian', $kode_bagian)
                    ->where('flag_reg', 2)
                    ->get();

                foreach ($bill_dr as $resbill_dr) {
                    $jumlah = 1;
                    $bill_rs = 0;
                    $bill_dr1 = 0;

                    switch ($kode_kelompok) {
                        case '1':
                            $bill_rs = $resbill_dr->bill_rs ?? 0;
                            $bill_dr1 = $resbill_dr->bill_dr1 ?? 0;
                            break;
                        case '3':
                        case '5':
                            $rPengecualian = DB::table('pola_tarif_perusahaan_v')
                                ->where('kode_klas', '16')
                                ->where('kode_tarif', $resbill_dr->kode_tarif)
                                ->where('kode_perusahaan', $kode_perusahaan)
                                ->first();
                            if ($rPengecualian && $rPengecualian->id_pola_tarif > 0) {
                                $bill_rs = ($rPengecualian->bill_rs ?? 0) * $jumlah;
                                $bill_dr1 = ($rPengecualian->bill_dr1 ?? 0) * $jumlah;
                            } else {
                                if ($kode_kelompok == '3') {
                                    $bill_rs = $resbill_dr->bill_rs_ass ?? 0;
                                    $bill_dr1 = $resbill_dr->bill_dr1_ass ?? 0;
                                } else {
                                    $bill_rs = $resbill_dr->bill_rs_pt ?? 0;
                                    $bill_dr1 = $resbill_dr->bill_dr1_pt ?? 0;
                                }
                            }
                            break;
                        case '8': case '9': case '11': case '12': case '13': case '10':
                            $bill_rs = $resbill_dr->bill_rs_bpjs ?? 0;
                            $bill_dr1 = $resbill_dr->bill_dr1_bpjs ?? 0;
                            break;
                        default:
                            $bill_rs = $resbill_dr->bill_rs ?? 0;
                            $bill_dr1 = $resbill_dr->bill_dr1 ?? 0;
                            break;
                    }

                    $kode_trans_pelayanan = DB::table('tc_trans_pelayanan')->max('kode_trans_pelayanan') + 1;
                    DB::table('tc_trans_pelayanan')->insert([
                        'kode_trans_pelayanan' => $kode_trans_pelayanan,
                        'no_kunjungan' => $no_kunjungan,
                        'kode_perusahaan' => $kode_perusahaan,
                        'no_registrasi' => $no_registrasi,
                        'no_mr' => $no_mr,
                        'bill_rs' => $bill_rs,
                        'bill_dr1' => $bill_dr1,
                        'jumlah' => $jumlah,
                        'kode_dokter1' => $kode_dokter,
                        'kode_tarif' => $resbill_dr->kode_tarif,
                        'nama_tindakan' => $resbill_dr->nama_tarif,
                        'jenis_tindakan' => $resbill_dr->jenis_tindakan,
                        'kode_kelompok' => $kode_kelompok,
                        'tgl_transaksi' => $tgl_masuk,
                        'kode_bagian' => $kode_bagian,
                        'kode_bagian_asal' => $kode_bagian,
                        'kode_klas' => '16',
                        'nama_pasien_layan' => $patient->nama_pasien ?? '',
                    ]);
                }
            }

            // tc_sep_ri_temp
            DB::table('tc_sep_ri_temp')->insert([
                'tgl_masuk' => Carbon::now()->format('Y-m-d'),
                'no_mr' => $no_mr,
                'nama_pasien' => $patient->nama_pasien ?? '',
                'no_sep' => $request->noSep ?? '',
                'kode_cbg' => $request->kode_cbg ?? '',
                'topup' => $request->topup ?? 0,
                'total_tarif' => $request->plafon_bpjs ?? 0,
                'jenis' => 'RJ',
            ]);

            // update mt_master_pasien for BPJS/assurance fields
            DB::table('mt_master_pasien')
                ->where('no_mr', $no_mr)
                ->update([
                    'nik' => $request->no_jaminan ?? $patient->nik ?? '',
                    'no_peserta' => $request->no_peserta ?? $patient->no_peserta ?? '',
                    'no_polis' => $request->no_polis ?? $patient->no_polis ?? '',
                    'milik' => $request->kode_milik ?? $patient->milik ?? '',
                    'kode_kelompok' => $kode_kelompok,
                    'kode_perusahaan' => $kode_perusahaan,
                    'kode_pt' => $request->kode_penanggung ?? $patient->kode_pt ?? '',
                    'memo' => $request->memo ?? $patient->memo ?? '',
                    'no_ktp' => $request->no_ktp ?? $patient->no_ktp ?? '',
                    'tlp_almt_ttp' => $request->tlp_almt_ttp ?? $patient->tlp_almt_ttp ?? '',
                ]);

            DB::commit();

            return redirect()->back()->with('success', 'Pendaftaran Rawat Jalan Berhasil. No Antrian: '.$no_urut);

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Gagal mendaftar: '.$e->getMessage());
        }
    }

    public function createIgd(Request $request, $no_mr)
    {
        $patient = null;
        if ($no_mr) {
            $patient = DB::table('mt_master_pasien')->where('no_mr', $no_mr)->first();
        }

        $dokter = DB::table('mt_karyawan')->whereNotNull('kode_dokter')->where('kode_dokter', '<>', 0)->get();

        return Inertia::render('Registrasi/RawatDarurat', [
            'patient' => $patient,
            'dokter' => $dokter,
        ]);
    }

    public function storeIgd(Request $request, $no_mr)
    {
        $request->validate([
            'no_mr' => 'required',
            'kode_dokter' => 'required',
            'tgl_masuk' => 'required|date',
        ]);

        try {
            DB::beginTransaction();

            $no_mr_param = $no_mr;
            $kode_bagian = '020101'; // Default IGD
            $kode_dokter = $request->kode_dokter;
            $tgl_masuk = Carbon::parse($request->tgl_masuk)->format('Y-m-d H:i:s');

            // Get patient info
            $patient = DB::table('mt_master_pasien')->where('no_mr', $no_mr_param)->first();

            // generate no_registrasi
            $datePart = Carbon::parse($tgl_masuk)->format('ymd');
            $day = Carbon::parse($tgl_masuk)->format('d');
            $month = Carbon::parse($tgl_masuk)->format('m');
            $year = Carbon::parse($tgl_masuk)->format('Y');

            $maxNoUrut = DB::table('tc_registrasi')
                ->whereRaw('DAY(tgl_jam_masuk) = ? AND MONTH(tgl_jam_masuk) = ? AND YEAR(tgl_jam_masuk) = ?', [$day, $month, $year])
                ->max('no_urut');

            $no_urut = $maxNoUrut ? $maxNoUrut + 1 : 1;
            $no_urut_str = str_pad((string) $no_urut, 3, '0', STR_PAD_LEFT);
            $no_registrasi = $datePart.$no_urut_str;

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
                'no_jaminan' => $request->no_jaminan ?? '',
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
                'keterangan' => $request->keterangan ?? '',
            ]);

            // gd_tc_gawat_darurat
            $maxKodeGd = DB::table('gd_tc_gawat_darurat')->max('kode_gd');
            $kode_gd = $maxKodeGd ? $maxKodeGd + 1 : 1;

            DB::table('gd_tc_gawat_darurat')->insert([
                'kode_gd' => $kode_gd,
                'no_kunjungan' => $no_kunjungan,
                'jns_celaka' => $request->jns_celaka ?? '',
                'tanggal_gd' => $tgl_masuk,
                'tgl_kecelakaan' => $request->tgl_kecelakaan ?? null,
                'tmpt_kecelakaan' => $request->tmpt_kecelakaan ?? '',
                'dibawa_oleh' => $request->dibawa_oleh ?? '',
                'tgl_jam_msk' => $tgl_masuk,
                'kd_tind_igd' => 0,
                'dikirim_oleh' => $request->dikirim_oleh ?? '',
                'dibawa_dgn' => $request->dibawa_dgn ?? '',
                'kasus_polisi' => $request->kasus_polisi ?? '',
                'dokter_jaga' => $kode_dokter,
                'nama_org_dekat' => $request->nama_org_dekat ?? '',
                'telp_org_dekat' => $request->telp_org_dekat ?? '',
                'alamat_org_dekat' => $request->alamat_org_dekat ?? '',
                'status_diterima' => $request->status_diterima ?? '',
                'no_induk' => session('no_induk', '0'),
                'kode_klas' => '16',
                'flag_man' => 1,
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Pendaftaran IGD Berhasil.');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Gagal mendaftar: '.$e->getMessage());
        }
    }
}
