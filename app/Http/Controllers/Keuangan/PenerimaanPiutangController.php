<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Helpers\JurnalHelper;
use App\Models\Coa;

class PenerimaanPiutangController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        
        // Ambil faktur yang belum lunas
        $piutangs = DB::table('tc_erp_penjualan_b2b as f')
            ->leftJoin('mt_perusahaan as p', 'f.kode_perusahaan', '=', 'p.kode_perusahaan')
            ->select('f.*', 'p.nama_perusahaan')
            ->where('f.status_pembayaran', '!=', 'Lunas')
            ->when($search, function ($query, $search) {
                return $query->where('f.no_faktur', 'like', "%{$search}%")
                    ->orWhere('p.nama_perusahaan', 'like', "%{$search}%");
            })
            ->orderBy('f.tgl_jatuh_tempo', 'asc')
            ->paginate(10);

        // Ambil riwayat pembayaran piutang
        $riwayat = DB::table('tc_erp_pembayaran_piutang as h')
            ->leftJoin('mt_erp_coa as c', 'h.id_coa_tujuan', '=', 'c.id')
            ->leftJoin('tc_erp_penjualan_b2b as f', 'h.no_faktur', '=', 'f.no_faktur')
            ->leftJoin('mt_perusahaan as p', 'f.kode_perusahaan', '=', 'p.kode_perusahaan')
            ->select('h.*', 'c.nama_akun as nama_bank', 'p.nama_perusahaan')
            ->orderBy('h.created_at', 'desc')
            ->get();

        // Ambil COA Kas / Bank untuk menampung pembayaran
        $coa_tujuan = Coa::where('kode_akun', 'like', '111%')
            ->get();

        return Inertia::render('Keuangan/PenerimaanPiutang/Index', [
            'piutangs' => $piutangs,
            'riwayat' => $riwayat,
            'coa_tujuan' => $coa_tujuan,
            'filters' => $request->only(['search'])
        ]);
    }

    public function proses(Request $request)
    {
        $request->validate([
            'no_faktur' => 'required|string',
            'nominal_bayar' => 'required|numeric|min:1',
            'id_coa_tujuan' => 'required|integer' // ID COA Kas/Bank
        ]);

        $userSession = session('user');
        $petugas = is_array($userSession) ? ($userSession['no_induk'] ?? 'SYSTEM') : ($userSession->no_induk ?? 'SYSTEM');

        try {
            DB::beginTransaction();

            $faktur = DB::table('tc_erp_penjualan_b2b')->where('no_faktur', $request->no_faktur)->first();
            if (!$faktur) {
                throw new \Exception("Faktur tidak ditemukan.");
            }

            $sisa = $faktur->total_tagihan - $faktur->total_dibayar;
            $bayar = $request->nominal_bayar;

            if ($bayar > $sisa) {
                throw new \Exception("Nominal bayar (Rp " . number_format($bayar, 0, ',', '.') . ") melebihi sisa piutang (Rp " . number_format($sisa, 0, ',', '.') . ").");
            }

            $total_dibayar_baru = $faktur->total_dibayar + $bayar;
            $status_pembayaran = ($total_dibayar_baru >= $faktur->total_tagihan) ? 'Lunas' : 'Parsial';

            DB::table('tc_erp_penjualan_b2b')
                ->where('no_faktur', $request->no_faktur)
                ->update([
                    'total_dibayar' => $total_dibayar_baru,
                    'status_pembayaran' => $status_pembayaran,
                    'updated_at' => now()
                ]);

            // Catat ke tabel history
            DB::table('tc_erp_pembayaran_piutang')->insert([
                'no_faktur' => $request->no_faktur,
                'tgl_bayar' => date('Y-m-d'),
                'nominal_bayar' => $bayar,
                'id_coa_tujuan' => $request->id_coa_tujuan,
                'petugas' => $petugas,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // JURNAL OTOMATIS PENERIMAAN PIUTANG
            // Debit: Kas / Bank (pilihan user)
            // Kredit: Piutang Usaha (1121)

            $coaTujuan = Coa::find($request->id_coa_tujuan);

            JurnalHelper::buatJurnalOtomatis(
                "PAY-".$request->no_faktur."-".time(),
                date('Y-m-d'),
                "Pelunasan Piutang B2B (Faktur: {$request->no_faktur})",
                [
                    ['kode_akun' => $coaTujuan->kode_akun, 'posisi' => 'debit', 'nominal' => $bayar, 'keterangan' => 'Penerimaan Piutang masuk ke ' . $coaTujuan->nama_akun],
                    ['kode_akun' => '1121', 'posisi' => 'kredit', 'nominal' => $bayar, 'keterangan' => 'Pelunasan Piutang atas Faktur ' . $request->no_faktur],
                ]
            );

            DB::commit();

            return redirect()->route('keuangan.penerimaan-piutang')->with('success', 'Penerimaan piutang berhasil diproses.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
