<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DcMenu;
use App\Models\DcModul;
use App\Models\DcSubMenu;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubMenuController extends Controller
{
    public function index(Request $request)
    {
        $query = DcSubMenu::with(['menu.modul']);

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_sub_menu', 'like', "%{$search}%")
                    ->orWhereHas('menu', function ($q2) use ($search) {
                        $q2->where('nama_menu', 'like', "%{$search}%")
                            ->orWhereHas('modul', function ($q3) use ($search) {
                                $q3->where('nama_modul', 'like', "%{$search}%");
                            });
                    });
            });
        }

        if ($request->has('id_dc_modul') && $request->id_dc_modul != '') {
            $query->whereHas('menu', function ($q) use ($request) {
                $q->where('id_dc_modul', $request->id_dc_modul);
            });
        }

        if ($request->has('id_dc_menu') && $request->id_dc_menu != '') {
            $query->where('dc_sub_menu.id_dc_menu', $request->id_dc_menu);
        }

        // Sorting by modul order, menu order, then submenu order
        $submenus = $query->join('dc_menu', 'dc_sub_menu.id_dc_menu', '=', 'dc_menu.id_dc_menu')
            ->join('dc_modul', 'dc_menu.id_dc_modul', '=', 'dc_modul.id_dc_modul')
            ->select('dc_sub_menu.*')
            ->orderBy('dc_modul.nama_modul')
            ->orderBy('dc_menu.no_urut')
            ->orderBy('dc_sub_menu.no_urut')
            ->paginate(20)
            ->withQueryString();

        $moduls = DcModul::orderBy('nama_modul')->get();
        $menus = DcMenu::orderBy('nama_menu')->get();

        return Inertia::render('Admin/SubMenu/Index', [
            'submenus' => $submenus,
            'moduls' => $moduls,
            'menus' => $menus,
            'filters' => $request->only(['search', 'id_dc_modul', 'id_dc_menu']),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_dc_menu' => 'required|integer|exists:dc_menu,id_dc_menu',
            'nama_sub_menu' => 'required|string|max:150',
            'url_sub_menu' => 'nullable|string|max:150',
            'url_sub_menu_baru' => 'nullable|string|max:150',
            'keterangan' => 'nullable|string|max:255',
            'summary' => 'nullable|string|max:255',
            'no_urut' => 'nullable|integer',
            'status_sub_menu' => 'nullable|string|max:1',
        ]);

        DcSubMenu::create($validated);

        return redirect()->route('admin.submenu')->with('success', 'Sub Menu berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $submenu = DcSubMenu::findOrFail($id);

        $validated = $request->validate([
            'id_dc_menu' => 'required|integer|exists:dc_menu,id_dc_menu',
            'nama_sub_menu' => 'required|string|max:150',
            'url_sub_menu' => 'nullable|string|max:150',
            'url_sub_menu_baru' => 'nullable|string|max:150',
            'keterangan' => 'nullable|string|max:255',
            'summary' => 'nullable|string|max:255',
            'no_urut' => 'nullable|integer',
            'status_sub_menu' => 'nullable|string|max:1',
        ]);

        $submenu->update($validated);

        return redirect()->route('admin.submenu')->with('success', 'Sub Menu berhasil diupdate.');
    }

    public function destroy($id)
    {
        $submenu = DcSubMenu::findOrFail($id);
        $submenu->delete();

        return redirect()->route('admin.submenu')->with('success', 'Sub Menu berhasil dihapus.');
    }

    public function sort(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|integer',
            'items.*.no_urut' => 'required|integer',
        ]);

        foreach ($validated['items'] as $item) {
            DcSubMenu::where('id_dc_sub_menu', $item['id'])->update(['no_urut' => $item['no_urut']]);
        }

        return redirect()->route('admin.submenu')->with('success', 'Urutan berhasil disimpan.');
    }
}
