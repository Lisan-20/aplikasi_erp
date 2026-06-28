<?php

namespace App\Http\Controllers\Gudang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Carbon\Carbon;

class PenerimaanInternalController extends Controller
{
    public function index(Request $request)
    {
        $id_modul = Session::get('active_modul');
        $kode_bagian_modul = $id_modul ? DB::table('dc_modul')->where('id_dc_modul', $id_modul)->value('kode_bagian') : null;
        $kode_bagian = $kode_bagian_modul ?? Session::get('kode_bagian') ?? '070101'; // Default if none

        $query = DB::table('tc_permintaan_inst_nm')
            ->leftJoin('mt_bagian as b_asal', 'tc_permintaan_inst_nm.kode_bagian_kirim', '=', 'b_asal.kode_bagian')
            ->leftJoin('mt_karyawan as k_kirim', 'tc_permintaan_inst_nm.id_dd_user', '=', 'k_kirim.no_induk')
            ->leftJoin('mt_karyawan as k_terima', 'tc_permintaan_inst_nm.id_dd_user_terima', '=', 'k_terima.no_induk')
            ->select(
                'tc_permintaan_inst_nm.*',
                'b_asal.nama_bagian as asal_bagian',
                'k_kirim.nama_pegawai as pengirim',
                'k_terima.nama_pegawai as penerima'
            )
            ->where('tc_permintaan_inst_nm.kode_bagian_minta', $kode_bagian);

        // Filter status (Pending vs Selesai)
        $status = $request->input('status', 'pending');
        if ($status === 'pending') {
            $query->whereNull('tc_permintaan_inst_nm.tgl_input_terima');
        } else {
            $query->whereNotNull('tc_permintaan_inst_nm.tgl_input_terima');
        }

        $penerimaan = $query->orderBy('tc_permintaan_inst_nm.id_tc_permintaan_inst', 'desc')
            ->paginate(20)
            ->withQueryString();

        return Inertia::render('Gudang/PenerimaanInternal/Index', [
            'penerimaan' => $penerimaan,
            'filters' => [
                'status' => $status,
            ],
            'kode_bagian' => $kode_bagian
        ]);
    }

    public function show($id)
    {
        $id_modul = Session::get('active_modul');
        $kode_bagian_modul = $id_modul ? DB::table('dc_modul')->where('id_dc_modul', $id_modul)->value('kode_bagian') : null;
        $kode_bagian = $kode_bagian_modul ?? Session::get('kode_bagian') ?? '070101';
        
        $penerimaan = DB::table('tc_permintaan_inst_nm')
            ->leftJoin('mt_bagian as b_asal', 'tc_permintaan_inst_nm.kode_bagian_kirim', '=', 'b_asal.kode_bagian')
            ->leftJoin('mt_karyawan as k_kirim', 'tc_permintaan_inst_nm.id_dd_user', '=', 'k_kirim.no_induk')
            ->leftJoin('mt_karyawan as k_terima', 'tc_permintaan_inst_nm.id_dd_user_terima', '=', 'k_terima.no_induk')
            ->select(
                'tc_permintaan_inst_nm.*',
                'b_asal.nama_bagian as asal_bagian',
                'k_kirim.nama_pegawai as pengirim',
                'k_terima.nama_pegawai as penerima'
            )
            ->where('tc_permintaan_inst_nm.id_tc_permintaan_inst', $id)
            ->where('tc_permintaan_inst_nm.kode_bagian_minta', $kode_bagian)
            ->first();

        if (!$penerimaan) {
            return response()->json(['error' => 'Not found or unauthorized'], 404);
        }

        $details = DB::table('tc_permintaan_inst_nm_det')
            ->join('mt_barang_jasa', 'tc_permintaan_inst_nm_det.kode_brg', '=', 'mt_barang_jasa.kode_brg')
            ->select(
                'tc_permintaan_inst_nm_det.*',
                'mt_barang_jasa.nama_brg',
                'mt_barang_jasa.satuan_kecil'
            )
            ->where('tc_permintaan_inst_nm_det.id_tc_permintaan_inst', $id)
            ->get();

        return response()->json([
            'penerimaan' => $penerimaan,
            'details' => $details
        ]);
    }

