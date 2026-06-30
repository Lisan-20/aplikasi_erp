<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Helpers\JurnalHelper;

class FakturPenjualanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $fakturs = DB::table('tc_erp_penjualan_b2b as f')
            ->leftJoin('mt_perusahaan as p', 'f.kode_perusahaan', '=', 'p.kode_perusahaan')
            ->select('f.*', 'p.nama_perusahaan')
            ->when($search, function ($query, $search) {
                return $query->where('f.no_faktur', 'like', "%{$search}%")
                    ->orWhere('p.nama_perusahaan', 'like', "%{$search}%");
            })
            ->orderBy('f.tgl_faktur', 'desc')
            ->orderBy('f.id', 'desc')
            ->paginate(10);

        return Inertia::render('Penjualan/FakturPenjualan/Index', [
            'fakturs' => $fakturs,
            'filters' => $request->only(['search'])
        ]);
    }

    public function create()
    {
        $perusahaan = DB::table('mt_perusahaan')->select('kode_perusahaan', 'nama_perusahaan')->get();
        // Hanya barang yang memiliki stok di depo 070101 dan status aktif
        $barang = DB::table('mt_barang_jasa as b')
            ->join('mt_depo_stok_brg_jasa as s', 'b.kode_brg', '=', 's.kode_brg')
            ->where('s.kode_bagian', '070101')
            ->where('s.jml_sat_kcl', '>', 0)
            ->where('b.status', 1)
            ->select('b.kode_brg', 'b.nama_brg', 'b.harga_jual', 'b.harga_beli', 's.jml_sat_kcl as stok')
            ->get();

        // Cari max nomor faktur untuk hari ini
        $dateStr = date('Ymd');
        $maxFaktur = DB::table('tc_erp_penjualan_b2b')
            ->where('no_faktur', 'like', 'INV-' . $dateStr . '%')
            ->max('no_faktur');
            
        $seq = 1;
        if ($maxFaktur) {
            $seq = intval(substr($maxFaktur, -4)) + 1;
        }
        $nextFaktur = 'INV-' . $dateStr . '-' . str_pad($seq, 4, '0', STR_PAD_LEFT);

        return Inertia::render('Penjualan/FakturPenjualan/Create', [
            'perusahaan' => $perusahaan,
            'barang' => $barang,
            'nextFaktur' => $nextFaktur
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_faktur' => 'required|string',
            'kode_perusahaan' => 'required',
            'tgl_faktur' => 'required|date',
            'tgl_jatuh_tempo' => 'required|date|after_or_equal:tgl_faktur',
            'keterangan' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.kode_brg' => 'required',
            'items.*.qty' => 'required|numeric|min:1',
            'items.*.harga' => 'required|numeric|min:0',
        ]);

        $userSession = session('user');
        $petugas = is_array($userSession) ? ($userSession['no_induk'] ?? 'SYSTEM') : ($userSession->no_induk ?? 'SYSTEM');

        DB::beginTransaction();

        try {
            $total_tagihan = 0;
            $total_hpp = 0;

            // Calculate total and prepare details
            $details = [];
            foreach ($request->items as $item) {
                $subtotal = $item['qty'] * $item['harga'];
                $total_tagihan += $subtotal;
                
                // Get HPP and check stock
                $brg = DB::table('mt_barang_jasa as b')
                    ->join('mt_depo_stok_brg_jasa as s', 'b.kode_brg', '=', 's.kode_brg')
                    ->where('s.kode_bagian', '070101')
                    ->where('b.kode_brg', $item['kode_brg'])
                    ->select('b.harga_beli', 's.jml_sat_kcl')
                    ->first();
                    
                if (!$brg || $brg->jml_sat_kcl < $item['qty']) {
                    throw new \Exception("Stok barang {$item['kode_brg']} tidak mencukupi.");
                }

                $hpp_subtotal = $brg->harga_beli * $item['qty'];
                $total_hpp += $hpp_subtotal;

                $details[] = [
                    'kode_brg' => $item['kode_brg'],
                    'qty' => $item['qty'],
                    'harga' => $item['harga'],
                    'subtotal' => $subtotal,
                ];

                // Kurangi Stok
                DB::table('mt_depo_stok_brg_jasa')
                    ->where('kode_brg', $item['kode_brg'])
                    ->where('kode_bagian', '070101')
                    ->decrement('jml_sat_kcl', $item['qty']);
                    
                // Kartu Stok
                DB::table('tc_kartu_stok_brg_jasa')->insert([
                    'tgl_input' => now(),
                    'kode_brg' => $item['kode_brg'],
                    'stok_awal' => (float) $brg->jml_sat_kcl,
                    'pengeluaran' => (float) $item['qty'],
                    'pemasukan' => 0,
                    'stok_akhir' => (float) ($brg->jml_sat_kcl - $item['qty']),
                    'harga_hpp' => (float) $brg->harga_beli,
                    'jenis_transaksi' => 6, // 6 = Penjualan
                    'kode_bagian' => '070101',
                    'petugas' => $petugas,
                    'keterangan' => 'Faktur B2B No. ' . $request->no_faktur,
                ]);
            }

            // Insert Header
            $id_penjualan = DB::table('tc_erp_penjualan_b2b')->insertGetId([
                'no_faktur' => $request->no_faktur,
                'tgl_faktur' => $request->tgl_faktur,
                'tgl_jatuh_tempo' => $request->tgl_jatuh_tempo,
                'kode_perusahaan' => $request->kode_perusahaan,
                'keterangan' => $request->keterangan,
                'total_tagihan' => $total_tagihan,
                'status_pembayaran' => 'Belum Bayar',
                'created_by' => $petugas,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Insert Details
            foreach ($details as &$d) {
                $d['id_penjualan'] = $id_penjualan;
            }
            DB::table('tc_erp_penjualan_b2b_detail')->insert($details);

            // JURNAL OTOMATIS PENJUALAN KREDIT (PIUTANG)
            // 1. Mencatat Piutang dan Pendapatan
            // Debit: Piutang Usaha (1121)
            // Kredit: Pendapatan Penjualan Barang (4111)
            
            // 2. Mencatat HPP dan Persediaan
            // Debit: HPP (5111)
            // Kredit: Persediaan Barang (1131)

            JurnalHelper::buatJurnalOtomatis(
                $request->no_faktur,
                $request->tgl_faktur,
                "Penjualan B2B (Faktur: {$request->no_faktur})",
                [
                    ['kode_akun' => '1121', 'posisi' => 'debit', 'nominal' => $total_tagihan, 'keterangan' => 'Piutang Usaha atas ' . $request->no_faktur],
                    ['kode_akun' => '4111', 'posisi' => 'kredit', 'nominal' => $total_tagihan, 'keterangan' => 'Pendapatan atas ' . $request->no_faktur],
                    ['kode_akun' => '5111', 'posisi' => 'debit', 'nominal' => $total_hpp, 'keterangan' => 'HPP atas ' . $request->no_faktur],
                    ['kode_akun' => '1131', 'posisi' => 'kredit', 'nominal' => $total_hpp, 'keterangan' => 'Persediaan atas ' . $request->no_faktur],
                ]
            );

            DB::commit();

            return redirect()->route('kasir.faktur.index')->with('success', 'Faktur Penjualan berhasil dibuat!');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
