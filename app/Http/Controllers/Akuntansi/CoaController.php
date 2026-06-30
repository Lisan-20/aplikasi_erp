<?php

namespace App\Http\Controllers\Akuntansi;

use App\Http\Controllers\Controller;
use App\Models\Coa;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class CoaController extends Controller
{
    public function index(Request $request)
    {
        $query = Coa::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('kode_akun', 'like', '%' . $request->search . '%')
                  ->orWhere('nama_akun', 'like', '%' . $request->search . '%');
        }

        $coas = $query->orderBy('kode_akun')->paginate(30)->withQueryString();
        $parentCoas = Coa::where('level', '<', 4)->orderBy('kode_akun')->get(); // For dropdown in modal

        return Inertia::render('Akuntansi/Coa/Index', [
            'coas' => $coas,
            'parentCoas' => $parentCoas,
            'filters' => $request->only(['search'])
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_akun' => 'required|string|max:50|unique:mt_erp_coa,kode_akun',
            'nama_akun' => 'required|string|max:255',
            'level' => 'required|integer',
            'parent_id' => 'nullable|integer',
            'tipe_akun' => 'nullable|string|max:100',
            'kategori' => 'nullable|string|max:100',
            'is_kas_bank' => 'boolean',
            'is_active' => 'boolean'
        ]);

        $validated['is_kas_bank'] = $request->is_kas_bank ? 1 : 0;
        $validated['is_active'] = $request->has('is_active') ? ($request->is_active ? 1 : 0) : 1;

        Coa::create($validated);
        return redirect()->back()->with('success', 'Akun berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $coa = Coa::findOrFail($id);
        $validated = $request->validate([
            'kode_akun' => 'required|string|max:50|unique:mt_erp_coa,kode_akun,'.$id,
            'nama_akun' => 'required|string|max:255',
            'level' => 'required|integer',
            'parent_id' => 'nullable|integer',
            'tipe_akun' => 'nullable|string|max:100',
            'kategori' => 'nullable|string|max:100',
            'is_kas_bank' => 'boolean',
            'is_active' => 'boolean'
        ]);

        $validated['is_kas_bank'] = $request->is_kas_bank ? 1 : 0;
        $validated['is_active'] = $request->has('is_active') ? ($request->is_active ? 1 : 0) : 1;

        $coa->update($validated);
        return redirect()->back()->with('success', 'Akun berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $coa = Coa::findOrFail($id);
        // cek apakah sudah dipakai di jurnal detail
        $countJurnal = DB::table('tc_erp_jurnal_detail')->where('id_coa', $id)->count();
        if ($countJurnal > 0) {
            return redirect()->back()->with('error', 'Akun tidak bisa dihapus karena sudah dipakai dalam jurnal.');
        }

        $coa->delete();
        return redirect()->back()->with('success', 'Akun berhasil dihapus.');
    }
}

