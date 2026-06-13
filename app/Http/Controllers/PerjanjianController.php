<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class PerjanjianController extends Controller
{
    public function perjanjianPasien(Request $request)
    {
        $topik = $request->input('topik', 'nama');
        $filter = $request->input('filter', '');

        $query = DB::table('tc_pesanan as a')
            ->join('mt_bagian as b', 'a.kode_bagian', '=', 'b.kode_bagian')
            ->join('mt_karyawan as c', 'a.kode_dokter', '=', 'c.kode_dokter')
            ->whereNull('a.tgl_masuk');

        if ($filter !== '') {
            switch ($topik) {
                case 'nama':
                    $query->where('a.nama', 'like', '%' . $filter . '%');
                    break;
                case 'mr':
                    $query->where('a.no_mr', $filter);
                    break;
                case 'bagian':
                    $query->where('b.nama_bagian', 'like', '%' . $filter . '%');
                    break;
                case 'dokter':
                    $query->where('c.nama_pegawai', 'like', '%' . $filter . '%');
                    break;
            }
        } else {
            $query->whereDate('a.tgl_pesanan', date('Y-m-d'));
        }

        $perjanjian = $query->select('a.*', 'b.nama_bagian', 'c.nama_pegawai')
            ->paginate(20)
            ->withQueryString();

        return Inertia::render('Registrasi/PerjanjianPasien', [
            'perjanjian' => $perjanjian,
            'filters' => [
                'topik' => $topik,
                'filter' => $filter,
            ]
        ]);
    }

    public function daftarPerjanjian(Request $request)
    {
        $topik = $request->input('topik', 'nama');
        $filter = $request->input('filter', '');

        $query = DB::table('rg_master_pasien_v')
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('tc_pesanan')
                    ->whereColumn('tc_pesanan.no_mr', 'rg_master_pasien_v.no_mr')
                    ->whereNull('tc_pesanan.tgl_masuk');
            })
            ->whereNull('id_mt_master_pasien');

        if ($filter !== '') {
            switch ($topik) {
                case 'nama':
                    $query->where('nama_pasien', 'like', '%' . $filter . '%');
                    break;
                case 'mr':
                    $query->where('no_mr', $filter);
                    break;
                case 'nasabah':
                    $query->where(function($q) use ($filter) {
                        $q->where('nasabah', 'like', '%' . $filter . '%')
                          ->orWhere('perusahaan', 'like', '%' . $filter . '%');
                    });
                    break;
                case 'alamat':
                    $query->where('almt_ttp_pasien', 'like', '%' . $filter . '%');
                    break;
                case 'ktp':
                    $query->where('no_ktp', 'like', '%' . $filter . '%');
                    break;
                case 'telpon':
                    $query->where('tlp_almt_ttp', 'like', '%' . $filter . '%');
                    break;
            }
        }

        $daftar = $query->orderBy('no_mr')
            ->paginate(20)
            ->withQueryString();

        return Inertia::render('Registrasi/DaftarPerjanjian', [
            'daftar' => $daftar,
            'filters' => [
                'topik' => $topik,
                'filter' => $filter,
            ]
        ]);
    }
}
