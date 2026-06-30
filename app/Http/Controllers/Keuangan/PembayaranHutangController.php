<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Models\JurnalHeader;
use App\Models\JurnalDetail;
use App\Models\Coa;

class PembayaranHutangController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('transaksi_hutang as h')
            ->leftJoin('mt_erp_supplier as s', 'h.kode_supplier', '=', 's.id')
            ->leftJoin('tc_penerimaan_barang_nm as p', 'h.no_bukti', '=', 'p.kode_penerimaan')
            ->select(
                'h.id_trans_hutang as id',
                'h.no_bukti',
                'p.no_faktur',
                'h.tgl_transaksi',
                'h.tgl_tempo',
                's.nama_supplier',
                'h.total as total_hutang',
                'h.total_bayar'
            )
            ->where('h.status_bayar', 0)
            ->whereRaw('ISNULL(h.total_bayar, 0) < h.total');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('h.no_bukti', 'like', "%{$search}%")
                  ->orWhere('p.no_faktur', 'like', "%{$search}%")
                  ->orWhere('s.nama_supplier', 'like', "%{$search}%");
            });
        }

        $hutangs = $query->orderBy('h.tgl_transaksi', 'asc')->paginate(20)->withQueryString();

        // Ambil COA Kas & Bank (biasanya kepala 111 atau 112)
        $coa_sumber = Coa::where('kode_akun', 'like', '111%')
            ->orWhere('kode_akun', 'like', '112%')
            ->get();

        return Inertia::render('Keuangan/PembayaranHutang/Index', [
            'hutangs' => $hutangs,
            'coa_sumber' => $coa_sumber,
            'filters' => $request->only(['search'])
        ]);
    }

    public function proses(Request $request)
    {
        $request->validate([
            'id_coa_sumber' => 'required|exists:mt_erp_coa,id',
            'pembayaran' => 'required|array|min:1',
            'pembayaran.*.id' => 'required|exists:transaksi_hutang,id_trans_hutang',
            'pembayaran.*.nominal_bayar' => 'required|numeric|min:1',
        ]);

        $coa_sumber = Coa::find($request->id_coa_sumber);
        $coa_hutang = Coa::where('kode_akun', '2111')->first();

        if (!$coa_hutang) {
            return back()->withErrors(['error' => 'Master COA untuk Hutang Usaha (2111) belum disetting.']);
        }

        DB::beginTransaction();
        try {
            $total_semua_bayar = 0;
            $jurnal_details = [];

            foreach ($request->pembayaran as $item) {
                $hutang = DB::table('transaksi_hutang')->where('id_trans_hutang', $item['id'])->first();
                $nominal_bayar = (float) $item['nominal_bayar'];
                
                $total_semua_bayar += $nominal_bayar;
                $new_total_bayar = (float) $hutang->total_bayar + $nominal_bayar;
                $status_bayar = ($new_total_bayar >= (float) $hutang->total) ? 1 : 0;

                DB::table('transaksi_hutang')->where('id_trans_hutang', $item['id'])->update([
                    'total_bayar' => $new_total_bayar,
                    'status_bayar' => $status_bayar,
                    'tgl_bayar' => $status_bayar == 1 ? now() : $hutang->tgl_bayar, // Update tgl lunas jika lunas
                ]);

                // Kumpulkan debit hutang per faktur
                $jurnal_details[] = [
                    'id_coa' => $coa_hutang->id,
                    'debit' => $nominal_bayar,
                    'kredit' => 0,
                    'keterangan_detail' => 'Pelunasan Hutang ' . $hutang->no_bukti,
                ];
            }

            // Buat Jurnal Header (Satu untuk semua pembayaran di batch ini)
            $jurnal = JurnalHeader::create([
                'no_jurnal' => 'BYR-' . date('Ymd') . '-' . rand(1000, 9999),
                'tgl_jurnal' => date('Y-m-d'),
                'keterangan' => 'Pembayaran Hutang Supplier (Batch)',
                'referensi' => 'Batch Payment',
                'total_debit' => $total_semua_bayar,
                'total_kredit' => $total_semua_bayar,
                'id_dd_user' => auth()->id() ?? 1,
            ]);

            // Insert Detail Debit Hutang
            foreach ($jurnal_details as $detail) {
                JurnalDetail::create([
                    'id_jurnal_header' => $jurnal->id,
                    'id_coa' => $detail['id_coa'],
                    'debit' => $detail['debit'],
                    'kredit' => $detail['kredit'],
                    'keterangan_detail' => $detail['keterangan_detail'],
                ]);
            }

            // Insert Detail Kredit Kas/Bank (Konsolidasi total pembayaran)
            JurnalDetail::create([
                'id_jurnal_header' => $jurnal->id,
                'id_coa' => $coa_sumber->id,
                'debit' => 0,
                'kredit' => $total_semua_bayar,
                'keterangan_detail' => 'Pengeluaran Kas/Bank',
            ]);

            DB::commit();
            return back()->with('success', 'Pembayaran berhasil diproses dan Jurnal Pengeluaran Kas telah dibuat.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
