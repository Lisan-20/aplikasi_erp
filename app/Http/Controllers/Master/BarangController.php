<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('mt_barang_jasa')
            ->select('mt_barang_jasa.*', DB::raw('ISNULL((SELECT SUM(jml_sat_kcl) FROM mt_depo_stok_brg_jasa WHERE mt_depo_stok_brg_jasa.kode_brg = mt_barang_jasa.kode_brg), 0) as jml_stok_brg'));

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama_brg', 'LIKE', '%'.$search.'%')
                ->orWhere('kode_brg', 'LIKE', '%'.$search.'%');
        }

        // Urutkan berdasarkan nama
        $barang = $query->orderBy('nama_brg', 'asc')->paginate(20)->withQueryString();

        return Inertia::render('Master/Barang/Index', [
            'barang' => $barang,
            'filters' => $request->only('search'),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_brg' => 'nullable|max:50|unique:mt_barang_jasa,kode_brg',
            'nama_brg' => 'required|max:255',
            'kd_tipe_brg' => 'required|in:1,2',
            'kode_kategori' => 'nullable|max:50',
            'satuan_besar' => 'nullable|max:50',
            'satuan_kecil' => 'nullable|max:50',
            'harga_beli' => 'nullable|numeric',
            'harga_jual' => 'nullable|numeric',
        ]);

        try {
            $kode_brg = $request->kode_brg;
            if (empty($kode_brg)) {
                $prefix = ($request->kd_tipe_brg == 2) ? 'JSA-' : 'BRG-';
                $lastItem = DB::table('mt_barang_jasa')
                    ->where('kode_brg', 'like', $prefix.'%')
                    ->orderByRaw('CAST(SUBSTRING(kode_brg, 5, LEN(kode_brg)) AS INT) DESC')
                    ->first();
                
                if ($lastItem) {
                    $lastNumber = (int) substr($lastItem->kode_brg, 4);
                    $kode_brg = $prefix . str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
                } else {
                    $kode_brg = $prefix . '0001';
                }
            }

            $maxId = DB::table('mt_barang_jasa')->max('id_barang') ?? 0;

            DB::table('mt_barang_jasa')->insert([
                'id_barang' => $maxId + 1,
                'kode_brg' => $kode_brg,
                'nama_brg' => $request->nama_brg,
                'kd_tipe_brg' => $request->kd_tipe_brg,
                'kode_kategori' => $request->kode_kategori,
                'satuan_besar' => $request->satuan_besar,
                'satuan_kecil' => $request->satuan_kecil,
                'harga_beli' => $request->harga_beli ?? 0,
                'harga_jual' => $request->harga_jual ?? 0,
                'jml_stok_brg' => 0, // Stok awal selalu 0, diisi lewat Gudang/Penerimaan
                'status' => 1,
            ]);

            return redirect()->back()->with('success', 'Master Barang berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan barang: '.$e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        // $id is kode_brg
        $request->validate([
            'nama_brg' => 'required|max:255',
            'kd_tipe_brg' => 'required|in:1,2',
            'kode_kategori' => 'nullable|max:50',
            'satuan_besar' => 'nullable|max:50',
            'satuan_kecil' => 'nullable|max:50',
            'harga_beli' => 'nullable|numeric',
            'harga_jual' => 'nullable|numeric',
        ]);

        try {
            DB::table('mt_barang_jasa')->where('kode_brg', $id)->update([
                'nama_brg' => $request->nama_brg,
                'kd_tipe_brg' => $request->kd_tipe_brg,
                'kode_kategori' => $request->kode_kategori,
                'satuan_besar' => $request->satuan_besar,
                'satuan_kecil' => $request->satuan_kecil,
                'harga_beli' => $request->harga_beli ?? 0,
                'harga_jual' => $request->harga_jual ?? 0,
            ]);

            return redirect()->back()->with('success', 'Data Barang berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui barang: '.$e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            // Daripada menghapus permanen, kita ubah status jadi 0
            DB::table('mt_barang_jasa')->where('kode_brg', $id)->update(['status' => 0]);

            return redirect()->back()->with('success', 'Barang berhasil dinonaktifkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menonaktifkan barang: '.$e->getMessage());
        }
    }
}
