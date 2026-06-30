<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use App\Helpers\JurnalHelper;

class PosController extends Controller
{
    public function index()
    {
        return Inertia::render('Kasir/Pos');
    }

    public function searchBarang(Request $request)
    {
        $keyword = $request->query('q', '');

        $query = DB::table('mt_barang_jasa')
            ->leftJoin('mt_depo_stok_brg_jasa', function ($join) {
                $join->on('mt_barang_jasa.kode_brg', '=', 'mt_depo_stok_brg_jasa.kode_brg')
                    ->where('mt_depo_stok_brg_jasa.kode_bagian', '070101');
            })
            ->where(function ($q) {
                $q->where('mt_depo_stok_brg_jasa.jml_sat_kcl', '>', 0)
                    ->orWhere('mt_barang_jasa.kd_tipe_brg', 2);
            })
            ->where('mt_barang_jasa.status', 1)
            ->select('mt_barang_jasa.*', 'mt_depo_stok_brg_jasa.jml_sat_kcl');

        if ($keyword) {
            $query->where('mt_barang_jasa.nama_brg', 'like', '%'.$keyword.'%');
        }

        $barang = $query->paginate(30);

        return response()->json($barang);
    }

    public function getRecommendations(Request $request)
    {
        $cartItems = $request->input('cart', []);

        if (empty($cartItems)) {
            return response()->json([]);
        }

        // Algoritma Market Basket Analysis (Rekomendasi)
        $placeholders = implode(',', array_fill(0, count($cartItems), '?'));

        $sql = "
            SELECT TOP 5 
                d2.kode_brg, 
                b.nama_brg, 
                b.harga_jual,
                s.jml_sat_kcl,
                b.satuan_kecil,
                COUNT(*) as frequency
            FROM tc_trans_kasir_detail d1
            JOIN tc_trans_kasir_detail d2 
                ON d1.no_registrasi = d2.no_registrasi 
                AND d1.kode_brg != d2.kode_brg
            JOIN mt_barang_jasa b 
                ON d2.kode_brg = b.kode_brg
            JOIN mt_depo_stok_brg_jasa s
                ON b.kode_brg = s.kode_brg
            WHERE d1.kode_brg IN ($placeholders)
              AND d2.kode_brg NOT IN ($placeholders)
              AND s.kode_bagian = '070101'
              AND s.jml_sat_kcl > 0
            GROUP BY d2.kode_brg, b.nama_brg, b.harga_jual, s.jml_sat_kcl, b.satuan_kecil
            ORDER BY frequency DESC
        ";

        $bindings = array_merge($cartItems, $cartItems);
        $recommendations = DB::select($sql, $bindings);

        return response()->json($recommendations);
    }

