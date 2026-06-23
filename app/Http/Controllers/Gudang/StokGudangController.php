<?php

namespace App\Http\Controllers\Gudang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Facades\Session;

class StokGudangController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = DB::table('mt_barang_jasa')
            ->leftJoin('mt_depo_stok_brg_jasa', function ($join) {
                $join->on('mt_barang_jasa.kode_brg', '=', 'mt_depo_stok_brg_jasa.kode_brg')
                     ->where('mt_depo_stok_brg_jasa.kode_bagian', '070101');
            })
            ->select(
                'mt_barang_jasa.kode_brg',
                'mt_barang_jasa.nama_brg',
                'mt_barang_jasa.satuan_kecil',
                DB::raw('COALESCE(mt_depo_stok_brg_jasa.jml_sat_kcl, 0) as stok')
            )
            ->where(function($q) {
                $q->where('mt_barang_jasa.status', 1)
                  ->orWhereNull('mt_barang_jasa.status');
            });

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('mt_barang_jasa.kode_brg', 'like', "%{$search}%")
                  ->orWhere('mt_barang_jasa.nama_brg', 'like', "%{$search}%");
            });
        }

        $barang = $query->paginate(20)->withQueryString();

        return Inertia::render('Gudang/StokGudang/Index', [
            'barang' => $barang,
            'filters' => ['search' => $search]
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_brg' => 'required',
            'stok_aktual' => 'required|numeric|min:0',
        ]);

        $kode_brg = $request->kode_brg;
        $stok_aktual = $request->stok_aktual;
        $kode_bagian = '070101';

        try {
            DB::beginTransaction();

            $stokExist = DB::table('mt_depo_stok_brg_jasa')
                ->where('kode_brg', $kode_brg)
                ->where('kode_bagian', $kode_bagian)
                ->first();

            $stok_awal = $stokExist ? $stokExist->jml_sat_kcl : 0;
            $selisih = $stok_aktual - $stok_awal;

            if ($selisih == 0) {
                DB::rollBack();
                return redirect()->back()->with('success', 'Tidak ada perubahan stok.');
            }

            // Update atau Insert ke mt_depo_stok_brg_jasa
            if ($stokExist) {
                DB::table('mt_depo_stok_brg_jasa')
                    ->where('kode_brg', $kode_brg)
                    ->where('kode_bagian', $kode_bagian)
                    ->update(['jml_sat_kcl' => $stok_aktual]);
            } else {
                DB::table('mt_depo_stok_brg_jasa')->insert([
                    'kode_brg' => $kode_brg,
                    'kode_bagian' => $kode_bagian,
                    'jml_sat_kcl' => $stok_aktual,
                ]);
            }

            // Kartu Stok Log
            $jenis_transaksi = 4;
            $jenis = DB::table('mt_jenis_kartu_stok')->where('jenis_transaksi', $jenis_transaksi)->first();
            $keterangan = $jenis ? $jenis->nama_jenis : 'Stok Opname';

            $pemasukan = $selisih > 0 ? $selisih : 0;
            $pengeluaran = $selisih < 0 ? abs($selisih) : 0;

            $id_dd_user = Session::get('id_dd_user');
            if (!$id_dd_user) {
                $id_dd_user = auth()->user() ? auth()->user()->id_dd_user : 'SYSTEM';
            }

            DB::table('tc_kartu_stok_brg_jasa')->insert([
                'tgl_input' => now(),
                'kode_brg' => $kode_brg,
                'stok_awal' => $stok_awal,
                'pemasukan' => $pemasukan,
                'pengeluaran' => $pengeluaran,
                'stok_akhir' => $stok_aktual,
                'jenis_transaksi' => $jenis_transaksi,
                'kode_bagian' => $kode_bagian,
                'petugas' => $id_dd_user,
                'keterangan' => $keterangan,
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Stok berhasil disesuaikan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal update stok: ' . $e->getMessage());
        }
    }
}
