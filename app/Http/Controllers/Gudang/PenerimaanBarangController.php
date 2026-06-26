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
        $id_po = $request->id_po ?? $request->id_tc_po;
        $po = null;
        $po_details = [];

        if ($id_po) {
            $po = DB::table('tc_erp_po as a')
                ->leftJoin('mt_erp_supplier as b', 'a.supplier_id', '=', 'b.id')
                ->where('a.id', $id_po)
                ->select('a.*', 'b.nama_supplier as namasupplier', 'b.id as kodesupplier', 'a.id as id_tc_po')
                ->first();

            if ($po) {
                $po_details = DB::table('tc_erp_po_detail as d')
                    ->join('mt_barang_jasa as b', 'd.kode_brg', '=', 'b.kode_brg')
                    ->where('d.po_id', $id_po)
                    ->whereRaw('d.qty_pesan > ISNULL(d.qty_terima, 0)')
                    ->select(
                        'd.id as id_tc_po_det',
                        'd.kode_brg',
                        'b.nama_brg',
                        'd.qty_pesan',
                        'd.qty_terima as qty_sudah_terima',
                        'd.harga_satuan',
                        'b.satuan_besar as satuan'
                    )
                    ->get()
                    ->map(function ($item) {
                        $sisa = $item->qty_pesan - ($item->qty_sudah_terima ?? 0);
                        $item->qty_pesan = $sisa; // override so frontend uses it as max limit
                        $item->qty_terima = $sisa; // default to receive all remaining

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
        $query = DB::table('tc_erp_po as a')
            ->leftJoin('mt_erp_supplier as b', 'a.supplier_id', '=', 'b.id')
            ->where('a.status', 1);

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('a.no_po', 'like', "%{$search}%")
                    ->orWhere('b.nama_supplier', 'like', "%{$search}%");
            });
        }

        $posRaw = $query->take(20)->get(['a.id', 'a.no_po', 'b.nama_supplier as namasupplier']);
        
        $pos = $posRaw->map(function ($po) {
            return [
                'value' => $po->id,
                'label' => $po->no_po . ' - ' . ($po->namasupplier ?? 'Unknown'),
            ];
        });

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
            'id_tc_po' => 'required|exists:tc_erp_po,id',
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
            $kode_penerimaan = 'LPB-'.$date->format('Ymd').'-'.str_pad($countToday + 1, 4, '0', STR_PAD_LEFT);

            $po = DB::table('tc_erp_po as a')
                ->leftJoin('mt_erp_supplier as b', 'a.supplier_id', '=', 'b.id')
                ->where('a.id', $request->id_tc_po)
                ->select('a.*', 'b.id as kodesupplier')
                ->first();

            $no_induk = session('no_induk');
            if (session('user')) {
                $no_induk = session('user')->no_induk ?? $no_induk;
            }
            $nama_pegawai = DB::table('mt_karyawan')->where('no_induk', $no_induk)->value('nama_pegawai') ?? 'System';

            $id_penerimaan = DB::table('tc_penerimaan_barang_nm')->insertGetId([
                'kode_penerimaan' => $kode_penerimaan,
                'no_po' => $po->no_po,
                'no_faktur' => $request->no_faktur,
                'tgl_penerimaan' => $date->toDateTimeString(),
                'kodesupplier' => $po->kodesupplier,
                'petugas' => $nama_pegawai,
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
                    'kode_penerimaan' => $kode_penerimaan,
                    'kode_brg' => $item['kode_brg'],
                    'jumlah_pesan' => $item['qty_pesan'],
                    'jumlah_kirim' => $item['qty_terima'],
                    'id_tc_po_det' => $item['id_tc_po_det'],
                    'harga' => $item['harga_satuan'],
                    'harga_total' => $harga_total,
                    'satuan' => $item['satuan'] ?? '-',
                ]);

                // Update mt_depo_stok_brg_jasa for gudang (using kode_bagian 070101)
                $stokExist = DB::table('mt_depo_stok_brg_jasa')
                    ->where('kode_brg', $item['kode_brg'])
                    ->where('kode_bagian', '070101')
                    ->first();

                $stok_awal = 0;
                if ($stokExist) {
                    $stok_awal = (int) $stokExist->jml_sat_kcl;
                    DB::table('mt_depo_stok_brg_jasa')
                        ->where('kode_brg', $item['kode_brg'])
                        ->where('kode_bagian', '070101')
                        ->update(['jml_sat_kcl' => $stok_awal + (int) $item['qty_terima']]);
                } else {
                    DB::table('mt_depo_stok_brg_jasa')->insert([
                        'kode_brg' => $item['kode_brg'],
                        'kode_bagian' => '070101',
                        'jml_sat_kcl' => (int) $item['qty_terima'],
                    ]);
                }

                // Insert into tc_kartu_stok_brg_jasa
                DB::table('tc_kartu_stok_brg_jasa')->insert([
                    'kode_brg' => $item['kode_brg'],
                    'kode_bagian' => '070101',
                    'tgl_input' => now(),
                    'stok_awal' => $stok_awal,
                    'pemasukan' => (int) $item['qty_terima'],
                    'pengeluaran' => 0,
                    'stok_akhir' => $stok_awal + (int) $item['qty_terima'],
                    'jenis_transaksi' => 1,
                    'keterangan' => 'Penerimaan Barang '.$kode_penerimaan,
                    'petugas' => auth()->id() ?? 1,
                ]);

                // Update qty_terima in PO detail
                DB::table('tc_erp_po_detail')
                    ->where('id', $item['id_tc_po_det'])
                    ->update([
                        'qty_terima' => DB::raw("ISNULL(qty_terima, 0) + {$item['qty_terima']}")
                    ]);
            }

            $ratio = $total_pesan_all > 0 ? ($total_diterima_all / $total_pesan_all) : 1;
            $diskon_proporsional = $po->diskon_nominal * $ratio;
            $ppn_proporsional = $po->ppn_nominal * $ratio;
            $grand_total_hutang = $total_hutang - $diskon_proporsional + $ppn_proporsional;

            $max_id_hutang = DB::table('transaksi_hutang')->max('id_trans_hutang');
            $new_id_hutang = $max_id_hutang ? $max_id_hutang + 1 : 1;

            DB::table('transaksi_hutang')->insert([
                'id_trans_hutang' => $new_id_hutang,
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

            // Check if all items in PO are fully received
            $unreceivedItems = DB::table('tc_erp_po_detail')
                ->where('po_id', $po->id)
                ->whereRaw('qty_pesan > ISNULL(qty_terima, 0)')
                ->count();

            $status_po = ($unreceivedItems === 0) ? 2 : 1; // 2 = Selesai, 1 = Masih ada sisa
            DB::table('tc_erp_po')->where('id', $po->id)->update(['status' => $status_po]);

            DB::commit();

            return redirect()->route('gudang.penerimaan.index')->with('success', 'Barang berhasil diterima dan stok telah di-update!');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Gagal memproses penerimaan: '.$e->getMessage());
        }
    }

    public function getDetails($id)
    {
        $query = DB::table('tc_penerimaan_barang_nm_detail as d')
            ->join('mt_barang_jasa as b', 'd.kode_brg', '=', 'b.kode_brg');
            
        if (is_numeric($id)) {
            $kode = DB::table('tc_penerimaan_barang_nm')->where('id_tc_penerimaan_brg_nm', $id)->value('kode_penerimaan');
            $query->where('d.kode_penerimaan', $kode);
        } else {
            $query->where('d.kode_penerimaan', $id);
        }

        $details = $query->select(
                'd.kode_brg',
                'b.nama_brg',
                'd.jumlah_kirim as qty_terima',
                'd.satuan',
                'd.harga as harga_satuan',
                'd.harga_total'
            )
            ->get();

        return response()->json($details);
    }
}
