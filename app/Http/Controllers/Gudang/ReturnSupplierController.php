<?php

namespace App\Http\Controllers\Gudang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Carbon\Carbon;

class ReturnSupplierController extends Controller
{
    public function index(Request $request)
    {
        // Tab 1: LPB yang bisa diretur (kita ambil dari tc_penerimaan_barang_nm)
        $searchLpb = $request->input('search_lpb');
        $queryLpb = DB::table('tc_penerimaan_barang_nm as a')
            ->leftJoin('mt_erp_supplier as b', 'a.kodesupplier', '=', 'b.id')
            ->select(
                'a.id_tc_penerimaan_brg_nm',
                'a.kode_penerimaan',
                'a.no_po',
                'a.no_faktur',
                'a.tgl_penerimaan',
                'a.petugas',
                'b.nama_supplier as namasupplier'
            )
            ->orderBy('a.tgl_penerimaan', 'desc');

        if ($searchLpb) {
            $queryLpb->where(function ($q) use ($searchLpb) {
                $q->where('a.kode_penerimaan', 'like', "%{$searchLpb}%")
                  ->orWhere('a.no_po', 'like', "%{$searchLpb}%")
                  ->orWhere('a.no_faktur', 'like', "%{$searchLpb}%");
            });
        }
        $lpb = $queryLpb->paginate(10, ['*'], 'lpb_page')->withQueryString();

        // Tab 2: Riwayat Retur (RB)
        $searchRb = $request->input('search_rb');
        $queryRb = DB::table('fr_gg_return_brg as a')
            ->select(
                'a.kode_return',
                'a.no_lpb',
                'a.no_po',
                'a.petugas',
                DB::raw('MAX(a.tgl_input) as tgl_return'),
                DB::raw('SUM(a.jumlah) as total_qty_return')
            )
            ->groupBy('a.kode_return', 'a.no_lpb', 'a.no_po', 'a.petugas')
            ->orderBy('tgl_return', 'desc');

        if ($searchRb) {
            $queryRb->having('a.kode_return', 'like', "%{$searchRb}%")
                    ->orHaving('a.no_lpb', 'like', "%{$searchRb}%");
        }
        
        // Because of having, we can't just use paginate directly on SQL Server without a subquery sometimes,
        // but let's just paginate it normally. If it fails, we will fix it.
        $rb = $queryRb->paginate(10, ['*'], 'rb_page')->withQueryString();

        return Inertia::render('Gudang/ReturnSupplier/Index', [
            'lpb' => $lpb,
            'rb' => $rb,
            'filters' => [
                'search_lpb' => $searchLpb,
                'search_rb' => $searchRb,
            ]
        ]);
    }

