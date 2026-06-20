<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('user_karyawan_v');

        $tipeCari = $request->input('tipeCari');
        $filter = $request->input('filter');

        if ($filter) {
            if ($tipeCari === 'nama') {
                $query->where('nama_pegawai', 'LIKE', "%{$filter}%");
            } elseif ($tipeCari === 'nama_group') {
                $query->where('nama_group', 'LIKE', "%{$filter}%");
            } elseif ($tipeCari === 'id') {
                $query->where('username', 'LIKE', "%{$filter}%");
            }
        }

        $users = $query->orderBy('username', 'asc')->paginate(20)->withQueryString();

        $groups = DB::table('dd_user_group')
                    ->select('id_dd_user_group', 'nama_group')
                    ->orderBy('nama_group', 'asc')
                    ->get();

        return Inertia::render('Admin/User/Index', [
            'users' => $users,
            'groups' => $groups,
            'filters' => [
                'tipeCari' => $tipeCari,
                'filter' => $filter
            ]
        ]);
    }

    public function searchPegawai(Request $request)
    {
        $search = $request->input('q');

        $query = DB::table('mt_karyawan')
            ->join('mt_bagian', 'mt_karyawan.kode_bagian', '=', 'mt_bagian.kode_bagian')
            ->select('mt_karyawan.no_induk', 'mt_karyawan.nama_pegawai', 'mt_bagian.nama_bagian');
            // Menghapus 'status_aktif' jika tidak ada di tabel, karena legacy script tidak melakukan filter status_aktif.

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('mt_karyawan.nama_pegawai', 'LIKE', "%{$search}%")
                  ->orWhere('mt_karyawan.no_induk', 'LIKE', "%{$search}%");
            });
        }

        $pegawai = $query->take(50)->get();

        return response()->json($pegawai);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:100',
            'password' => 'required|string',
            'no_induk' => 'required|string',
            'id_dd_user_group' => 'required|numeric',
            'status' => 'required|numeric', // 0 = aktif, 1 = tidak aktif di legacy
        ]);

        DB::beginTransaction();
        try {
            DB::table('dd_user')->insert([
                'username' => $validated['username'],
                'password' => md5($validated['password']), // Sesuai kesepakatan legacy compat
                'no_induk' => $validated['no_induk'],
                'npp'      => $validated['no_induk'],
                'id_dd_user_group' => $validated['id_dd_user_group'],
                'status' => $validated['status'],
                'ko_wil' => '101',
                'input_id' => session('user_id') ?? 0,
                'input_tgl' => date('Y-m-d')
            ]);
            DB::commit();
            return redirect()->back()->with('success', 'User berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => 'Gagal menyimpan data: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:100',
            'id_dd_user_group' => 'required|numeric',
            'status' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {
            $updateData = [
                'username' => $validated['username'],
                'id_dd_user_group' => $validated['id_dd_user_group'],
                'status' => $validated['status'],
            ];

            if ($request->filled('password')) {
                $updateData['password'] = md5($request->input('password'));
            }

            DB::table('dd_user')->where('id_dd_user', $id)->update($updateData);
            
            DB::commit();
            return redirect()->back()->with('success', 'User berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => 'Gagal memperbarui data: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            DB::table('dd_user')->where('id_dd_user', $id)->delete();
            DB::commit();
            return redirect()->back()->with('success', 'User berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus data: ' . $e->getMessage()]);
        }
    }
}
