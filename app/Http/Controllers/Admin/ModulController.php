<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DcModul;
use App\Models\DcModular;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ModulController extends Controller
{
    public function index(Request $request)
    {
        $query = DcModul::with('modular');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_modul', 'like', "%{$search}%")
                    ->orWhere('folder', 'like', "%{$search}%")
                    ->orWhereHas('modular', function ($q2) use ($search) {
                        $q2->where('nama_modular', 'like', "%{$search}%");
                    });
            });
        }

        // Sorting by modular order then modul order
        $moduls = $query->join('dc_modular', 'dc_modul.id_dc_modular', '=', 'dc_modular.id_dc_modular')
            ->select('dc_modul.*')
            ->orderBy('dc_modular.no_urut_modular')
            ->orderBy('dc_modul.no_urut')
            ->paginate(20)
            ->withQueryString();

        $modulars = DcModular::orderBy('nama_modular')->get();

        return Inertia::render('Admin/Modul/Index', [
            'moduls' => $moduls,
            'modulars' => $modulars,
            'filters' => $request->only(['search']),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_dc_modular' => 'required|integer|exists:dc_modular,id_dc_modular',
            'nama_modul' => 'required|string|max:150',
            'folder' => 'nullable|string|max:150',
            'logo' => 'nullable|string|max:150',
            'kode_bagian' => 'nullable|string|max:50',
            'no_urut' => 'nullable|integer',
            'status_modul' => 'nullable|string|max:1',
        ]);

        DcModul::create($validated);

        return redirect()->route('admin.modul')->with('success', 'Modul berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $modul = DcModul::findOrFail($id);

        $validated = $request->validate([
            'id_dc_modular' => 'required|integer|exists:dc_modular,id_dc_modular',
            'nama_modul' => 'required|string|max:150',
            'folder' => 'nullable|string|max:150',
            'logo' => 'nullable|string|max:150',
            'kode_bagian' => 'nullable|string|max:50',
            'no_urut' => 'nullable|integer',
            'status_modul' => 'nullable|string|max:1',
        ]);

        $modul->update($validated);

        return redirect()->route('admin.modul')->with('success', 'Modul berhasil diupdate.');
    }

    public function destroy($id)
    {
        $modul = DcModul::findOrFail($id);

        // Check if there are menus related
        if ($modul->menus()->count() > 0) {
            return redirect()->route('admin.modul')->with('error', 'Tidak dapat menghapus modul karena masih memiliki menu.');
        }

        $modul->delete();

        return redirect()->route('admin.modul')->with('success', 'Modul berhasil dihapus.');
    }

    public function sort(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|integer',
            'items.*.no_urut' => 'required|integer',
        ]);

        foreach ($validated['items'] as $item) {
            DcModul::where('id_dc_modul', $item['id'])->update(['no_urut' => $item['no_urut']]);
        }

        return redirect()->route('admin.modul')->with('success', 'Urutan berhasil disimpan.');
    }
}
