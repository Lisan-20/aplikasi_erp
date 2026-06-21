<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('mt_supplier');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('namasupplier', 'LIKE', '%'.$search.'%')
                ->orWhere('kodesupplier', 'LIKE', '%'.$search.'%')
                ->orWhere('kontakperson', 'LIKE', '%'.$search.'%');
        }

        // Urutkan berdasarkan ID terbaru atau nama
        $suppliers = $query->orderBy('namasupplier', 'asc')->paginate(20)->withQueryString();

        return Inertia::render('Master/Supplier/Index', [
            'suppliers' => $suppliers,
            'filters' => $request->only('search'),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kodesupplier' => 'required|max:50',
            'namasupplier' => 'required|max:255',
            'alamat' => 'nullable|max:500',
            'telpon1' => 'nullable|max:50',
            'kontakperson' => 'nullable|max:100',
        ]);

        try {
            DB::table('mt_supplier')->insert([
                'kodesupplier' => $request->kodesupplier,
                'namasupplier' => $request->namasupplier,
                'alamat' => $request->alamat,
                'telpon1' => $request->telpon1,
                'kontakperson' => $request->kontakperson,
                'status_aktif' => 1, // Default aktif
            ]);

            return redirect()->back()->with('success', 'Supplier berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan supplier: '.$e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kodesupplier' => 'required|max:50',
            'namasupplier' => 'required|max:255',
            'alamat' => 'nullable|max:500',
            'telpon1' => 'nullable|max:50',
            'kontakperson' => 'nullable|max:100',
        ]);

        try {
            DB::table('mt_supplier')->where('id_mt_supplier', $id)->update([
                'kodesupplier' => $request->kodesupplier,
                'namasupplier' => $request->namasupplier,
                'alamat' => $request->alamat,
                'telpon1' => $request->telpon1,
                'kontakperson' => $request->kontakperson,
            ]);

            return redirect()->back()->with('success', 'Data supplier berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui supplier: '.$e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            // Daripada menghapus permanen, kita nonaktifkan (soft delete via status)
            // Cek dulu apakah kolom status_aktif ada
            DB::table('mt_supplier')->where('id_mt_supplier', $id)->update(['status_aktif' => 0]);

            return redirect()->back()->with('success', 'Supplier berhasil dinonaktifkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menonaktifkan supplier: '.$e->getMessage());
        }
    }
}
