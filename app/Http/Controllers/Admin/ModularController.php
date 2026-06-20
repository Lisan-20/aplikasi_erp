<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DcModular;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ModularController extends Controller
{
    public function index(Request $request)
    {
        $query = DcModular::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_modular', 'like', "%{$search}%")
                  ->orWhere('kd_modular', 'like', "%{$search}%");
            });
        }

        $modulars = $query->orderBy('no_urut_modular')->paginate(20)->withQueryString();

        return Inertia::render('Admin/Modular/Index', [
            'modulars' => $modulars,
            'filters' => $request->only(['search']),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_modular' => 'required|string|max:150',
            'no_urut_modular' => 'nullable|integer',
            'kd_modular' => 'nullable|string|max:50',
        ]);

        DcModular::create($validated);

        return redirect()->route('admin.modular')->with('success', 'Kelompok Modul berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $modular = DcModular::findOrFail($id);

        $validated = $request->validate([
            'nama_modular' => 'required|string|max:150',
            'no_urut_modular' => 'nullable|integer',
            'kd_modular' => 'nullable|string|max:50',
        ]);

        $modular->update($validated);

        return redirect()->route('admin.modular')->with('success', 'Kelompok Modul berhasil diupdate.');
    }

    public function destroy($id)
    {
        $modular = DcModular::findOrFail($id);
        
        // Check if there are modules related
        if ($modular->moduls()->count() > 0) {
            return redirect()->route('admin.modular')->with('error', 'Tidak dapat menghapus kelompok modul karena masih memiliki modul.');
        }

        $modular->delete();

        return redirect()->route('admin.modular')->with('success', 'Kelompok Modul berhasil dihapus.');
    }

    public function sort(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|integer',
            'items.*.no_urut' => 'required|integer',
        ]);

        foreach ($validated['items'] as $item) {
            DcModular::where('id_dc_modular', $item['id'])->update(['no_urut_modular' => $item['no_urut']]);
        }

        return redirect()->route('admin.modular')->with('success', 'Urutan berhasil disimpan.');
    }
}
