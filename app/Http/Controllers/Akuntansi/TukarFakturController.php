<?php

namespace App\Http\Controllers\Akuntansi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Models\JurnalHeader;
use App\Models\JurnalDetail;
use App\Models\Coa;

class TukarFakturController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('tc_penerimaan_barang_nm as a')
            ->leftJoin('transaksi_hutang as h', 'a.kode_penerimaan', '=', 'h.no_bukti')
            ->leftJoin('mt_erp_supplier as s', 'a.kodesupplier', '=', 's.id')
            ->select(
                'a.id_tc_penerimaan_brg_nm as id',
                'a.kode_penerimaan as no_penerimaan',
                'a.no_faktur as no_faktur_supplier',
                'a.tgl_penerimaan as tgl_terima',
                's.nama_supplier',
                'a.status_tukar_faktur',
                'h.jumlah_transaksi as dpp',
                'h.jumlah_ppn as ppn',
                'h.jml_diskon as diskon',
                'h.total as total_hutang'
            )
            ->where(function($q) {
                $q->where('a.status_tukar_faktur', 0)
                  ->orWhereNull('a.status_tukar_faktur');
            });

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('a.kode_penerimaan', 'like', "%{$search}%")
                  ->orWhere('a.no_faktur', 'like', "%{$search}%")
                  ->orWhere('s.nama_supplier', 'like', "%{$search}%");
            });
        }

        $penerimaans = $query->orderBy('a.tgl_penerimaan', 'desc')->paginate(20)->withQueryString();

        return Inertia::render('Akuntansi/TukarFaktur/Index', [
            'penerimaans' => $penerimaans,
            'filters' => $request->only(['search'])
        ]);
    }

    public function proses(Request $request)
    {
        $request->validate([
            'penerimaan_ids' => 'required|array',
            'penerimaan_ids.*' => 'exists:tc_penerimaan_barang_nm,id_tc_penerimaan_brg_nm',
        ]);

        $coa_persediaan = Coa::where('kode_akun', '1141')->first();
        $coa_ppn = Coa::where('kode_akun', '1151')->first();
        $coa_hutang = Coa::where('kode_akun', '2111')->first();

        if (!$coa_persediaan || !$coa_hutang) {
            return back()->withErrors(['error' => 'Master COA untuk Persediaan (1141) atau Hutang (2111) belum disetting.']);
        }

        DB::beginTransaction();
        try {
            $penerimaans = DB::table('tc_penerimaan_barang_nm as a')
                ->leftJoin('transaksi_hutang as h', 'a.kode_penerimaan', '=', 'h.no_bukti')
                ->whereIn('a.id_tc_penerimaan_brg_nm', $request->penerimaan_ids)
                ->get([
                    'a.id_tc_penerimaan_brg_nm as id', 
                    'a.kode_penerimaan', 
                    'a.no_faktur',
                    'a.status_tukar_faktur',
                    'h.jumlah_transaksi as dpp',
                    'h.jumlah_ppn as ppn',
                    'h.jml_diskon as diskon',
                    'h.total as total_hutang'
                ]);

            foreach ($penerimaans as $penerimaan) {
                if ($penerimaan->status_tukar_faktur == 1) continue;

                $dpp = (float) $penerimaan->dpp;
                $ppn_nominal = (float) $penerimaan->ppn;
                $diskon = (float) $penerimaan->diskon;
                $grand_total = (float) $penerimaan->total_hutang;

                // Buat Jurnal Header
                $jurnal = JurnalHeader::create([
                    'no_jurnal' => 'TF-' . date('Ymd') . '-' . rand(1000, 9999) . '-' . $penerimaan->id,
                    'tgl_jurnal' => date('Y-m-d'),
                    'keterangan' => 'Tukar Faktur Penerimaan ' . $penerimaan->kode_penerimaan . ($penerimaan->no_faktur ? ' (Faktur: '.$penerimaan->no_faktur.')' : ''),
                    'referensi' => $penerimaan->kode_penerimaan,
                    'total_debit' => $grand_total,
                    'total_kredit' => $grand_total,
                    'id_dd_user' => auth()->id() ?? 1,
                ]);

                // Debit Persediaan (DPP - Diskon) 
                // Catatan: dpp di transaksi_hutang = (qty*harga). Diskon proporsional belum dikurangi di dpp, melainkan dikurangi saat menghitung total. 
                // total = dpp - diskon + ppn.
                $net_persediaan = $dpp - $diskon;
                JurnalDetail::create([
                    'id_jurnal_header' => $jurnal->id,
                    'id_coa' => $coa_persediaan->id,
                    'debit' => $net_persediaan,
                    'kredit' => 0,
                    'keterangan_detail' => 'Persediaan Masuk',
                ]);

                // Debit PPN
                if ($ppn_nominal > 0 && $coa_ppn) {
                    JurnalDetail::create([
                        'id_jurnal_header' => $jurnal->id,
                        'id_coa' => $coa_ppn->id,
                        'debit' => $ppn_nominal,
                        'kredit' => 0,
                        'keterangan_detail' => 'PPN Masukan',
                    ]);
                }

                // Kredit Hutang
                JurnalDetail::create([
                    'id_jurnal_header' => $jurnal->id,
                    'id_coa' => $coa_hutang->id,
                    'debit' => 0,
                    'kredit' => $grand_total,
                    'keterangan_detail' => 'Hutang Dagang Supplier',
                ]);

                DB::table('tc_penerimaan_barang_nm')
                    ->where('id_tc_penerimaan_brg_nm', $penerimaan->id)
                    ->update(['status_tukar_faktur' => 1]);
            }

            DB::commit();
            return back()->with('success', count($penerimaans).' Faktur berhasil ditukar dan dijurnal sebagai Hutang.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
