<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class LaporanKunjunganController extends Controller
{
    /**
     * Tampilan utama Laporan Kunjungan dengan 10 tab
     */
    public function index()
    {
        return Inertia::render('Laporan/Kunjungan');
    }

    // 1. Kunjungan Umum
    public function cetakUmum(Request $request)
    {
        $kategori = $request->input('kategori', '1');
        $frekuensi = $request->input('frekuensi', '1');
        $tglAwal = $request->input('tgl_awal');
        $tglAkhir = $request->input('tgl_akhir');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        $opsiCetak = $request->input('opsi_cetak', '1');

        $queryBagian = DB::table('mt_bagian')->where('status_aktif', 1)->where('group_bag', 'detail')->whereNotIn('kode_bagian', ['030212']);

        if ($kategori == '2') {
            $queryBagian->where(function ($q) {
                $q->where('validasi', '010001')->orWhere('validasi', '050001');
            });
        } elseif ($kategori == '3') {
            $queryBagian->where('validasi', '030001');
        } elseif ($kategori == '5') {
            $queryBagian->where('validasi_lap_rm', '03000113');
        } elseif ($kategori == '6') {
            $queryBagian->where('validasi_lap_rm', '0300014');
        } elseif ($kategori == '7') {
            $queryBagian->where('validasi_lap_rm', '03000112');
        } else {
            $queryBagian->whereIn('validasi', ['010001', '050001', '030001']);
        }
        $bagianList = $queryBagian->get();

        $agregatQuery = DB::table('tc_registrasi as a')
            ->join('tc_kunjungan as c', 'a.no_registrasi', '=', 'c.no_registrasi')
            ->leftJoin('mt_perusahaan as b', 'a.kode_perusahaan', '=', 'b.kode_perusahaan')
            ->join('mt_master_pasien as mp', 'a.no_mr', '=', 'mp.no_mr')
            ->whereNull('a.status_batal')
            ->whereNull('c.status_batal');

        if ($frekuensi == '1') {
            $agregatQuery->whereDate('a.tgl_jam_masuk', '>=', $tglAwal)->whereDate('a.tgl_jam_masuk', '<=', $tglAkhir);
            $periode = 'Tanggal '.Carbon::parse($tglAwal)->format('d F Y').' s/d '.Carbon::parse($tglAkhir)->format('d F Y');
        } elseif ($frekuensi == '2') {
            $agregatQuery->whereMonth('a.tgl_jam_masuk', $bulan)->whereYear('a.tgl_jam_masuk', $tahun);
            $periode = 'Bulan '.Carbon::create()->month($bulan)->locale('id')->monthName.' '.$tahun;
        } else {
            $agregatQuery->whereYear('a.tgl_jam_masuk', $tahun);
            $periode = 'Tahun '.$tahun;
        }

        $agregat = $agregatQuery->selectRaw("
            c.kode_bagian_tujuan,
            COUNT(a.no_registrasi) as total_pasien,
            SUM(CASE WHEN a.kode_kelompok = 1 THEN 1 ELSE 0 END) as pribadi,
            SUM(CASE WHEN a.kode_kelompok = 3 THEN 1 ELSE 0 END) as asuransi,
            SUM(CASE WHEN a.kode_kelompok = 5 AND (b.flag_kapitasi IS NULL OR b.flag_kapitasi != 1) THEN 1 ELSE 0 END) as perusahaan,
            SUM(CASE WHEN a.kode_kelompok = 9 THEN 1 ELSE 0 END) as bpjspbi,
            SUM(CASE WHEN a.kode_kelompok = 12 THEN 1 ELSE 0 END) as bpjsnp,
            SUM(CASE WHEN a.kode_kelompok = 11 THEN 1 ELSE 0 END) as bpjscob,
            SUM(CASE WHEN a.kode_kelompok = 8 THEN 1 ELSE 0 END) as bpjskk,
            SUM(CASE WHEN a.kode_kelompok = 10 THEN 1 ELSE 0 END) as jamkesda,
            SUM(CASE WHEN a.kode_kelompok = 13 THEN 1 ELSE 0 END) as karawangsehat,
            SUM(CASE WHEN mp.jen_kelamin = 'L' THEN 1 ELSE 0 END) as laki,
            SUM(CASE WHEN mp.jen_kelamin = 'P' THEN 1 ELSE 0 END) as perempuan,
            SUM(CASE WHEN mp.nama_ayah IS NOT NULL AND mp.nama_ayah != '' THEN 1 ELSE 0 END) as anak,
            SUM(CASE WHEN mp.nama_ayah IS NULL OR mp.nama_ayah = '' THEN 1 ELSE 0 END) as dewasa,
            SUM(CASE WHEN a.stat_pasien != 'Baru' THEN 1 ELSE 0 END) as lama,
            SUM(CASE WHEN a.stat_pasien = 'Baru' THEN 1 ELSE 0 END) as baru
        ")
            ->groupBy('c.kode_bagian_tujuan')
            ->get()
            ->keyBy('kode_bagian_tujuan');

        $data = [];
        $total = [
            'total_pasien' => 0, 'pribadi' => 0, 'asuransi' => 0, 'perusahaan' => 0,
            'bpjspbi' => 0, 'bpjsnp' => 0, 'bpjscob' => 0, 'bpjskk' => 0,
            'jamkesda' => 0, 'karawangsehat' => 0, 'laki' => 0, 'perempuan' => 0,
            'anak' => 0, 'dewasa' => 0, 'lama' => 0, 'baru' => 0,
        ];

        foreach ($bagianList as $b) {
            $ag = $agregat->get($b->kode_bagian);
            $item = [
                'kode_bagian' => $b->kode_bagian,
                'nama_bagian' => $b->nama_bagian,
                'total_pasien' => $ag ? $ag->total_pasien : 0,
                'pribadi' => $ag ? $ag->pribadi : 0,
                'asuransi' => $ag ? $ag->asuransi : 0,
                'perusahaan' => $ag ? $ag->perusahaan : 0,
                'bpjspbi' => $ag ? $ag->bpjspbi : 0,
                'bpjsnp' => $ag ? $ag->bpjsnp : 0,
                'bpjscob' => $ag ? $ag->bpjscob : 0,
                'bpjskk' => $ag ? $ag->bpjskk : 0,
                'jamkesda' => $ag ? $ag->jamkesda : 0,
                'karawangsehat' => $ag ? $ag->karawangsehat : 0,
                'laki' => $ag ? $ag->laki : 0,
                'perempuan' => $ag ? $ag->perempuan : 0,
                'anak' => $ag ? $ag->anak : 0,
                'dewasa' => $ag ? $ag->dewasa : 0,
                'lama' => $ag ? $ag->lama : 0,
                'baru' => $ag ? $ag->baru : 0,
            ];
            $data[] = $item;

            foreach ($total as $key => $val) {
                $total[$key] += $item[$key];
            }
        }

        if ($opsiCetak == '2') {
            header('Content-type: application/vnd-ms-excel');
            header('Content-Disposition: attachment; filename=Lap_Kunjungan_Umum.xls');
        }

        return view('laporan.registrasi.kunjungan.umum', compact('data', 'total', 'periode', 'opsiCetak'));
    }

    // 2. Kunjungan Harian
    public function cetakHarian(Request $request)
    {
        $tglAwal = $request->input('tgl_awal');
        $tglAkhir = $request->input('tgl_akhir');
        $opsiCetak = $request->input('opsi_cetak', '1');

        $query = DB::table('tc_kunjungan as a')
            ->join('tc_registrasi as r', 'a.no_registrasi', '=', 'r.no_registrasi')
            ->leftJoin('mt_master_pasien as b', 'a.no_mr', '=', 'b.no_mr')
            ->leftJoin('mt_karyawan as d', 'r.kode_dokter', '=', 'd.kode_dokter')
            ->leftJoin('mt_bagian as bg', 'a.kode_bagian_tujuan', '=', 'bg.kode_bagian')
            ->leftJoin('mt_nasabah as n', 'r.kode_kelompok', '=', 'n.kode_kelompok')
            ->leftJoin('mt_perusahaan as p', 'r.kode_perusahaan', '=', 'p.kode_perusahaan')
            ->leftJoin('mt_karyawan as user', 'r.no_induk', '=', 'user.no_induk')
            ->whereNull('a.status_batal')
            ->whereNull('r.status_batal')
            ->where(function ($q) {
                $q->where('a.kode_bagian_tujuan', 'like', '01%')
                    ->orWhere('a.kode_bagian_tujuan', 'like', '02%');
            })
            ->whereDate('a.tgl_masuk', '>=', $tglAwal)
            ->whereDate('a.tgl_masuk', '<=', $tglAkhir)
            ->orderBy('a.kode_bagian_tujuan')
            ->orderBy('b.nama_pasien')
            ->select(
                'a.tgl_masuk',
                'bg.nama_bagian',
                'd.nama_pegawai as nama_dokter',
                'a.no_mr',
                'b.nama_pasien',
                'n.nama_kelompok',
                'p.nama_perusahaan',
                'b.jen_kelamin',
                'r.umur',
                'r.kode_bagian_keluar',
                'user.nama_pegawai as user_daftar',
                'r.stat_pasien'
            );

        $data = $query->get()->map(function ($item) {
            $jk = strtolower($item->jen_kelamin) == 'p' ? 'Perempuan' : 'Laki-Laki';
            $kobag = substr($item->kode_bagian_keluar, 0, 2);
            $statusPulang = ($kobag == '03') ? 'Rawat' : 'Pulang';

            return [
                'tgl_masuk' => $item->tgl_masuk,
                'bagian' => $item->nama_bagian,
                'dokter' => $item->nama_dokter,
                'no_mr' => $item->no_mr,
                'nama_pasien' => $item->nama_pasien,
                'nasabah' => $item->nama_kelompok,
                'perusahaan' => $item->nama_perusahaan,
                'jen_kelamin' => $jk,
                'umur' => $item->umur,
                'status_pulang' => $statusPulang,
                'user_daftar' => $item->user_daftar,
                'stat_pasien' => $item->stat_pasien,
            ];
        });

        $periode = 'Tanggal '.Carbon::parse($tglAwal)->format('d F Y').' s/d '.Carbon::parse($tglAkhir)->format('d F Y');

        if ($opsiCetak == '2') {
            header('Content-type: application/vnd-ms-excel');
            header('Content-Disposition: attachment; filename=Lap_Kunjungan_Harian.xls');
        }

        return view('laporan.registrasi.kunjungan.harian', compact('data', 'periode', 'opsiCetak'));
    }

    // 3. Kunjungan PM
    public function cetakPM(Request $request)
    {
        $frekuensi = $request->input('frekuensi', '1');
        $tglAwal = $request->input('tgl_awal');
        $tglAkhir = $request->input('tgl_akhir');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        $opsiCetak = $request->input('opsi_cetak', '1');

        $bagianList = DB::table('mt_bagian')
            ->where('validasi', '050001')
            ->where('status_aktif', 1)
            ->where('group_bag', 'detail')
            ->get();

        $agregatQuery = DB::table('tc_registrasi as a')
            ->leftJoin('mt_perusahaan as b', 'a.kode_perusahaan', '=', 'b.kode_perusahaan')
            ->join('mt_master_pasien as mp', 'a.no_mr', '=', 'mp.no_mr')
            ->whereNull('a.status_batal')
            ->where('a.status_registrasi', 1)
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('tc_trans_kasir as tk')
                    ->whereColumn('tk.no_registrasi', 'a.no_registrasi')
                    ->whereNull('tk.status_batal')
                    ->where('tk.seri_kuitansi', '!=', 'UM');
            });

        if ($frekuensi == '1') {
            $agregatQuery->whereDate('a.tgl_jam_masuk', '>=', $tglAwal)->whereDate('a.tgl_jam_masuk', '<=', $tglAkhir);
            $periode = 'Tanggal '.Carbon::parse($tglAwal)->format('d F Y').' s/d '.Carbon::parse($tglAkhir)->format('d F Y');
        } elseif ($frekuensi == '2') {
            $agregatQuery->whereMonth('a.tgl_jam_masuk', $bulan)->whereYear('a.tgl_jam_masuk', $tahun);
            $periode = 'Bulan '.Carbon::create()->month($bulan)->locale('id')->monthName.' '.$tahun;
        } else {
            $agregatQuery->whereYear('a.tgl_jam_masuk', $tahun);
            $periode = 'Tahun '.$tahun;
        }

        $agregat = $agregatQuery->selectRaw("
            a.kode_bagian_masuk,
            COUNT(a.no_registrasi) as total_pasien,
            SUM(CASE WHEN a.kode_kelompok = 1 THEN 1 ELSE 0 END) as pribadi,
            SUM(CASE WHEN a.kode_kelompok = 3 THEN 1 ELSE 0 END) as asuransi,
            SUM(CASE WHEN a.kode_kelompok = 5 THEN 1 ELSE 0 END) as perusahaan,
            SUM(CASE WHEN a.kode_kelompok = 9 THEN 1 ELSE 0 END) as bpjspbi,
            SUM(CASE WHEN a.kode_kelompok = 12 THEN 1 ELSE 0 END) as bpjsnp,
            SUM(CASE WHEN a.kode_kelompok = 11 THEN 1 ELSE 0 END) as bpjscob,
            SUM(CASE WHEN a.kode_kelompok = 8 THEN 1 ELSE 0 END) as bpjskk,
            SUM(CASE WHEN a.kode_kelompok = 10 THEN 1 ELSE 0 END) as jamkesda,
            SUM(CASE WHEN mp.jen_kelamin = 'L' THEN 1 ELSE 0 END) as laki,
            SUM(CASE WHEN mp.jen_kelamin = 'P' THEN 1 ELSE 0 END) as perempuan,
            SUM(CASE WHEN a.stat_pasien != 'Baru' THEN 1 ELSE 0 END) as lama,
            SUM(CASE WHEN a.stat_pasien = 'Baru' THEN 1 ELSE 0 END) as baru,
            SUM(CASE WHEN a.kode_bagian_keluar LIKE '03%' THEN 1 ELSE 0 END) as rawat,
            SUM(CASE WHEN a.kode_bagian_keluar NOT LIKE '03%' OR a.kode_bagian_keluar IS NULL THEN 1 ELSE 0 END) as pulang
        ")
            ->groupBy('a.kode_bagian_masuk')
            ->get()
            ->keyBy('kode_bagian_masuk');

        $data = [];
        $total = [
            'total_pasien' => 0, 'pribadi' => 0, 'asuransi' => 0, 'perusahaan' => 0,
            'bpjspbi' => 0, 'bpjsnp' => 0, 'bpjscob' => 0, 'bpjskk' => 0,
            'jamkesda' => 0, 'laki' => 0, 'perempuan' => 0,
            'lama' => 0, 'baru' => 0, 'rawat' => 0, 'pulang' => 0,
        ];

        foreach ($bagianList as $b) {
            $ag = $agregat->get($b->kode_bagian);
            $item = [
                'kode_bagian' => $b->kode_bagian,
                'nama_bagian' => $b->nama_bagian,
                'total_pasien' => $ag ? $ag->total_pasien : 0,
                'pribadi' => $ag ? $ag->pribadi : 0,
                'asuransi' => $ag ? $ag->asuransi : 0,
                'perusahaan' => $ag ? $ag->perusahaan : 0,
                'bpjspbi' => $ag ? $ag->bpjspbi : 0,
                'bpjsnp' => $ag ? $ag->bpjsnp : 0,
                'bpjscob' => $ag ? $ag->bpjscob : 0,
                'bpjskk' => $ag ? $ag->bpjskk : 0,
                'jamkesda' => $ag ? $ag->jamkesda : 0,
                'laki' => $ag ? $ag->laki : 0,
                'perempuan' => $ag ? $ag->perempuan : 0,
                'lama' => $ag ? $ag->lama : 0,
                'baru' => $ag ? $ag->baru : 0,
                'rawat' => $ag ? $ag->rawat : 0,
                'pulang' => $ag ? $ag->pulang : 0,
            ];
            $data[] = $item;

            foreach ($total as $key => $val) {
                $total[$key] += $item[$key];
            }
        }

        if ($opsiCetak == '2') {
            header('Content-type: application/vnd-ms-excel');
            header('Content-Disposition: attachment; filename=Lap_Kunjungan_PM.xls');
        }

        return view('laporan.registrasi.kunjungan.pm', compact('data', 'total', 'periode', 'opsiCetak'));
    }

    // 4. Kunjungan Rawat Inap
    public function cetakRanap(Request $request)
    {
        $frekuensi = $request->input('frekuensi', '1');
        $tglAwal = $request->input('tgl_awal');
        $tglAkhir = $request->input('tgl_akhir');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        $opsiCetak = $request->input('opsi_cetak', '1');

        $query = DB::table('lap_pasien_plang_ri_v');

        if ($frekuensi == '1') {
            $query->whereDate('tgl_keluar', '>=', $tglAwal)->whereDate('tgl_keluar', '<=', $tglAkhir);
            $periode = 'Tanggal '.Carbon::parse($tglAwal)->format('d F Y').' s/d '.Carbon::parse($tglAkhir)->format('d F Y');
        } elseif ($frekuensi == '2') {
            $query->where('bln', $bulan)->where('thn', $tahun);
            $periode = 'Bulan '.Carbon::create()->month($bulan)->locale('id')->monthName.' '.$tahun;
        } else {
            $query->where('thn', $tahun);
            $periode = 'Tahun '.$tahun;
        }

        $query->orderBy('tgl_keluar', 'asc');
        $results = $query->get();

        $data = $results->map(function ($item) {
            $nasabah = '';
            switch ($item->kode_kelompok) {
                case '1': $nasabah = 'Umum';
                    break;
                case '3': $nasabah = 'Asuransi';
                    break;
                case '5': $nasabah = 'PERUSAHAAN';
                    break;
                case '10': $nasabah = 'JAMKESDA';
                    break;
                case '9': $nasabah = 'BPJS PBI';
                    break;
                case '8': $nasabah = 'BPJS Ketenagakerjaan';
                    break;
                case '11': $nasabah = 'BPJS COB';
                    break;
                case '12': $nasabah = 'BPJS NON PBI';
                    break;
            }

            $nama_perusahaan = '';
            if ($item->kode_perusahaan) {
                $perusahaan = DB::table('mt_perusahaan')->where('kode_perusahaan', $item->kode_perusahaan)->first();
                if ($perusahaan) {
                    $nama_perusahaan = $perusahaan->nama_perusahaan;
                }
            }

            $pasien = DB::table('mt_master_pasien')->where('no_mr', $item->no_mr)->first();
            $nama_pasien = $pasien ? $pasien->nama_pasien : '';
            $jen_kelamin = $pasien ? $pasien->jen_kelamin : '';
            $tgl_lhr = $pasien ? $pasien->tgl_lhr : '';

            $gender = (($jen_kelamin == 1 || $jen_kelamin == 'L') ? 'L' : (($jen_kelamin == 2 || $jen_kelamin == 'P') ? 'P' : ''));

            $kamar = DB::table('mt_ruangan')->where('kode_ruangan', $item->kode_ruangan)->first();
            $nama_kamar = $kamar ? $kamar->no_kamar.' '.$kamar->no_bed : '';

            $dokter = DB::table('mt_karyawan')->where('kode_dokter', $item->dr_merawat)->first();
            $nama_dokter = $dokter ? $dokter->nama_pegawai : '';

            return [
                'no_mr' => $item->no_mr,
                'nama_pasien' => $nama_pasien,
                'no_registrasi' => $item->no_registrasi,
                'gender' => $gender,
                'nasabah' => $nasabah.' '.$nama_perusahaan,
                'umur' => Carbon::parse($tgl_lhr)->age,
                'nama_bagian' => $item->nama_bagian,
                'nama_klas' => $item->nama_klas,
                'kamar' => $nama_kamar,
                'tgl_masuk' => $item->tgl_masuk,
                'tgl_keluar' => $item->tgl_keluar,
                'dokter' => $nama_dokter,
                'stat_pasien' => $item->stat_pasien,
                'bill_dr' => $item->bill_dr1_tot,
            ];
        });

        if ($opsiCetak == '2') {
            header('Content-type: application/vnd-ms-excel');
            header('Content-Disposition: attachment; filename=Lap_Kunjungan_Ranap.xls');
        }

        return view('laporan.registrasi.kunjungan.ranap', compact('data', 'periode', 'opsiCetak'));
    }

    // 5. Kunjungan Perinatologi
    public function cetakPerina(Request $request)
    {
        $frekuensi = $request->input('frekuensi', '1');
        $tglAwal = $request->input('tgl_awal');
        $tglAkhir = $request->input('tgl_akhir');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        $opsiCetak = $request->input('opsi_cetak', '1');

        $query = DB::table('lap_kunjungan_pasien_ranap_v')
            ->where('kode_bagian_tujuan', '030601');

        if ($frekuensi == '1') {
            $query->whereDate('tgl_masuk', '>=', $tglAwal)->whereDate('tgl_masuk', '<=', $tglAkhir);
            $periode = 'Tanggal '.Carbon::parse($tglAwal)->format('d F Y').' s/d '.Carbon::parse($tglAkhir)->format('d F Y');
        } elseif ($frekuensi == '2') {
            $query->where(function ($q) use ($bulan, $tahun) {
                $q->where(function ($q2) use ($bulan, $tahun) {
                    $q2->whereMonth('tgl_masuk', $bulan)->whereYear('tgl_masuk', $tahun);
                })->orWhere(function ($q3) use ($bulan, $tahun) {
                    $q3->whereMonth('tgl_keluar', $bulan)->whereYear('tgl_keluar', $tahun);
                });
            });
            $periode = 'Bulan '.Carbon::create()->month($bulan)->locale('id')->monthName.' '.$tahun;
        } else {
            $query->where(function ($q) use ($tahun) {
                $q->whereYear('tgl_masuk', $tahun)->orWhereYear('tgl_keluar', $tahun);
            });
            $periode = 'Tahun '.$tahun;
        }

        $results = $query->select(DB::raw('count(no_registrasi) as jumlah_pasien, kode_bagian_asal'))
            ->groupBy('kode_bagian_asal')
            ->get();

        $data = $results->map(function ($item) {
            $bagian = DB::table('mt_bagian')->where('kode_bagian', $item->kode_bagian_asal)->first();

            return [
                'bagian_asal' => $bagian ? $bagian->nama_bagian : $item->kode_bagian_asal,
                'jumlah_pasien' => $item->jumlah_pasien,
                'meninggal_krg' => 0, // Legacy logic uses 0
                'meninggal_lbh' => 0,  // Legacy logic uses 0
            ];
        });

        $total_pasien = $data->sum('jumlah_pasien');
        $total_meninggal_krg = 0;
        $total_meninggal_lbh = 0;

        if ($opsiCetak == '2') {
            header('Content-type: application/vnd-ms-excel');
            header('Content-Disposition: attachment; filename=Lap_Kunjungan_Perina.xls');
        }

        return view('laporan.registrasi.kunjungan.perina', compact('data', 'periode', 'total_pasien', 'total_meninggal_krg', 'total_meninggal_lbh', 'opsiCetak'));
    }

    // 6. Kunjungan RI Per Nasabah
    public function cetakRINasabah(Request $request)
    {
        $tglAwal = $request->input('tgl_awal');
        $tglAkhir = $request->input('tgl_akhir');
        $opsiCetak = $request->input('opsi_cetak', '1');

        $query = DB::table('lap_pasien_dlm_perawatan_v as a')
            ->join('mt_bagian as b', 'a.bag_pas', '=', 'b.kode_bagian')
            ->whereDate('a.tgl_masuk', '>=', $tglAwal)
            ->whereDate('a.tgl_masuk', '<=', $tglAkhir)
            ->orderBy('a.kode_kelompok')
            ->orderBy('a.tgl_masuk');

        $results = $query->get();

        $data = $results->map(function ($item) {
            $nasabah = '';
            switch ($item->kode_kelompok) {
                case '1': $nasabah = 'Umum';
                    break;
                case '3': $nasabah = 'Asuransi';
                    break;
                case '5': $nasabah = 'PERUSAHAAN';
                    break;
                case '10': $nasabah = 'JAMKESDA';
                    break;
                case '9': $nasabah = 'BPJS PBI';
                    break;
                case '8': $nasabah = 'BPJS Ketenagakerjaan';
                    break;
                case '11': $nasabah = 'BPJS COB';
                    break;
                case '12': $nasabah = 'BPJS NON PBI';
                    break;
                default: $nasabah = 'Lainnya';
                    break;
            }

            if ($item->kode_perusahaan) {
                $perusahaan = DB::table('mt_perusahaan')->where('kode_perusahaan', $item->kode_perusahaan)->first();
                if ($perusahaan) {
                    $nasabah .= ' - '.$perusahaan->nama_perusahaan;
                }
            }

            $umur = DB::table('tc_registrasi')->where('no_registrasi', $item->no_registrasi)->value('umur');

            return [
                'nasabah_group' => $nasabah,
                'no_mr' => $item->no_mr,
                'nama_pasien' => $item->nama_pasien,
                'umur' => $umur,
                'ruang' => $item->nama_bagian,
                'kamar' => $item->kode_ruangan,
                'kelas' => $item->nama_klas,
                'tgl_masuk' => $item->tgl_masuk,
                'diagnosa_awal' => $item->diagnosa_awal,
                'dr_merawat' => DB::table('tc_dpjp_rinap_v')->where('no_registrasi', $item->no_registrasi)->value('nama_dokter_merawat'),
            ];
        })->groupBy('nasabah_group');

        $periode = 'Tanggal '.Carbon::parse($tglAwal)->format('d F Y').' s/d '.Carbon::parse($tglAkhir)->format('d F Y');

        if ($opsiCetak == '2') {
            header('Content-type: application/vnd-ms-excel');
            header('Content-Disposition: attachment; filename=Lap_Kunjungan_RI_Nasabah.xls');
        }

        return view('laporan.registrasi.kunjungan.ri_nasabah', compact('data', 'periode', 'opsiCetak'));
    }

    // 7. Sensus Agama
    public function cetakSensusAgama(Request $request)
    {
        $bulan = $request->input('bulan', date('n'));
        $tahun = $request->input('tahun', date('Y'));
        $opsiCetak = $request->input('opsi_cetak', '1');

        $data = DB::table('sensus_pasien_agama_v')
            ->select('agama', DB::raw('SUM(jumlah) as jumlah'))
            ->where('bln', $bulan)
            ->where('thn', $tahun)
            ->groupBy('agama')
            ->orderBy('jumlah', 'desc')
            ->get()
            ->map(function ($item) {
                return [
                    'agama' => $item->agama ?: 'Tidak Teridentifikasi',
                    'jumlah' => $item->jumlah,
                ];
            });

        $periode = 'Bulan '.Carbon::create()->month($bulan)->locale('id')->monthName.' '.$tahun;

        if ($opsiCetak == '2') {
            header('Content-type: application/vnd-ms-excel');
            header('Content-Disposition: attachment; filename=Lap_Sensus_Agama.xls');
        }

        return view('laporan.registrasi.kunjungan.agama', compact('data', 'periode', 'opsiCetak'));
    }

    // 8. Sensus Wilayah (Kec/Kel)
    public function cetakSensusWilayah(Request $request)
    {
        $bulan = $request->input('bulan', date('n'));
        $tahun = $request->input('tahun', date('Y'));
        $opsiCetak = $request->input('opsi_cetak', '1');

        $data = DB::table('tc_registrasi as a')
            ->join('mt_master_pasien as b', 'a.no_mr', '=', 'b.no_mr')
            ->join('dc_kelurahan as c', 'b.id_dc_kelurahan', '=', 'c.id_dc_kelurahan')
            ->whereNull('a.status_batal')
            ->whereMonth('a.tgl_jam_masuk', $bulan)
            ->whereYear('a.tgl_jam_masuk', $tahun)
            ->select('c.nama_kelurahan', DB::raw('COUNT(a.no_registrasi) as jumlah'))
            ->groupBy('c.id_dc_kelurahan', 'c.nama_kelurahan')
            ->orderBy('jumlah', 'desc')
            ->get();

        $periode = 'Bulan '.Carbon::create()->month($bulan)->locale('id')->monthName.' '.$tahun;

        if ($opsiCetak == '2') {
            header('Content-type: application/vnd-ms-excel');
            header('Content-Disposition: attachment; filename=Lap_Sensus_Wilayah.xls');
        }

        return view('laporan.registrasi.kunjungan.wilayah', compact('data', 'periode', 'opsiCetak'));
    }

    // 9. Sensus Dusun
    public function cetakSensusDusun(Request $request)
    {
        $bulan = $request->input('bulan', date('n'));
        $tahun = $request->input('tahun', date('Y'));
        $opsiCetak = $request->input('opsi_cetak', '1');

        $data = DB::table('tc_registrasi as a')
            ->join('mt_master_pasien as b', 'a.no_mr', '=', 'b.no_mr')
            ->whereNull('a.status_batal')
            ->whereMonth('a.tgl_jam_masuk', $bulan)
            ->whereYear('a.tgl_jam_masuk', $tahun)
            ->whereNotNull('b.almt_ttp_pasien')
            ->where('b.almt_ttp_pasien', '!=', '')
            ->select('b.almt_ttp_pasien as dusun', DB::raw('COUNT(a.no_registrasi) as jumlah'))
            ->groupBy('b.almt_ttp_pasien')
            ->orderBy('jumlah', 'desc')
            ->limit(100) // Batasi ke 100 teratas agar rapi
            ->get();

        $periode = 'Bulan '.Carbon::create()->month($bulan)->locale('id')->monthName.' '.$tahun;

        if ($opsiCetak == '2') {
            header('Content-type: application/vnd-ms-excel');
            header('Content-Disposition: attachment; filename=Lap_Sensus_Dusun.xls');
        }

        return view('laporan.registrasi.kunjungan.dusun', compact('data', 'periode', 'opsiCetak'));
    }

    // 10. Sensus Umur
    public function cetakSensusUmur(Request $request)
    {
        $bulan = $request->input('bulan', date('n'));
        $tahun = $request->input('tahun', date('Y'));
        $opsiCetak = $request->input('opsi_cetak', '1');

        $results = DB::table('sensus_pasien_umur_v')
            ->select('umur', 'selisih', DB::raw('SUM(jumlah) as jumlah'))
            ->where('bln', $bulan)
            ->where('thn', $tahun)
            ->groupBy('umur', 'selisih')
            ->get();

        $usia_groups = [
            '0 - 28 hari' => 0,
            '28 hari - < 1 thn' => 0,
            '1 - 4 thn' => 0,
            '5 - 14 thn' => 0,
            '15 - 24 thn' => 0,
            '25 - 44 thn' => 0,
            '45 - 64 thn' => 0,
            '> 65 thn' => 0,
            'Tidak Teridentifikasi' => 0,
        ];

        foreach ($results as $row) {
            $umur = $row->umur;
            $selisih = $row->selisih;
            $jumlah = $row->jumlah;

            if ($selisih >= 0 && $selisih < 28) {
                $usia_groups['0 - 28 hari'] += $jumlah;
            } elseif ($selisih >= 28 && $selisih < 360) {
                $usia_groups['28 hari - < 1 thn'] += $jumlah;
            } elseif ($umur >= 1 && $umur <= 4) {
                $usia_groups['1 - 4 thn'] += $jumlah;
            } elseif ($umur >= 5 && $umur <= 14) {
                $usia_groups['5 - 14 thn'] += $jumlah;
            } elseif ($umur >= 15 && $umur <= 24) {
                $usia_groups['15 - 24 thn'] += $jumlah;
            } elseif ($umur >= 25 && $umur <= 44) {
                $usia_groups['25 - 44 thn'] += $jumlah;
            } elseif ($umur >= 45 && $umur <= 64) {
                $usia_groups['45 - 64 thn'] += $jumlah;
            } elseif ($umur >= 65) {
                $usia_groups['> 65 thn'] += $jumlah;
            } else {
                $usia_groups['Tidak Teridentifikasi'] += $jumlah;
            }
        }

        $periode = 'Bulan '.Carbon::create()->month($bulan)->locale('id')->monthName.' '.$tahun;

        if ($opsiCetak == '2') {
            header('Content-type: application/vnd-ms-excel');
            header('Content-Disposition: attachment; filename=Lap_Sensus_Umur.xls');
        }

        return view('laporan.registrasi.kunjungan.umur', compact('usia_groups', 'periode', 'opsiCetak'));
    }
}
