<?php

namespace App\Http\Controllers\Gudang;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PenerimaanBarangController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('tc_penerimaan_barang_nm as a')
            ->leftJoin('mt_supplier as b', 'a.kodesupplier', '=', 'b.kodesupplier')
            ->select(
                'a.id_tc_penerimaan_brg_nm',
                'a.kode_penerimaan',
                'a.no_po',
                'a.no_faktur',
                'a.tgl_penerimaan',
                'a.petugas',
                'b.namasupplier'
            )
            ->orderBy('a.tgl_penerimaan', 'desc');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('a.kode_penerimaan', 'like', "%{$search}%")
                    ->orWhere('a.no_faktur', 'like', "%{$search}%")
                    ->orWhere('a.no_po', 'like', "%{$search}%")
                    ->orWhere('b.namasupplier', 'like', "%{$search}%");
            });
        }

        $penerimaan = $query->paginate(20)->withQueryString();

        return Inertia::render('Gudang/Penerimaan/Index', [
            'penerimaan' => $penerimaan,
            'filters' => $request->only(['search']),
        ]);
    }

    public function create(Request $request)
    {
        $id_po = $request->id_po;
        $po = null;
        $po_details = [];

        if ($id_po) {
            $po = DB::table('tc_po_nm as a')
                ->leftJoin('mt_supplier as b', 'a.kodesupplier', '=', 'b.kodesupplier')
                ->where('a.id_tc_po', $id_po)
                ->select('a.*', 'b.namasupplier')
                ->first();

            if ($po) {
                $po_details = DB::table('tc_po_nm_det as d')
                    ->join('mt_barang_jasa as b', 'd.kode_brg', '=', 'b.kode_brg')
                    ->where('d.id_tc_po', $id_po)
                    ->select(
                        'd.id_tc_po_det',
                        'd.kode_brg',
                        'b.nama_brg',
                        'd.jumlah_besar as qty_pesan',
                        'd.harga_satuan',
                        'd.satuan'
                    )
                    ->get()
                    ->map(function ($item) {
                        $item->qty_terima = $item->qty_pesan;

                        return $item;
                    });
            }
        }

        return Inertia::render('Gudang/Penerimaan/FormPenerimaan', [
            'po' => $po,
            'po_details' => $po_details,
        ]);
    }

    public function searchPo(Request $request)
    {
        $query = DB::table('tc_po_nm as a')
            ->leftJoin('mt_supplier as b', 'a.kodesupplier', '=', 'b.kodesupplier')
            ->where('a.status_kirim', '<', 2);

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('a.no_po', 'like', "%{$search}%")
                    ->orWhere('b.namasupplier', 'like', "%{$search}%");
            });
        }

        $pos = $query->take(20)->get([
            'a.id_tc_po as value',
            DB::raw("CONCAT(a.no_po, ' - ', ISNULL(b.namasupplier, 'Unknown')) as label"),
        ]);

        return response()->json($pos);
    }

    public function searchBarangNm(Request $request)
    {
        $query = DB::table('mt_barang_jasa')
            ->select('kode_brg', 'nama_brg', 'satuan_besar as satuan')
            ->where('status', 1);

        if ($request->has('search') && $request->search != '') {
            $query->where('nama_brg', 'like', "%{$request->search}%");
        }

        $barang = $query->take(20)->get();

        return response()->json($barang);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_tc_po' => 'required|exists:tc_po_nm,id_tc_po',
            'no_faktur' => 'required',
            'tgl_penerimaan' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.kode_brg' => 'required',
            'items.*.qty_terima' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            $date = Carbon::parse($request->tgl_penerimaan);
            $countToday = DB::table('tc_penerimaan_barang_nm')
                ->whereDate('tgl_penerimaan', $date->toDateString())
                ->count();
            $kode_penerimaan = 'LPB-NM-'.$date->format('Ymd').'-'.str_pad($countToday + 1, 4, '0', STR_PAD_LEFT);

            $po = DB::table('tc_po_nm')->where('id_tc_po', $request->id_tc_po)->first();

            $id_penerimaan = DB::table('tc_penerimaan_barang_nm')->insertGetId([
                'kode_penerimaan' => $kode_penerimaan,
                'no_po' => $po->no_po,
                'no_faktur' => $request->no_faktur,
                'tgl_penerimaan' => $date->toDateTimeString(),
                'kodesupplier' => $po->kodesupplier,
                'petugas' => auth()->user()->nama_pegawai ?? 'System',
                'flag_hutang' => 1,
            ]);

            $total_hutang = 0;
            $total_diterima_all = 0;
            $total_pesan_all = 0;

            foreach ($request->items as $item) {
                if ($item['qty_terima'] <= 0) {
                    continue;
                }

                $harga_total = $item['qty_terima'] * $item['harga_satuan'];
                $total_hutang += $harga_total;
                $total_diterima_all += $item['qty_terima'];
                $total_pesan_all += $item['qty_pesan'];

                DB::table('tc_penerimaan_barang_nm_detail')->insert([
                    'id_tc_penerimaan_brg_nm' => $id_penerimaan,
                    'kode_penerimaan' => $kode_penerimaan,
                    'kode_brg' => $item['kode_brg'],
                    'jumlah_pesan' => $item['qty_pesan'],
                    'jumlah_kirim' => $item['qty_terima'],
                    'id_tc_po_det' => $item['id_tc_po_det'],
                    'harga' => $item['harga_satuan'],
                    'harga_total' => $harga_total,
                    'satuan' => $item['satuan'] ?? '-',
                ]);

                // Update mt_depo_stok_brg_jasa for gudang (using kode_bagian 1 for generic warehouse)
                $stokExist = DB::table('mt_depo_stok_brg_jasa')
                    ->where('kode_brg', $item['kode_brg'])
                    ->where('kode_bagian', 1)
                    ->first();

                $stok_awal = 0;
                if ($stokExist) {
                    $stok_awal = $stokExist->jumlah_stok;
                    DB::table('mt_depo_stok_brg_jasa')
                        ->where('kode_brg', $item['kode_brg'])
                        ->where('kode_bagian', 1)
                        ->update(['jumlah_stok' => $stok_awal + $item['qty_terima']]);
                } else {
                    DB::table('mt_depo_stok_brg_jasa')->insert([
                        'kode_brg' => $item['kode_brg'],
                        'kode_bagian' => 1,
                        'jumlah_stok' => $item['qty_terima'],
                    ]);
                }

                // Insert into tc_kartu_stok_brg_jasa
                DB::table('tc_kartu_stok_brg_jasa')->insert([
                    'kode_brg' => $item['kode_brg'],
                    'kode_bagian' => 1,
                    'tgl_input' => now(),
                    'stok_awal' => $stok_awal,
                    'pemasukan' => $item['qty_terima'],
                    'pengeluaran' => 0,
                    'stok_akhir' => $stok_awal + $item['qty_terima'],
                    'keterangan' => 'Penerimaan Barang '.$kode_penerimaan,
                    'id_user' => auth()->id() ?? 1,
                ]);
            }

            $ratio = $total_pesan_all > 0 ? ($total_diterima_all / $total_pesan_all) : 1;
            $diskon_proporsional = $po->discount_harga * $ratio;
            $ppn_proporsional = $po->ppn * $ratio;
            $grand_total_hutang = $total_hutang - $diskon_proporsional + $ppn_proporsional;

            DB::table('transaksi_hutang')->insert([
                'kode_supplier' => $po->kodesupplier,
                'no_bukti' => $kode_penerimaan,
                'tgl_transaksi' => $date->toDateTimeString(),
                'jumlah_transaksi' => $total_hutang,
                'jml_diskon' => $diskon_proporsional,
                'jumlah_ppn' => $ppn_proporsional,
                'total' => $grand_total_hutang,
                'keterangan' => 'Hutang Faktur '.$request->no_faktur.' (PO: '.$po->no_po.')',
                'tgl_tempo' => $date->copy()->addDays(30)->toDateTimeString(),
                'status_bayar' => 0,
                'inp_tgl' => now(),
                'inp_id' => auth()->id() ?? 1,
            ]);

            $status_kirim = 1;
            if ($total_diterima_all >= $total_pesan_all) {
                $status_kirim = 2;
            }
            DB::table('tc_po_nm')->where('id_tc_po', $po->id_tc_po)->update(['status_kirim' => $status_kirim]);

            DB::commit();

            return redirect()->route('gudang.penerimaan.index')->with('success', 'Barang berhasil diterima dan stok telah di-update!');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Gagal memproses penerimaan: '.$e->getMessage());
        }
    }
}