    public function terima($id, Request $request)
    {
        $id_dd_user = Session::get('id_dd_user') ?? 1;
        $id_modul = Session::get('active_modul');
        $kode_bagian_modul = $id_modul ? DB::table('dc_modul')->where('id_dc_modul', $id_modul)->value('kode_bagian') : null;
        $kode_bagian = $kode_bagian_modul ?? Session::get('kode_bagian') ?? '070101';

        try {
            DB::beginTransaction();

            $penerimaan = DB::table('tc_permintaan_inst_nm')
                ->where('id_tc_permintaan_inst', $id)
                ->where('kode_bagian_minta', $kode_bagian)
                ->whereNull('tgl_input_terima')
                ->lockForUpdate()
                ->first();

            if (!$penerimaan) {
                return redirect()->back()->with('error', 'Dokumen tidak ditemukan atau sudah diterima.');
            }

            $details = DB::table('tc_permintaan_inst_nm_det')
                ->where('id_tc_permintaan_inst', $id)
                ->get();

            foreach ($details as $item) {
                $jumlah = (float) $item->jumlah_permintaan;

                // Update Stok Tujuan
                $stokTujuanExist = DB::table('mt_depo_stok_brg_jasa')
                    ->where('kode_brg', $item->kode_brg)
                    ->where('kode_bagian', $kode_bagian)
                    ->lockForUpdate()
                    ->first();

                $stok_awal_tujuan = $stokTujuanExist ? (float) $stokTujuanExist->jml_sat_kcl : 0;
                $stok_akhir_tujuan = $stok_awal_tujuan + $jumlah;

                if ($stokTujuanExist) {
                    DB::table('mt_depo_stok_brg_jasa')
                        ->where('kode_brg', $item->kode_brg)
                        ->where('kode_bagian', $kode_bagian)
                        ->update(['jml_sat_kcl' => $stok_akhir_tujuan]);
                } else {
                    DB::table('mt_depo_stok_brg_jasa')->insert([
                        'kode_brg' => $item->kode_brg,
                        'kode_bagian' => $kode_bagian,
                        'jml_sat_kcl' => $stok_akhir_tujuan
                    ]);
                }

                // Kartu Stok Log Tujuan
                $keterangan_tujuan = "Penerimaan Internal dari Bagian (" . $penerimaan->kode_bagian_kirim . ") (No: " . $penerimaan->nomor_permintaan . ")";
                $currentHpp = DB::table('mt_barang_jasa')->where('kode_brg', $item->kode_brg)->value('harga_beli');

                DB::table('tc_kartu_stok_brg_jasa')->insert([
                    'tgl_input' => now(),
                    'kode_brg' => $item->kode_brg,
                    'stok_awal' => $stok_awal_tujuan,
                    'pemasukan' => $jumlah,
                    'pengeluaran' => 0,
                    'stok_akhir' => $stok_akhir_tujuan,
                    'harga_hpp' => (float) $currentHpp,
                    'jenis_transaksi' => 9, // Penerimaan Internal
                    'kode_bagian' => $kode_bagian,
                    'petugas' => $id_dd_user,
                    'keterangan' => $keterangan_tujuan,
                ]);
            }

            // Update Header
            DB::table('tc_permintaan_inst_nm')
                ->where('id_tc_permintaan_inst', $id)
                ->update([
                    'tgl_input_terima' => now(),
                    'id_dd_user_terima' => $id_dd_user
                ]);

            DB::commit();

            return redirect()->back()->with('success', 'Penerimaan barang berhasil dikonfirmasi.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memproses penerimaan: ' . $e->getMessage());
        }
    }
}
