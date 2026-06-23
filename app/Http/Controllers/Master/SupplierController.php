<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\MtErpSupplier;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = MtErpSupplier::query()->where('is_active', true);

        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('nama_supplier', 'like', '%' . $searchTerm . '%')
                  ->orWhere('alamat', 'like', '%' . $searchTerm . '%')
                  ->orWhere('kode_supplier', 'like', '%' . $searchTerm . '%');
            });
        }

        $suppliers = $query->orderBy('nama_supplier')->paginate(20)->withQueryString();

        return Inertia::render('Master/Supplier/Index', [
            'suppliers' => $suppliers,
            'filters' => $request->only('search')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_supplier' => 'required|string|max:50|unique:mt_erp_supplier,kode_supplier',
            'nama_supplier' => 'required|string|max:150',
            'alamat' => 'nullable|string',
            'provinsi_id' => 'nullable|integer|exists:mt_erp_provinsi,id',
            'kota_id' => 'nullable|integer|exists:mt_erp_kota,id',
            'kota' => 'nullable|string|max:100',
            'provinsi' => 'nullable|string|max:100',
            'kodepos' => 'nullable|string|max:20',
            'telepon_1' => 'nullable|string|max:30',
            'telepon_2' => 'nullable|string|max:30',
            'kontak_person' => 'nullable|string|max:100',
            'npwp' => 'nullable|string|max:50',
            'izin_usaha' => 'nullable|string|max:100',
            'nama_bank' => 'nullable|string|max:100',
        ]);

        MtErpSupplier::create($validated);

        return redirect()->back()->with('success', 'Supplier berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $supplier = MtErpSupplier::findOrFail($id);

        $validated = $request->validate([
            'kode_supplier' => 'required|string|max:50|unique:mt_erp_supplier,kode_supplier,' . $supplier->id,
            'nama_supplier' => 'required|string|max:150',
            'alamat' => 'nullable|string',
            'provinsi_id' => 'nullable|integer|exists:mt_erp_provinsi,id',
            'kota_id' => 'nullable|integer|exists:mt_erp_kota,id',
            'kota' => 'nullable|string|max:100',
            'provinsi' => 'nullable|string|max:100',
            'kodepos' => 'nullable|string|max:20',
            'telepon_1' => 'nullable|string|max:30',
            'telepon_2' => 'nullable|string|max:30',
            'kontak_person' => 'nullable|string|max:100',
            'npwp' => 'nullable|string|max:50',
            'izin_usaha' => 'nullable|string|max:100',
            'nama_bank' => 'nullable|string|max:100',
        ]);

        $supplier->update($validated);

        return redirect()->back()->with('success', 'Supplier berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = MtErpSupplier::findOrFail($id);
        $supplier->update(['is_active' => false]);

        return redirect()->back()->with('success', 'Supplier berhasil dihapus.');
    }
}
