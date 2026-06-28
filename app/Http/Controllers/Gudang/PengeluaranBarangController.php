<?php

namespace App\Http\Controllers\Gudang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class PengeluaranBarangController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = DB::table('tc_permintaan_inst_nm')
            ->leftJoin('mt_bagian', 'tc_permintaan_inst_nm.kode_bagian_minta', '=', 'mt_bagian.kode_bagian')
            ->leftJoin('mt_karyawan', 'tc_permintaan_inst_nm.id_dd_user', '=', 'mt_karyawan.no_induk')
            ->select(
                'tc_permintaan_inst_nm.*',
                'mt_bagian.nama_bagian',
                'mt_karyawan.nama_pegawai'
            )
            ->where('tc_permintaan_inst_nm.kode_bagian_kirim', '070101');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('tc_permintaan_inst_nm.nomor_permintaan', 'like', "%{$search}%")
                  ->orWhere('mt_bagian.nama_bagian', 'like', "%{$search}%");
            });
        }

        $pengeluaran = $query->orderBy('tc_permintaan_inst_nm.tgl_permintaan', 'desc')
                             ->paginate(20)
                             ->withQueryString();

        return Inertia::render('Gudang/PengeluaranBarang/Index', [
            'pengeluaran' => $pengeluaran,
            'filters' => ['search' => $search]
        ]);
    }

    public function create()
    {
        $bagian = DB::table('mt_bagian')
            ->where('status_aktif', 1)
            ->orWhereNull('status_aktif')
            ->select('kode_bagian', 'nama_bagian')
            ->orderBy('nama_bagian', 'asc')
            ->get();

        return Inertia::render('Gudang/PengeluaranBarang/Form', [
            'bagian' => $bagian
        ]);
    }

    public function apiSearchBarang(Request $request)
    {
        $search = $request->input('q');
        
        $query = DB::table('mt_barang_jasa')
            ->join('mt_depo_stok_brg_jasa', 'mt_barang_jasa.kode_brg', '=', 'mt_depo_stok_brg_jasa.kode_brg')
            ->where('mt_depo_stok_brg_jasa.kode_bagian', '070101')
            ->where('mt_depo_stok_brg_jasa.jml_sat_kcl', '>', 0)
            ->select(
                'mt_barang_jasa.kode_brg',
                'mt_barang_jasa.nama_brg',
                'mt_barang_jasa.satuan_kecil',
                'mt_depo_stok_brg_jasa.jml_sat_kcl as stok'
            );

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('mt_barang_jasa.kode_brg', 'like', "%{$search}%")
                  ->orWhere('mt_barang_jasa.nama_brg', 'like', "%{$search}%");
            });
        }

        return response()->json($query->limit(20)->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_bagian_minta' => 'required',
            'tgl_permintaan' => 'required|date',
            'keterangan_kirim' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.kode_brg' => 'required',
            'items.*.jumlah' => 'required|numeric|min:0.1'
        ]);

        $id_dd_user = Session::get('id_dd_user') ?: (auth()->user() ? auth()->user()->id_dd_user : 'SYSTEM');
        
        try {
            DB::beginTransaction();

            // Generate nomor pengeluaran PB-YYYYMMDD-XXXX
            $datePrefix = date('Ymd');
            $lastData = DB::table('tc_permintaan_inst_nm')
                ->where('nomor_permintaan', 'like', "PB-{$datePrefix}-%")
                ->orderBy('nomor_permintaan', 'desc')
                ->first();

            if ($lastData) {
                $lastNum = (int) substr($lastData->nomor_permintaan, -4);
                $newNum = str_pad($lastNum + 1, 4, '0', STR_PAD_LEFT);
            } else {
                $newNum = '0001';
            }
            $nomor_permintaan = "PB-{$datePrefix}-{$newNum}";

            // Insert Header
            $id_tc_permintaan_inst = DB::table('tc_permintaan_inst_nm')->insertGetId([
                'nomor_permintaan' => $nomor_permintaan,
                'tgl_permintaan' => Carbon::parse($request->tgl_permintaan),
                'kode_bagian_minta' => $request->kode_bagian_minta,
                'kode_bagian_kirim' => '070101',
                'status_batal' => 0,
                'tgl_input' => now(),
                'id_dd_user' => $id_dd_user,
                'tgl_pengiriman' => now(), // Auto complete direct issue
                'yg_serah' => $id_dd_user,
                'keterangan_kirim' => $request->keterangan_kirim
            ]);

            // Insert Detail & Kurangi Stok & Kartu Stok
            foreach ($request->items as $item) {
                $stokExist = DB::table('mt_depo_stok_brg_jasa')
                    ->where('kode_brg', $item['kode_brg'])
                    ->where('kode_bagian', '070101')
                    ->lockForUpdate()
                    ->first();

                if (!$stokExist || $stokExist->jml_sat_kcl < $item['jumlah']) {
                    throw new \Exception("Stok tidak mencukupi untuk barang " . $item['kode_brg']);
                }

                $stok_awal = (float) $stokExist->jml_sat_kcl;
                $jumlah = (float) $item['jumlah'];
                $stok_akhir = $stok_awal - $jumlah;

                // Detail Permintaan
                DB::table('tc_permintaan_inst_nm_det')->insert([
                    'id_tc_permintaan_inst' => $id_tc_permintaan_inst,
                    'kode_brg' => $item['kode_brg'],
                    'jumlah_permintaan' => $item['jumlah'],
                    'jumlah_penerimaan' => $item['jumlah'], // Asumsi diterima full
                    'satuan' => $item['satuan_kecil'] ?? '',
                    'tgl_kirim' => now(),
                    'tgl_input' => now(),
                    'id_dd_user' => $id_dd_user,
                ]);

                // Update Stok Asal (070101)
                DB::table('mt_depo_stok_brg_jasa')
                    ->where('kode_brg', $item['kode_brg'])
                    ->where('kode_bagian', '070101')
                    ->update(['jml_sat_kcl' => $stok_akhir]);

                // Kartu Stok Log Asal
                $keterangan_asal = "Pengeluaran Internal ke Bagian: " . $request->kode_bagian_minta . " (No: " . $nomor_permintaan . ")";
                DB::table('tc_kartu_stok_brg_jasa')->insert([
                    'tgl_input' => now(),
                    'kode_brg' => $item['kode_brg'],
                    'stok_awal' => $stok_awal,
                    'pemasukan' => 0,
                    'pengeluaran' => $jumlah,
                    'stok_akhir' => $stok_akhir,
                    'jenis_transaksi' => 8, // Pengeluaran Internal
                    'kode_bagian' => '070101',
                    'petugas' => $id_dd_user,
                    'keterangan' => $keterangan_asal,
                ]);

                // Update Stok Tujuan (Bagian Peminta)
                $stokTujuanExist = DB::table('mt_depo_stok_brg_jasa')
                    ->where('kode_brg', $item['kode_brg'])
                    ->where('kode_bagian', $request->kode_bagian_minta)
                    ->lockForUpdate()
                    ->first();

                $stok_awal_tujuan = $stokTujuanExist ? (float) $stokTujuanExist->jml_sat_kcl : 0;
                $stok_akhir_tujuan = $stok_awal_tujuan + $jumlah;

                if ($stokTujuanExist) {
                    DB::table('mt_depo_stok_brg_jasa')
                        ->where('kode_brg', $item['kode_brg'])
                        ->where('kode_bagian', $request->kode_bagian_minta)
                        ->update(['jml_sat_kcl' => $stok_akhir_tujuan]);
                } else {
                    DB::table('mt_depo_stok_brg_jasa')->insert([
                        'kode_brg' => $item['kode_brg'],
                        'kode_bagian' => $request->kode_bagian_minta,
                        'jml_sat_kcl' => $stok_akhir_tujuan
                    ]);
                }

                // Kartu Stok Log Tujuan
                $keterangan_tujuan = "Penerimaan Internal dari Gudang (070101) (No: " . $nomor_permintaan . ")";
                DB::table('tc_kartu_stok_brg_jasa')->insert([
                    'tgl_input' => now(),
                    'kode_brg' => $item['kode_brg'],
                    'stok_awal' => $stok_awal_tujuan,
                    'pemasukan' => $jumlah,
                    'pengeluaran' => 0,
                    'stok_akhir' => $stok_akhir_tujuan,
                    'jenis_transaksi' => 9, // Penerimaan Internal
                    'kode_bagian' => $request->kode_bagian_minta,
                    'petugas' => $id_dd_user,
                    'keterangan' => $keterangan_tujuan,
                ]);
            }

            DB::commit();
            return redirect()->route('gudang.pengeluaran-barang.index')->with('success', 'Pengeluaran barang berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memproses pengeluaran: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $pengeluaran = DB::table('tc_permintaan_inst_nm')
            ->leftJoin('mt_bagian', 'tc_permintaan_inst_nm.kode_bagian_minta', '=', 'mt_bagian.kode_bagian')
            ->leftJoin('mt_karyawan', 'tc_permintaan_inst_nm.id_dd_user', '=', 'mt_karyawan.no_induk')
            ->select(
                'tc_permintaan_inst_nm.*',
                'mt_bagian.nama_bagian',
                'mt_karyawan.nama_pegawai'
            )
            ->where('tc_permintaan_inst_nm.id_tc_permintaan_inst', $id)
            ->first();

        if (!$pengeluaran) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $items = DB::table('tc_permintaan_inst_nm_det')
            ->leftJoin('mt_barang_jasa', 'tc_permintaan_inst_nm_det.kode_brg', '=', 'mt_barang_jasa.kode_brg')
            ->select(
                'tc_permintaan_inst_nm_det.*',
                'mt_barang_jasa.nama_brg'
            )
            ->where('tc_permintaan_inst_nm_det.id_tc_permintaan_inst', $id)
            ->get();

        return response()->json([
            'pengeluaran' => $pengeluaran,
            'items' => $items
        ]);
    }
}
