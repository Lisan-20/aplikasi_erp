<?php

namespace App\Http\Controllers\Gudang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class LaporanStokController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $kodeBrg = $request->input('kode_brg');
        
        $laporan = [];
        $totalItems = 0;
        
        // Dapatkan kode bagian
        $id_modul = Session::get('active_modul');
        $kode_bagian_modul = $id_modul ? DB::table('dc_modul')->where('id_dc_modul', $id_modul)->value('kode_bagian') : null;
        $kode_bagian = $kode_bagian_modul ?? Session::get('kode_bagian') ?? '070101';

        // Hanya query jika filter tanggal diisi
        if ($startDate && $endDate) {
            $query = DB::table('tc_kartu_stok_brg_jasa')
                ->join('mt_barang_jasa', 'tc_kartu_stok_brg_jasa.kode_brg', '=', 'mt_barang_jasa.kode_brg')
                ->select(
                    'tc_kartu_stok_brg_jasa.*',
                    'mt_barang_jasa.nama_brg',
                    'mt_barang_jasa.satuan_kecil'
                )
                ->where('tc_kartu_stok_brg_jasa.kode_bagian', $kode_bagian)
                ->whereBetween(DB::raw('CAST(tc_kartu_stok_brg_jasa.tgl_input AS DATE)'), [$startDate, $endDate]);

            if ($kodeBrg) {
                $query->where('tc_kartu_stok_brg_jasa.kode_brg', $kodeBrg);
            }

            $laporan = $query->orderBy('tc_kartu_stok_brg_jasa.tgl_input', 'asc')
                             ->paginate(50)
                             ->withQueryString();
            
            $totalItems = $laporan->total();
        }

        return Inertia::render('Gudang/LaporanStok/Index', [
            'laporan' => $laporan,
            'filters' => [
                'start_date' => $startDate,
                'end_date' => $endDate,
                'kode_brg' => $kodeBrg
            ],
            'totalItems' => $totalItems
        ]);
    }

    public function searchBarang(Request $request)
    {
        $search = $request->input('q');
        
        $query = DB::table('mt_barang_jasa')
            ->select('kode_brg', 'nama_brg', 'satuan_kecil');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('kode_brg', 'like', "%{$search}%")
                  ->orWhere('nama_brg', 'like', "%{$search}%");
            });
        }

        return response()->json($query->limit(20)->get());
    }

    private function getFilteredQuery($request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $kodeBrg = $request->input('kode_brg');
        
        $id_modul = Session::get('active_modul');
        $kode_bagian_modul = $id_modul ? DB::table('dc_modul')->where('id_dc_modul', $id_modul)->value('kode_bagian') : null;
        $kode_bagian = $kode_bagian_modul ?? Session::get('kode_bagian') ?? '070101';

        $query = DB::table('tc_kartu_stok_brg_jasa')
            ->join('mt_barang_jasa', 'tc_kartu_stok_brg_jasa.kode_brg', '=', 'mt_barang_jasa.kode_brg')
            ->select(
                'tc_kartu_stok_brg_jasa.*',
                'mt_barang_jasa.nama_brg',
                'mt_barang_jasa.satuan_kecil'
            )
            ->where('tc_kartu_stok_brg_jasa.kode_bagian', $kode_bagian)
            ->whereBetween(DB::raw('CAST(tc_kartu_stok_brg_jasa.tgl_input AS DATE)'), [$startDate, $endDate]);

        if ($kodeBrg) {
            $query->where('tc_kartu_stok_brg_jasa.kode_brg', $kodeBrg);
        }

        return $query->orderBy('tc_kartu_stok_brg_jasa.tgl_input', 'asc');
    }

    public function exportCsv(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        if (!$startDate || !$endDate) return redirect()->back();

        $data = $this->getFilteredQuery($request)->get();
        $filename = "Laporan_Kartu_Stok_{$startDate}_sampai_{$endDate}.csv";

        $headers = [
            "Content-type"        => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['Tanggal', 'Kode Barang', 'Nama Barang', 'Stok Awal', 'Pemasukan', 'Pengeluaran', 'Stok Akhir', 'Harga HPP', 'Total Nilai', 'Jenis Transaksi', 'Keterangan'];
        
        $jenisTransaksiMap = [
            1 => 'Penerimaan',
            2 => 'Retur ke Supplier',
            4 => 'Stok Opname',
            6 => 'Penjualan (Kasir)',
            7 => 'Retur / Batal (Kasir)',
            8 => 'Pengeluaran Internal',
            9 => 'Penerimaan Internal'
        ];

        $callback = function() use($data, $columns, $jenisTransaksiMap, $startDate, $endDate) {
            $file = fopen('php://output', 'w');
            
            // Add UTF-8 BOM for Excel
            fputs($file, "\xEF\xBB\xBF");
            
            $id_modul = Session::get('active_modul');
            $kode_bagian_modul = $id_modul ? DB::table('dc_modul')->where('id_dc_modul', $id_modul)->value('kode_bagian') : null;
            $kode_bagian = $kode_bagian_modul ?? Session::get('kode_bagian') ?? '070101';
            $nama_bagian = DB::table('mt_bagian')->where('kode_bagian', $kode_bagian)->value('nama_bagian') ?? 'Depo Utama';

            // Header information
            fputcsv($file, ['LAPORAN SALDO PERSEDIAAN (KARTU STOK)'], ';');
            fputcsv($file, ["Periode: $startDate s/d $endDate"], ';');
            fputcsv($file, ["Gudang: $nama_bagian ($kode_bagian)"], ';');
            fputcsv($file, [], ';'); // Empty row

            fputcsv($file, $columns, ';');
            
            foreach ($data as $item) {
                $jenis = $jenisTransaksiMap[$item->jenis_transaksi] ?? 'Transaksi Lain';
                $total_nilai = $item->stok_akhir * ($item->harga_hpp ?? 0);
                fputcsv($file, [
                    \Carbon\Carbon::parse($item->tgl_input)->format('d/m/Y H:i'),
                    $item->kode_brg,
                    $item->nama_brg,
                    $item->stok_awal,
                    $item->pemasukan,
                    $item->pengeluaran,
                    $item->stok_akhir,
                    $item->harga_hpp ?? 0,
                    $total_nilai,
                    $jenis,
                    $item->keterangan
                ], ';');
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function cetak(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        if (!$startDate || !$endDate) return redirect()->back();

        $data = $this->getFilteredQuery($request)->get();
        $jenisTransaksiMap = [
            1 => 'Penerimaan',
            2 => 'Retur ke Supplier',
            4 => 'Stok Opname',
            6 => 'Penjualan (Kasir)',
            7 => 'Retur / Batal (Kasir)',
            8 => 'Pengeluaran Internal',
            9 => 'Penerimaan Internal'
        ];

        $id_modul = Session::get('active_modul');
        $kode_bagian_modul = $id_modul ? DB::table('dc_modul')->where('id_dc_modul', $id_modul)->value('kode_bagian') : null;
        $kode_bagian = $kode_bagian_modul ?? Session::get('kode_bagian') ?? '070101';
        $nama_bagian = DB::table('mt_bagian')->where('kode_bagian', $kode_bagian)->value('nama_bagian') ?? 'Depo Utama';

        return view('gudang.laporan_stok_cetak', compact('data', 'startDate', 'endDate', 'jenisTransaksiMap', 'kode_bagian', 'nama_bagian'));
    }
}
