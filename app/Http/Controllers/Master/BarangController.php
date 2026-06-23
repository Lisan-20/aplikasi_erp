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
        $query = DB::table('mt_barang_jasa');

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
            'kode_brg' => 'required|max:50|unique:mt_barang_jasa,kode_brg',
            'nama_brg' => 'required|max:255',
            'satuan_besar' => 'nullable|max:50',
            'satuan_kecil' => 'nullable|max:50',
            'harga_beli' => 'nullable|numeric',
            'harga_jual' => 'nullable|numeric',
        ]);

        try {
            DB::table('mt_barang_jasa')->insert([
                'kode_brg' => $request->kode_brg,
                'nama_brg' => $request->nama_brg,
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
            'satuan_besar' => 'nullable|max:50',
            'satuan_kecil' => 'nullable|max:50',
            'harga_beli' => 'nullable|numeric',
            'harga_jual' => 'nullable|numeric',
        ]);

        try {
            DB::table('mt_barang_jasa')->where('kode_brg', $id)->update([
                'nama_brg' => $request->nama_brg,
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
