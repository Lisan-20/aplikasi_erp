<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class BagianController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('mt_bagian')
            ->select(
                'id_mt_bagian',
                'kode_bagian',
                'nama_bagian',
                'group_bag',
                'status_aktif'
            );

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama_bagian', 'LIKE', '%'.$search.'%')
                  ->orWhere('kode_bagian', 'LIKE', '%'.$search.'%');
        }

        $bagian = $query->orderBy('nama_bagian', 'asc')->paginate(20)->withQueryString();

        return Inertia::render('Master/Bagian/Index', [
            'bagian' => $bagian,
            'filters' => $request->only('search'),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_bagian' => 'required|max:50|unique:mt_bagian,kode_bagian',
            'nama_bagian' => 'required|max:255',
            'group_bag' => 'nullable|max:50',
            'status_aktif' => 'nullable|in:0,1'
        ]);

        try {
            $maxId = DB::table('mt_bagian')->max('id_mt_bagian') ?? 0;
            
            DB::table('mt_bagian')->insert([
                'id_mt_bagian' => $maxId + 1,
                'kode_bagian' => $request->kode_bagian,
                'nama_bagian' => $request->nama_bagian,
                'group_bag' => $request->group_bag ?? 'Detail',
                'status_aktif' => $request->status_aktif ?? 1,
            ]);

            return redirect()->back()->with('success', 'Data Bagian berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan bagian: '.$e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_bagian' => 'required|max:255',
            'group_bag' => 'nullable|max:50',
            'status_aktif' => 'required|in:0,1'
        ]);

        try {
            DB::table('mt_bagian')->where('kode_bagian', $id)->update([
                'nama_bagian' => $request->nama_bagian,
                'group_bag' => $request->group_bag ?? 'Detail',
                'status_aktif' => $request->status_aktif,
            ]);

            return redirect()->back()->with('success', 'Data Bagian berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui bagian: '.$e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            // Soft delete
            DB::table('mt_bagian')->where('kode_bagian', $id)->update(['status_aktif' => 0]);

            return redirect()->back()->with('success', 'Bagian berhasil dinonaktifkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menonaktifkan bagian: '.$e->getMessage());
        }
    }
}
