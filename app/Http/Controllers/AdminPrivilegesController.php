<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class AdminPrivilegesController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter', '');

        $query = DB::table('dd_user_group');
        if ($filter) {
            $query->where('nama_group', 'like', '%'.$filter.'%');
        }

        $groups = $query->paginate(20)->withQueryString();

        return Inertia::render('Admin/Privileges/Index', [
            'groups' => $groups,
            'filters' => ['filter' => $filter],
        ]);
    }

    public function storeGroup(Request $request)
    {
        $request->validate([
            'nama_group' => 'required|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        DB::table('dd_user_group')->insert([
            'nama_group' => $request->nama_group,
            'keterangan' => $request->keterangan,
            'input_id' => Session::get('id_dd_user', 1),
            'input_tgl' => now()->format('Y-m-d H:i:s'),
        ]);

        return redirect()->back()->with('success', 'Group User berhasil ditambahkan.');
    }

    public function updateGroup(Request $request, $id)
    {
        $request->validate([
            'nama_group' => 'required|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        DB::table('dd_user_group')
            ->where('id_dd_user_group', $id)
            ->update([
                'nama_group' => $request->nama_group,
                'keterangan' => $request->keterangan,
            ]);

        return redirect()->back()->with('success', 'Group User berhasil diperbarui.');
    }

    public function destroyGroup($id)
    {
        DB::table('dd_user_group')->where('id_dd_user_group', $id)->delete();

        return redirect()->back()->with('success', 'Group User berhasil dihapus.');
    }

    public function matrix(Request $request)
    {
        $tipeCari = $request->query('tipeCari', '');

        // Dropdown Groups
        $userGroups = DB::table('dd_user_group')->orderBy('nama_group')->get();

        // Column Headers (Access Levels)
        $accessGroups = DB::table('dd_group')->orderBy('nama_group')->get();

        // Current Access Rights mapped by Sub Menu ID
        $hakAksesMenu = [];
        if ($tipeCari) {
            $details = DB::table('dd_user_group_detail')
                ->where('id_dd_user_group', $tipeCari)
                ->get();
            foreach ($details as $d) {
                $hakAksesMenu[$d->id_dc_sub_menu] = $d->hak_akses_menu;
            }
        }

        // Sub Menus structure
        $querySubMenu = DB::table('dc_sub_menu as s')
            ->join('dc_menu as m', 's.id_dc_menu', '=', 'm.id_dc_menu')
            ->join('dc_modul as d', 'm.id_dc_modul', '=', 'd.id_dc_modul');

        if (! $tipeCari) {
            // When no group is selected, force empty result just like legacy did
            $querySubMenu->whereNull('s.id_dc_sub_menu');
        }

        $subMenus = $querySubMenu
            ->select('s.*', 'm.nama_menu', 'm.no_urut as no_urut_menu', 'd.nama_modul', 'd.id_dc_modul')
            ->orderBy('d.nama_modul')
            ->orderBy('m.no_urut')
            ->orderBy('s.no_urut')
            ->get();

        return Inertia::render('Admin/Privileges/Matrix', [
            'userGroups' => $userGroups,
            'accessGroups' => $accessGroups,
            'hakAksesMenu' => (object) $hakAksesMenu,
            'subMenus' => $subMenus,
            'tipeCari' => $tipeCari,
        ]);
    }

    public function updateMatrix(Request $request)
    {
        $id_dd_user_group = $request->input('id_dd_user_group');
        $oid = $request->input('oid', []); // Array of [id_dc_sub_menu => hak_akses_menu]

        if (! $id_dd_user_group) {
            return redirect()->back()->with('error', 'Group User tidak valid.');
        }

        DB::beginTransaction();
        try {
            foreach ($oid as $sub_menu_id => $hak_akses) {
                $cek = DB::table('dd_user_group_detail')
                    ->where('id_dc_sub_menu', $sub_menu_id)
                    ->where('id_dd_user_group', $id_dd_user_group)
                    ->first();

                if ($hak_akses === 'no_access') {
                    if ($cek) {
                        DB::table('dd_user_group_detail')
                            ->where('id_dc_sub_menu', $sub_menu_id)
                            ->where('id_dd_user_group', $id_dd_user_group)
                            ->delete();
                    }
                } else {
                    if ($cek) {
                        DB::table('dd_user_group_detail')
                            ->where('id_dc_sub_menu', $sub_menu_id)
                            ->where('id_dd_user_group', $id_dd_user_group)
                            ->update(['hak_akses_menu' => $hak_akses]);
                    } else {
                        DB::table('dd_user_group_detail')->insert([
                            'id_dd_user_group' => $id_dd_user_group,
                            'id_dc_sub_menu' => $sub_menu_id,
                            'hak_akses_menu' => $hak_akses,
                        ]);
                    }
                }
            }
            DB::commit();

            return redirect()->back()->with('success', 'Hak Akses berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Gagal memperbarui hak akses: '.$e->getMessage());
        }
    }
}
