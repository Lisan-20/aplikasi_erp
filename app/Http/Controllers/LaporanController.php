<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function kinerjaIndex(Request $request)
    {
        $karyawan = DB::table('mt_karyawan')
            ->select('no_induk', 'nama_pegawai')
            ->where('kode_bagian', '300001')
            ->where('status', '0')
            ->get();
            
        $shift = DB::table('ks_mt_shift')
            ->select('kode_shift', 'nama_shift')
            ->orderBy('nama_shift')
            ->get();
            
        $asal_pasien = DB::table('dc_asal_pasien')
            ->select('id_dc_asal_pasien', 'asal_pasien')
            ->get();

        return Inertia::render('Laporan/Kinerja', [
            'karyawan' => $karyawan,
            'shift' => $shift,
            'asal_pasien' => $asal_pasien,
        ]);
    }

    public function cetakKinerjaRegistrasi(Request $request)
    {
        $tgl_awal = $request->tgl_awal;
        $tgl_akhir = $request->tgl_akhir;
        $instalasinya = $request->instalasinya;
        $no_induk = $request->no_induk;
        $kode_shift = $request->kode_shift;

        $shift = null;
        if ($kode_shift) {
            $shift = DB::table('ks_mt_shift')->where('kode_shift', $kode_shift)->first();
        }

        $jam_awal = $shift ? substr($shift->dari_jam, 0, 8) : '00:00:00';
        $jam_akhir = $shift ? substr($shift->sampai_jam, 0, 8) : '23:59:59';
        
        $start_date = $tgl_awal . ' ' . $jam_awal;
        $end_date = $tgl_akhir . ' ' . $jam_akhir;

        $query = DB::table('tc_registrasi as a')
            ->join('mt_master_pasien as b', 'a.no_mr', '=', 'b.no_mr')
            ->join('mt_bagian as c', 'a.kode_bagian_masuk', '=', 'c.kode_bagian')
            ->select(
                'c.nama_bagian',
                DB::raw('COUNT(a.no_registrasi) as jumlah_pasien'),
                DB::raw('SUM(CASE WHEN b.kode_kelompok = 1 THEN 1 ELSE 0 END) as pribadi'),
                DB::raw('SUM(CASE WHEN b.kode_kelompok = 3 THEN 1 ELSE 0 END) as asuransi'),
                DB::raw('SUM(CASE WHEN b.kode_kelompok = 5 THEN 1 ELSE 0 END) as perusahaan'),
                DB::raw('SUM(CASE WHEN b.kode_kelompok = 10 THEN 1 ELSE 0 END) as jamkesda'),
                DB::raw('SUM(CASE WHEN b.kode_kelompok = 9 THEN 1 ELSE 0 END) as bpjspbi'),
                DB::raw('SUM(CASE WHEN b.kode_kelompok = 12 THEN 1 ELSE 0 END) as bpjsnp'),
                DB::raw('SUM(CASE WHEN b.kode_kelompok = 11 THEN 1 ELSE 0 END) as bpjscob'),
                DB::raw('SUM(CASE WHEN b.kode_kelompok = 8 THEN 1 ELSE 0 END) as jampersal'),
                DB::raw('SUM(CASE WHEN b.jen_kelamin = \'L\' THEN 1 ELSE 0 END) as laki'),
                DB::raw('SUM(CASE WHEN b.jen_kelamin = \'P\' THEN 1 ELSE 0 END) as perempuan'),
                DB::raw('SUM(CASE WHEN b.nama_ayah IS NOT NULL AND b.nama_ayah != \'\' THEN 1 ELSE 0 END) as anak'),
                DB::raw('SUM(CASE WHEN b.nama_ayah IS NULL OR b.nama_ayah = \'\' THEN 1 ELSE 0 END) as dewasa'),
                DB::raw('SUM(CASE WHEN a.stat_pasien != \'Baru\' THEN 1 ELSE 0 END) as lama'),
                DB::raw('SUM(CASE WHEN a.stat_pasien = \'Baru\' THEN 1 ELSE 0 END) as baru')
            )
            ->whereNull('a.status_batal')
            ->whereBetween('a.tgl_jam_masuk', [$start_date, $end_date])
            ->where('c.status_aktif', 1)
            ->where('c.group_bag', 'Detail');

        if ($instalasinya) {
            $query->where('c.validasi', $instalasinya);
        } else {
            $query->whereIn('c.validasi', ['010001', '050001', '030001']);
        }

        if ($no_induk) {
            $query->where('a.no_induk', $no_induk);
        }

        $data = $query->groupBy('c.nama_bagian')->orderBy('c.nama_bagian')->get();

        $nama_petugas = 'Semua Petugas';
        if ($no_induk) {
            $petugas = DB::table('mt_karyawan')->where('no_induk', $no_induk)->first();
            if ($petugas) $nama_petugas = $petugas->nama_pegawai;
        }

        $instalasi_lap = 'Semua Instalasi';
        if ($instalasinya) {
            $inst = DB::table('mt_bagian')->where('kode_bagian', $instalasinya)->first();
            if ($inst) $instalasi_lap = $inst->nama_bagian;
        }

        return view('laporan.kinerja_registrasi', compact('data', 'start_date', 'end_date', 'nama_petugas', 'shift', 'instalasi_lap'));
    }

    public function cetakKinerjaBatal(Request $request)
    {
        $kategori = $request->kategori ?? '1';
        $frekuensi = $request->frekuensi ?? '1';
        $tanggal = $request->tanggal;
        
        $start_date = '';
        $end_date = '';
        $periodeStr = '';

        if ($frekuensi == '1') {
            $start_date = $tanggal . ' 05:00:00';
            $end_date = Carbon::parse($tanggal)->addDay()->format('Y-m-d') . ' 05:59:59';
            $periodeStr = "Tanggal " . Carbon::parse($tanggal)->translatedFormat('d F Y');
        } elseif ($frekuensi == '2') {
            $start_date = Carbon::parse($tanggal)->startOfMonth()->format('Y-m-d') . ' 00:00:00';
            $end_date = Carbon::parse($tanggal)->endOfMonth()->format('Y-m-d') . ' 23:59:59';
            $periodeStr = "Bulan " . Carbon::parse($tanggal)->translatedFormat('F Y');
        } else {
            $start_date = Carbon::parse($tanggal)->startOfYear()->format('Y-m-d') . ' 00:00:00';
            $end_date = Carbon::parse($tanggal)->endOfYear()->format('Y-m-d') . ' 23:59:59';
            $periodeStr = "Tahun " . Carbon::parse($tanggal)->translatedFormat('Y');
        }

        $query = DB::table('tc_registrasi as a')
            ->join('mt_master_pasien as b', 'a.no_mr', '=', 'b.no_mr')
            ->join('mt_bagian as c', 'a.kode_bagian_masuk', '=', 'c.kode_bagian')
            ->select(
                'c.nama_bagian',
                DB::raw('COUNT(a.no_registrasi) as jumlah_pasien'),
                DB::raw('SUM(CASE WHEN b.kode_kelompok = 1 THEN 1 ELSE 0 END) as pribadi'),
                DB::raw('SUM(CASE WHEN b.kode_kelompok = 3 THEN 1 ELSE 0 END) as asuransi'),
                DB::raw('SUM(CASE WHEN b.kode_kelompok = 5 THEN 1 ELSE 0 END) as perusahaan'),
                DB::raw('SUM(CASE WHEN b.kode_kelompok = 10 THEN 1 ELSE 0 END) as jamkesda'),
                DB::raw('SUM(CASE WHEN b.kode_kelompok = 9 THEN 1 ELSE 0 END) as bpjspbi'),
                DB::raw('SUM(CASE WHEN b.kode_kelompok = 12 THEN 1 ELSE 0 END) as bpjsnp'),
                DB::raw('SUM(CASE WHEN b.kode_kelompok = 11 THEN 1 ELSE 0 END) as bpjscob'),
                DB::raw('SUM(CASE WHEN b.kode_kelompok = 8 THEN 1 ELSE 0 END) as jampersal'),
                DB::raw('SUM(CASE WHEN b.jen_kelamin = \'L\' THEN 1 ELSE 0 END) as laki'),
                DB::raw('SUM(CASE WHEN b.jen_kelamin = \'P\' THEN 1 ELSE 0 END) as perempuan'),
                DB::raw('SUM(CASE WHEN b.nama_ayah IS NOT NULL AND b.nama_ayah != \'\' THEN 1 ELSE 0 END) as anak'),
                DB::raw('SUM(CASE WHEN b.nama_ayah IS NULL OR b.nama_ayah = \'\' THEN 1 ELSE 0 END) as dewasa'),
                DB::raw('SUM(CASE WHEN a.stat_pasien != \'Baru\' THEN 1 ELSE 0 END) as lama'),
                DB::raw('SUM(CASE WHEN a.stat_pasien = \'Baru\' THEN 1 ELSE 0 END) as baru')
            )
            ->whereNotNull('a.status_batal')
            ->whereBetween('a.tgl_jam_masuk', [$start_date, $end_date])
            ->where('c.status_aktif', 1)
            ->where('c.group_bag', 'Detail')
            ->where('c.kode_bagian', '!=', '030212');

        if ($kategori == '2') {
            $query->whereIn('c.validasi', ['010001', '050001']);
        } elseif ($kategori == '3') {
            $query->where('c.validasi_lap_rm', '0300011');
        } elseif ($kategori == '4') {
            $query->where('c.validasi_lap_rm', '0300013');
        } elseif ($kategori == '5') {
            $query->where('c.validasi_lap_rm', '03000113');
        } elseif ($kategori == '6') {
            $query->where('c.validasi_lap_rm', '0300014');
        } elseif ($kategori == '7') {
            $query->where('c.validasi_lap_rm', '03000112');
        } else {
            $query->whereIn('c.validasi', ['010001', '050001', '030001']);
        }

        $data = $query->groupBy('c.nama_bagian')->orderBy('c.nama_bagian')->get();

        return view('laporan.kinerja_batal', compact('data', 'periodeStr'));
    }

    public function cetakKinerjaRujukan(Request $request)
    {
        $id_dc_asal_pasien = $request->id_dc_asal_pasien;
        $tgl_awal = $request->tgl_awal . ' 00:00:00';
        $tgl_akhir = $request->tgl_akhir . ' 23:59:59';
        
        $periodeStr = Carbon::parse($request->tgl_awal)->format('d-m-Y') . ' s/d ' . Carbon::parse($request->tgl_akhir)->format('d-m-Y');

        $query = DB::table('lap_jasa_kirim_v')
            ->whereBetween('tgl_jam_masuk', [$tgl_awal, $tgl_akhir]);

        if ($id_dc_asal_pasien) {
            $query->where('id_dc_asal_pasien', $id_dc_asal_pasien);
        } else {
            $query->whereNotIn('id_dc_asal_pasien', [3]);
        }

        $data = $query->orderBy('detail')->orderBy('tgl_jam_masuk')->get();

        foreach ($data as $item) {
            $bagian = DB::table('mt_bagian')->where('kode_bagian', $item->kode_bagian_masuk)->first();
            $item->nama_bagian = $bagian ? $bagian->nama_bagian : '';

            $pasien = DB::table('mt_master_pasien')->where('no_mr', $item->no_mr)->first();
            $item->wilayah = $pasien ? $pasien->almt_ttp_pasien : '';

            $tindakan = DB::table('tc_trans_pelayanan')
                ->where('no_registrasi', $item->no_registrasi)
                ->where('jenis_tindakan', '4')
                ->whereNull('status_batal')
                ->whereIn('kode_bagian', ['030501', '030901'])
                ->first();
            
            if ($tindakan) {
                $explode = explode("-", $tindakan->nama_tindakan);
                $item->tindakan = $explode[0];
            } else {
                $item->tindakan = '';
            }
        }

        $asal_pasien_str = 'Semua (Selain Datang Sendiri)';
        if ($id_dc_asal_pasien) {
            $asal = DB::table('dc_asal_pasien')->where('id_dc_asal_pasien', $id_dc_asal_pasien)->first();
            if ($asal) $asal_pasien_str = $asal->asal_pasien;
        }

        return view('laporan.kinerja_rujukan', compact('data', 'periodeStr', 'asal_pasien_str'));
    }
}