    public function checkout(Request $request)
    {
        DB::beginTransaction();
        try {
            $items = $request->input('items', []);
            $tunai = $request->input('tunai', 0);
            $kredit = $request->input('kredit', 0);
            $debet = $request->input('debet', 0);
            $adm_cc = $request->input('adm_cc', 0);
            $diskon = $request->input('diskon', 0);
            $diskon_pers = $request->input('diskon_pers', 0);
            $uang_diterima = $request->input('uang_diterima', 0);
            $uang_kembali = $request->input('uang_kembali', 0);
            $bill = $request->input('bill', 0);

            // Get user identifier
            $id_dd_user = Session::get('id_dd_user');
            if (! $id_dd_user) {
                // Fallback if session is empty
                $id_dd_user = auth()->user() ? auth()->user()->id_dd_user : 'SYSTEM';
            }

            // Generate no_registrasi: YYYYMMDDXXXX
            $dateStr = date('Ymd');

            // Karena no_registrasi bertipe bigint di tabel, kita bisa cari Max-nya untuk di-increment.
            $maxReg = DB::table('tc_trans_kasir')
                ->where('no_registrasi', 'like', $dateStr.'%')
                ->max('no_registrasi');

            if ($maxReg) {
                // maxReg is string/bigint like 202606140001
                $seq = intval(substr((string) $maxReg, 8)) + 1;
            } else {
                $seq = 1;
            }

            $no_registrasi = $dateStr.str_pad($seq, 4, '0', STR_PAD_LEFT);
            $tglJam = now();

            $maxKode = DB::table('tc_trans_kasir')->max('kode_tc_trans_kasir');
            $kode_tc_trans_kasir = $maxKode ? $maxKode + 1 : 1;

            // Determine Shift based on current hour
            $hour = (int) date('H');
            if ($hour >= 7 && $hour < 15) {
                $kode_shift = 1; // Shift Pagi: 07:00 - 14:59
            } elseif ($hour >= 15 && $hour < 22) {
                $kode_shift = 2; // Shift Sore: 15:00 - 21:59
            } else {
                $kode_shift = 3; // Shift Malam: 22:00 - 06:59
            }

            // Insert Header
            DB::table('tc_trans_kasir')->insert([
                'kode_tc_trans_kasir' => $kode_tc_trans_kasir,
                'seri_kuitansi' => 'REG01',
                'no_induk' => $id_dd_user,
                'no_mr' => 'UMUM',
                'pembayar' => 'UMUM',
                'tgl_jam' => $tglJam,
                'bill' => $bill,
                'tunai' => $tunai,
                'debet' => $debet,
                'kredit' => $kredit,
                'no_registrasi' => $no_registrasi,
                'adm_cc' => $adm_cc,
                'diskon' => $diskon,
                'diskon_pers' => $diskon_pers,
                'kode_shift' => $kode_shift,
                'kode_loket' => 1,
                'uang_diterima' => $uang_diterima,
                'uang_kembali' => $uang_kembali,
            ]);

            $total_hpp = 0;

            // Process Items
            foreach ($items as $item) {
                $kode_brg = $item['kode_brg'];
                $qty = $item['qty'];

                $barang = DB::table('mt_barang_jasa')->where('kode_brg', $kode_brg)->first();
                $kd_tipe_brg = $barang ? (int) $barang->kd_tipe_brg : 1;

                if ($kd_tipe_brg == 1) {
                    // Get initial stock
                    $stok_awal = DB::table('mt_depo_stok_brg_jasa')
                        ->where('kode_brg', $kode_brg)
                        ->where('kode_bagian', '070101')
                        ->value('jml_sat_kcl');

                    $stok_awal = (int) ($stok_awal ?: 0);
                    $stok_akhir = $stok_awal - (int) $qty;

                    if ($stok_akhir < 0) {
                        throw new \Exception("Stok barang dengan kode {$kode_brg} tidak mencukupi (sisa: {$stok_awal}).");
                    }

                    // Update mt_depo_stok_brg_jasa
                    DB::table('mt_depo_stok_brg_jasa')
                        ->where('kode_brg', $kode_brg)
                        ->where('kode_bagian', '070101')
                        ->update([
                            'jml_sat_kcl' => $stok_akhir,
                        ]);

                    $currentHpp = DB::table('mt_barang_jasa')->where('kode_brg', $kode_brg)->value('harga_beli');

                    // Insert to tc_kartu_stok_brg_jasa
                    DB::table('tc_kartu_stok_brg_jasa')->insert([
                        'tgl_input' => $tglJam,
                        'kode_brg' => $kode_brg,
                        'stok_awal' => $stok_awal,
                        'pengeluaran' => $qty,
                        'pemasukan' => 0,
                        'stok_akhir' => $stok_akhir,
                        'harga_hpp' => (float) $currentHpp,
                        'jenis_transaksi' => 6,
                        'kode_bagian' => '070101',
                        'petugas' => $id_dd_user,
                        'keterangan' => 'Penjualan No. '.$no_registrasi,
                    ]);
                    
                    $total_hpp += (float) $currentHpp * (int) $qty;
                }

                // Insert to tc_trans_kasir_detail
                DB::table('tc_trans_kasir_detail')->insert([
                    'kode_tc_trans_kasir' => $kode_tc_trans_kasir,
                    'no_registrasi' => $no_registrasi,
                    'kode_brg' => $kode_brg,
                    'qty' => $qty,
                    'harga_jual' => $item['harga_jual'] ?? 0,
                    'subtotal' => ($item['harga_jual'] ?? 0) * $qty,
                    'tgl_input' => $tglJam,
                ]);
            }

            // JURNAL OTOMATIS POS KASIR
            // Debit: Kas (1111) sebesar $bill (Asumsi tunai/retail)
            // Kredit: Pendapatan Penjualan (4111) sebesar $bill
            // Debit: HPP (5111) sebesar $total_hpp
            // Kredit: Persediaan (1131) sebesar $total_hpp
            
            JurnalHelper::buatJurnalOtomatis(
                $no_registrasi,
                date('Y-m-d'),
                "Penjualan Kasir POS (No: {$no_registrasi})",
                [
                    ['kode_akun' => '1111', 'posisi' => 'debit', 'nominal' => $bill, 'keterangan' => 'Penerimaan Kasir'],
                    ['kode_akun' => '4111', 'posisi' => 'kredit', 'nominal' => $bill, 'keterangan' => 'Pendapatan Kasir'],
                    ['kode_akun' => '5111', 'posisi' => 'debit', 'nominal' => $total_hpp, 'keterangan' => 'HPP Kasir'],
                    ['kode_akun' => '1131', 'posisi' => 'kredit', 'nominal' => $total_hpp, 'keterangan' => 'Persediaan Keluar Kasir'],
                ]
            );

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil',
                'no_registrasi' => $no_registrasi,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Checkout Kasir Error: '.$e->getMessage()."\n".$e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function printStruk($no_registrasi)
    {
        $header = DB::table('tc_trans_kasir')
            ->where('no_registrasi', $no_registrasi)
            ->first();

        if (! $header) {
            abort(404, 'Transaksi tidak ditemukan');
        }

        $details = DB::table('tc_trans_kasir_detail as d')
            ->join('mt_barang_jasa as b', 'd.kode_brg', '=', 'b.kode_brg')
            ->where('d.no_registrasi', $no_registrasi)
            ->select('d.*', 'b.nama_brg')
            ->get();

        // Optionally get cashier name
        $kasir = DB::table('dd_user')->where('no_induk', $header->no_induk)->first();
        $nama_kasir = $kasir ? $kasir->username : $header->no_induk;

        return Inertia::render('Kasir/StrukKasir', [
            'header' => $header,
            'details' => $details,
            'nama_kasir' => $nama_kasir,
            'rs_name' => 'Sistem ERP', // Hardcoded or fetch from settings
        ]);
    }

    public function getRiwayat()
    {
        $id_dd_user = Session::get('id_dd_user');
        if (! $id_dd_user) {
            $id_dd_user = auth()->user() ? auth()->user()->id_dd_user : 'SYSTEM';
        }

        $riwayat = DB::table('tc_trans_kasir')
            ->where('no_induk', $id_dd_user)
            ->whereDate('tgl_jam', date('Y-m-d'))
            ->orderBy('tgl_jam', 'desc')
            ->get();

        return response()->json($riwayat);
    }

    public function batalTransaksi(Request $request, $no_registrasi)
    {
        $alasan = $request->input('alasan');
        if (empty($alasan)) {
            return response()->json(['success' => false, 'message' => 'Alasan pembatalan wajib diisi'], 400);
        }

        $id_dd_user = Session::get('id_dd_user');
        if (! $id_dd_user) {
            $id_dd_user = auth()->user() ? auth()->user()->id_dd_user : 'SYSTEM';
        }

        DB::beginTransaction();
        try {
            $header = DB::table('tc_trans_kasir')
                ->where('no_registrasi', $no_registrasi)
                ->where('no_induk', $id_dd_user)
                ->first();

            if (! $header) {
                throw new \Exception('Transaksi tidak ditemukan atau Anda tidak berhak membatalkannya.');
            }

            if ($header->status_batal == 1) {
                throw new \Exception('Transaksi ini sudah dibatalkan sebelumnya.');
            }

            // Mark as batal
            DB::table('tc_trans_kasir')
                ->where('no_registrasi', $no_registrasi)
                ->update([
                    'status_batal' => 1,
                    'tgl_batal' => now(),
                    'user_batal' => $id_dd_user,
                    'ket_batal' => $alasan,
                ]);

            // Restore stock
            $details = DB::table('tc_trans_kasir_detail')
                ->where('no_registrasi', $no_registrasi)
                ->get();

            $tglJam = now();

            foreach ($details as $detail) {
                $kode_brg = $detail->kode_brg;
                $qty = (int) $detail->qty;

                $barang = DB::table('mt_barang_jasa')->where('kode_brg', $kode_brg)->first();
                $kd_tipe_brg = $barang ? (int) $barang->kd_tipe_brg : 1;

                if ($kd_tipe_brg == 1) {
                    // Update mt_depo_stok_brg_jasa
                    $stok_awal = DB::table('mt_depo_stok_brg_jasa')
                        ->where('kode_brg', $kode_brg)
                        ->where('kode_bagian', '070101')
                        ->value('jml_sat_kcl');

                    $stok_awal = (int) ($stok_awal ?: 0);
                    $stok_akhir = $stok_awal + $qty;

                    DB::table('mt_depo_stok_brg_jasa')
                        ->where('kode_brg', $kode_brg)
                        ->where('kode_bagian', '070101')
                        ->update(['jml_sat_kcl' => $stok_akhir]);

                    $currentHpp = DB::table('mt_barang_jasa')->where('kode_brg', $kode_brg)->value('harga_beli');

                    // Record return in tc_kartu_stok_brg_jasa
                    DB::table('tc_kartu_stok_brg_jasa')->insert([
                        'tgl_input' => $tglJam,
                        'kode_brg' => $kode_brg,
                        'stok_awal' => $stok_awal,
                        'pengeluaran' => 0,
                        'pemasukan' => $qty,
                        'stok_akhir' => $stok_akhir,
                        'harga_hpp' => (float) $currentHpp,
                        'jenis_transaksi' => 7,
                        'kode_bagian' => '070101',
                        'petugas' => $id_dd_user,
                        'keterangan' => 'Retur/Batal Kasir No. '.$no_registrasi.' ('.$alasan.')',
                    ]);
                }
            }

            DB::commit();

            return response()->json(['success' => true, 'message' => 'Transaksi berhasil dibatalkan dan stok telah dikembalikan.']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Retur Kasir Error: '.$e->getMessage()."\n".$e->getTraceAsString());

            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function getTransaksiDetail($no_registrasi)
    {
        $details = DB::table('tc_trans_kasir_detail as d')
            ->join('mt_barang_jasa as b', 'd.kode_brg', '=', 'b.kode_brg')
            ->where('d.no_registrasi', $no_registrasi)
            ->select('d.*', 'b.nama_brg')
            ->get();

        return response()->json($details);
    }

    public function returParsial(Request $request, $no_registrasi)
    {
        $alasan = $request->input('alasan');
        $returItems = $request->input('retur_items', []); // [{kode_brg, qty_retur}]

        if (empty($alasan)) {
            return response()->json(['success' => false, 'message' => 'Alasan retur wajib diisi'], 400);
        }

        if (empty($returItems)) {
            return response()->json(['success' => false, 'message' => 'Tidak ada barang yang dipilih untuk diretur'], 400);
        }

        $id_dd_user = Session::get('id_dd_user');
        if (! $id_dd_user) {
            $id_dd_user = auth()->user() ? auth()->user()->id_dd_user : 'SYSTEM';
        }

        DB::beginTransaction();
        try {
            $header = DB::table('tc_trans_kasir')
                ->where('no_registrasi', $no_registrasi)
                ->where('no_induk', $id_dd_user)
                ->first();

            if (! $header) {
                throw new \Exception('Transaksi tidak ditemukan atau Anda tidak berhak membatalkannya.');
            }

            if ($header->status_batal == 1) {
                throw new \Exception('Transaksi ini sudah batal total sebelumnya.');
            }

            $totalRefund = 0;
            $tglJam = now();

            foreach ($returItems as $item) {
                $kode_brg = $item['kode_brg'];
                $qtyToReturn = (float) $item['qty_retur'];

                if ($qtyToReturn <= 0) {
                    continue;
                }

                $detail = DB::table('tc_trans_kasir_detail')
                    ->where('no_registrasi', $no_registrasi)
                    ->where('kode_brg', $kode_brg)
                    ->first();

                if (! $detail) {
                    throw new \Exception("Barang dengan kode {$kode_brg} tidak ditemukan di transaksi ini.");
                }

                $qty_awal = (float) $detail->qty;
                $qty_retur_existing = (float) ($detail->qty_retur ?? 0);

                $maxReturnable = $qty_awal - $qty_retur_existing;

                if ($qtyToReturn > $maxReturnable) {
                    throw new \Exception("Jumlah retur untuk barang {$kode_brg} melebihi maksimal yang bisa diretur ({$maxReturnable}).");
                }

                $new_qty_retur = $qty_retur_existing + $qtyToReturn;
                $harga_jual = (float) $detail->harga_jual;
                $refundAmount = $harga_jual * $qtyToReturn;
                $totalRefund += $refundAmount;

                // Update detail with new qty_retur and status_retur flag
                DB::table('tc_trans_kasir_detail')
                    ->where('id_tc_trans_kasir_detail', $detail->id_tc_trans_kasir_detail)
                    ->update([
                        'qty_retur' => $new_qty_retur,
                        'status_retur' => 1,
                    ]);

                $barang = DB::table('mt_barang_jasa')->where('kode_brg', $kode_brg)->first();
                $kd_tipe_brg = $barang ? (int) $barang->kd_tipe_brg : 1;

                if ($kd_tipe_brg == 1) {
                    // Update mt_depo_stok_brg_jasa
                    $stok_awal = DB::table('mt_depo_stok_brg_jasa')
                        ->where('kode_brg', $kode_brg)
                        ->where('kode_bagian', '070101')
                        ->value('jml_sat_kcl');

                    $stok_awal = (float) ($stok_awal ?: 0);
                    $stok_akhir = $stok_awal + $qtyToReturn;

                    DB::table('mt_depo_stok_brg_jasa')
                        ->where('kode_brg', $kode_brg)
                        ->where('kode_bagian', '070101')
                        ->update(['jml_sat_kcl' => $stok_akhir]);

                    $currentHpp = DB::table('mt_barang_jasa')->where('kode_brg', $kode_brg)->value('harga_beli');

                    // Record return in tc_kartu_stok_brg_jasa
                    DB::table('tc_kartu_stok_brg_jasa')->insert([
                        'tgl_input' => $tglJam,
                        'kode_brg' => $kode_brg,
                        'stok_awal' => $stok_awal,
                        'pengeluaran' => 0,
                        'pemasukan' => $qtyToReturn,
                        'stok_akhir' => $stok_akhir,
                        'harga_hpp' => (float) $currentHpp,
                        'jenis_transaksi' => 7,
                        'kode_bagian' => '070101',
                        'petugas' => $id_dd_user,
                        'keterangan' => 'Retur Parsial Kasir No. '.$no_registrasi.' ('.$alasan.')',
                    ]);
                }
            }

            if ($totalRefund > 0) {
                // Check if all items are fully returned
                $allDetails = DB::table('tc_trans_kasir_detail')
                    ->where('no_registrasi', $no_registrasi)
                    ->get();

                $allFullyReturned = true;
                foreach ($allDetails as $d) {
                    if ((float) $d->qty > (float) ($d->qty_retur ?? 0)) {
                        $allFullyReturned = false;
                        break;
                    }
                }

                $newBill = (float) $header->bill - $totalRefund;
                $newUangKembali = (float) $header->uang_kembali + $totalRefund;

                $updateData = [
                    'bill' => $newBill < 0 ? 0 : $newBill,
                    'uang_kembali' => $newUangKembali,
                ];

                if ($header->tunai > 0) $updateData['tunai'] = $updateData['bill'];
                if ($header->debet > 0) $updateData['debet'] = $updateData['bill'];
                if ($header->kredit > 0) $updateData['kredit'] = $updateData['bill'];

                if ($allFullyReturned) {
                    $updateData['status_batal'] = 1;
                    $updateData['tgl_batal'] = now();
                    $updateData['user_batal'] = $id_dd_user;
                    $updateData['ket_batal'] = $alasan.' (Via Retur Parsial Sisa 0)';
                }

                DB::table('tc_trans_kasir')
                    ->where('no_registrasi', $no_registrasi)
                    ->update($updateData);
            }

            DB::commit();

            return response()->json(['success' => true, 'message' => 'Retur sebagian berhasil diproses.']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Retur Parsial Error: '.$e->getMessage()."\n".$e->getTraceAsString());

            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