    public function create($id)
    {
        // Get LPB info
        $lpb = DB::table('tc_penerimaan_barang_nm as a')
            ->leftJoin('mt_erp_supplier as b', 'a.kodesupplier', '=', 'b.id')
            ->where('a.id_tc_penerimaan_brg_nm', $id)
            ->select('a.*', 'b.nama_supplier as namasupplier')
            ->first();

        if (!$lpb) {
            return redirect()->route('gudang.return-supplier.index')->with('error', 'LPB tidak ditemukan');
        }

        // Get details
        $details = DB::table('tc_penerimaan_barang_nm_detail as d')
            ->join('mt_barang_jasa as b', 'd.kode_brg', '=', 'b.kode_brg')
            ->where('d.kode_penerimaan', $lpb->kode_penerimaan)
            ->select(
                'd.kode_brg',
                'b.nama_brg',
                'd.jumlah_kirim as qty_terima',
                'd.satuan',
                'd.harga as harga_satuan',
                'd.id_tc_po_det'
            )
            ->get();

        // Calculate already returned qty for each item
        foreach ($details as $det) {
            $returned = DB::table('fr_gg_return_brg')
                ->where('no_lpb', $lpb->kode_penerimaan)
                ->where('kode_brg', $det->kode_brg)
                ->sum('jumlah');
            
            $det->qty_terima = $det->qty_terima - $returned; // This is the remaining qty that CAN be returned
            $det->qty_retur = 0;
            $det->alasan = '';
        }

        return Inertia::render('Gudang/ReturnSupplier/Form', [
            'lpb' => $lpb,
            'details' => $details
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'lpb.kode_penerimaan' => 'required',
            'items' => 'required|array',
            'items.*.qty_retur' => 'numeric|min:0'
        ]);

        try {
            DB::beginTransaction();
            $date = Carbon::now();
            $lpb = $request->lpb;
            
            // Generate RB number
            $countToday = DB::table('fr_gg_return_brg')
                ->whereDate('tgl_input', $date->toDateString())
                ->count(DB::raw('DISTINCT kode_return'));
            
            $rbNumber = 'RB-' . $date->format('Ymd') . '-' . str_pad($countToday + 1, 4, '0', STR_PAD_LEFT);

            $no_induk = session('no_induk');
            if (session('user')) {
                $no_induk = session('user')->no_induk ?? $no_induk;
            }
            $nama_pegawai = DB::table('mt_karyawan')->where('no_induk', $no_induk)->value('nama_pegawai') ?? 'System';
            
            $totalReturAmount = 0;

            foreach ($request->items as $item) {
                if ($item['qty_retur'] > 0) {
                    $max_id_return = DB::table('fr_gg_return_brg')->max('id_return');
                    $new_id_return = $max_id_return ? $max_id_return + 1 : 1;

                    // Insert into return table
                    DB::table('fr_gg_return_brg')->insert([
                        'id_return' => $new_id_return,
                        'tgl_input' => $date->toDateTimeString(),
                        'kode_brg' => $item['kode_brg'],
                        'kode_supplier' => $lpb['kodesupplier'],
                        'no_po' => $lpb['no_po'],
                        'no_lpb' => $lpb['kode_penerimaan'],
                        'jumlah' => $item['qty_retur'],
                        'petugas' => $nama_pegawai,
                        'ket' => $item['alasan'] ?? 'Retur ke supplier',
                        'kode_return' => $rbNumber,
                        'flag_jurnal' => 0
                    ]);

                    // Deduct stock in mt_depo_stok_brg_jasa
                    DB::table('mt_depo_stok_brg_jasa')
                        ->where('kode_brg', $item['kode_brg'])
                        ->where('kode_bagian', '070101')
                        ->decrement('jml_sat_kcl', $item['qty_retur']);

                    // Insert into tc_kartu_stok_brg_jasa (Mutasi Keluar)
                    $currentStok = (int) DB::table('mt_depo_stok_brg_jasa')
                        ->where('kode_brg', $item['kode_brg'])
                        ->where('kode_bagian', '070101')
                        ->value('jml_sat_kcl');

                    DB::table('tc_kartu_stok_brg_jasa')->insert([
                        'kode_brg' => $item['kode_brg'],
                        'kode_bagian' => '070101',
                        'tgl_input' => $date->toDateTimeString(),
                        'stok_awal' => $currentStok + (int)$item['qty_retur'],
                        'pemasukan' => 0,
                        'pengeluaran' => (int)$item['qty_retur'],
                        'stok_akhir' => $currentStok,
                        'jenis_transaksi' => 2, // 2 = Pengeluaran
                        'keterangan' => 'Retur Barang ke Supplier ' . ($lpb['namasupplier'] ?? '') . ' ' . $rbNumber . ' (LPB: ' . $lpb['kode_penerimaan'] . ')',
                        'petugas' => $no_induk ?? '1'
                    ]);

                    $totalReturAmount += ($item['qty_retur'] * $item['harga_satuan']);
                }
            }

            if ($totalReturAmount > 0) {
                // Potong hutang dengan membuat jurnal transaksi hutang minus
                $hutangAsli = DB::table('transaksi_hutang')->where('no_bukti', $lpb['kode_penerimaan'])->first();
                if ($hutangAsli) {
                    $max_id_hutang = DB::table('transaksi_hutang')->max('id_trans_hutang');
                    $new_id_hutang = $max_id_hutang ? $max_id_hutang + 1 : 1;

                    DB::table('transaksi_hutang')->insert([
                        'id_trans_hutang' => $new_id_hutang,
                        'tx_tipe' => $hutangAsli->tx_tipe,
                        'jumlah_transaksi' => -$totalReturAmount,
                        'no_bukti' => $rbNumber,
                        'tgl_transaksi' => $date->toDateTimeString(),
                        'keterangan' => 'Nota Retur untuk LPB: ' . $lpb['kode_penerimaan'],
                        'inp_tgl' => $date->toDateTimeString(),
                        'inp_id' => $hutangAsli->inp_id,
                        'kode_bagian' => $hutangAsli->kode_bagian,
                        'kode_supplier' => $hutangAsli->kode_supplier,
                        'kode_perusahaan' => $hutangAsli->kode_perusahaan,
                        'tgl_tempo' => $hutangAsli->tgl_tempo,
                        'status_bayar' => 0,
                        'total' => -$totalReturAmount,
                        'referensi' => $lpb['kode_penerimaan']
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('gudang.return-supplier.index')->with('success', 'Retur barang berhasil disimpan dengan kode ' . $rbNumber);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memproses retur: '.$e->getMessage());
        }
    }

    public function getReturnDetails($kode)
    {
        $details = DB::table('fr_gg_return_brg as a')
            ->join('mt_barang_jasa as b', 'a.kode_brg', '=', 'b.kode_brg')
            ->where('a.kode_return', $kode)
            ->select(
                'a.kode_brg',
                'b.nama_brg',
                'a.jumlah as qty_retur',
                'a.ket as alasan'
            )
            ->get();

        return response()->json($details);
    }
}
