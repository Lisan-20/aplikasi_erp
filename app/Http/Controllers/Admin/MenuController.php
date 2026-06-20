<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DcMenu;
use App\Models\DcModul;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $query = DcMenu::with('modul');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_menu', 'like', "%{$search}%")
                  ->orWhereHas('modul', function($q2) use ($search) {
                      $q2->where('nama_modul', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->has('id_dc_modul') && $request->id_dc_modul != '') {
            $query->where('dc_menu.id_dc_modul', $request->id_dc_modul);
        }

        // Sorting by modul order then menu order
        $menus = $query->join('dc_modul', 'dc_menu.id_dc_modul', '=', 'dc_modul.id_dc_modul')
            ->select('dc_menu.*')
            ->orderBy('dc_modul.nama_modul')
            ->orderBy('dc_menu.no_urut')
            ->paginate(20)
            ->withQueryString();

        $moduls = DcModul::orderBy('nama_modul')->get();

        return Inertia::render('Admin/Menu/Index', [
            'menus' => $menus,
            'moduls' => $moduls,
            'filters' => $request->only(['search', 'id_dc_modul']),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_dc_modul' => 'required|integer|exists:dc_modul,id_dc_modul',
            'nama_menu' => 'required|string|max:150',
            'url' => 'nullable|string|max:150',
            'no_urut' => 'nullable|integer',
            'status_menu' => 'nullable|string|max:1',
            'flag_not' => 'nullable|string|max:1',
        ]);

        DcMenu::create($validated);

        return redirect()->route('admin.menu')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $menu = DcMenu::findOrFail($id);

        $validated = $request->validate([
            'id_dc_modul' => 'required|integer|exists:dc_modul,id_dc_modul',
            'nama_menu' => 'required|string|max:150',
            'url' => 'nullable|string|max:150',
            'no_urut' => 'nullable|integer',
            'status_menu' => 'nullable|string|max:1',
            'flag_not' => 'nullable|string|max:1',
        ]);

        $menu->update($validated);

        return redirect()->route('admin.menu')->with('success', 'Menu berhasil diupdate.');
    }

    public function destroy($id)
    {
        $menu = DcMenu::findOrFail($id);
        
        // Check if there are submenus related
        if ($menu->subMenus()->count() > 0) {
            return redirect()->route('admin.menu')->with('error', 'Tidak dapat menghapus menu karena masih memiliki sub menu.');
        }

        $menu->delete();

        return redirect()->route('admin.menu')->with('success', 'Menu berhasil dihapus.');
    }

    public function sort(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|integer',
            'items.*.no_urut' => 'required|integer',
        ]);

        foreach ($validated['items'] as $item) {
            DcMenu::where('id_dc_menu', $item['id'])->update(['no_urut' => $item['no_urut']]);
        }

        return redirect()->route('admin.menu')->with('success', 'Urutan berhasil disimpan.');
    }
}
