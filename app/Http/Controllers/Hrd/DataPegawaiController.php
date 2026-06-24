<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\MtKaryawan;
use App\Models\MtBagian;
use Illuminate\Support\Facades\DB;

class DataPegawaiController extends Controller
{
    public function index(Request $request)
    {
        $query = MtKaryawan::with('bagian');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_pegawai', 'like', "%{$search}%")
                  ->orWhere('no_induk', 'like', "%{$search}%")
                  ->orWhere('no_ktp', 'like', "%{$search}%");
            });
        }

        // Default status is active (1) if not provided
        $statusFilter = $request->input('status', '1');
        if ($statusFilter !== 'all') {
            $query->where('status', $statusFilter);
        }

        $karyawan = $query->orderBy('no_induk', 'desc')->paginate(20)->withQueryString();
        $bagian = MtBagian::select('kode_bagian', 'nama_bagian')->orderBy('nama_bagian', 'asc')->get();

        return Inertia::render('Hrd/DataPegawai/Index', [
            'karyawan' => $karyawan,
            'bagian' => $bagian,
            'filters' => $request->only(['search'])
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pegawai' => 'required|string|max:100',
            'kode_bagian' => 'nullable|string|max:50',
            'no_ktp' => 'nullable|string|max:50',
            'tgl_lahir' => 'nullable|date',
            'tmp_lahir' => 'nullable|string|max:100',
            'alamat' => 'nullable|string',
            'tlp' => 'nullable|string|max:50',
            'id_sex' => 'nullable|integer',
            'id_dc_kawin' => 'nullable|integer',
            'npwp' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
            'provinsi' => 'nullable|string|max:100',
            'provinsi_id' => 'nullable|string|max:50',
            'kota' => 'nullable|string|max:100',
            'kota_id' => 'nullable|string|max:50',
            'kecamatan' => 'nullable|string|max:100',
            'kecamatan_id' => 'nullable|string|max:50',
            'kelurahan' => 'nullable|string|max:100',
            'kelurahan_id' => 'nullable|string|max:50',
            'status' => 'required|integer'
        ]);

        try {
            DB::beginTransaction();
            
            $karyawan = new MtKaryawan();
            $karyawan->nama_pegawai = $request->nama_pegawai;
            $karyawan->kode_bagian = $request->kode_bagian;
            $karyawan->no_ktp = $request->no_ktp;
            $karyawan->tgl_lahir = $request->tgl_lahir;
            $karyawan->tmp_lahir = $request->tmp_lahir;
            $karyawan->alamat = $request->alamat;
            $karyawan->tlp = $request->tlp;
            $karyawan->id_sex = $request->id_sex ?? 0;
            $karyawan->id_dc_kawin = $request->id_dc_kawin ?? 0;
            $karyawan->npwp = $request->npwp;
            $karyawan->email = $request->email;
            $karyawan->provinsi = $request->provinsi;
            $karyawan->provinsi_id = $request->provinsi_id;
            $karyawan->kota = $request->kota;
            $karyawan->kota_id = $request->kota_id;
            $karyawan->kecamatan = $request->kecamatan;
            $karyawan->kecamatan_id = $request->kecamatan_id;
            $karyawan->kelurahan = $request->kelurahan;
            $karyawan->kelurahan_id = $request->kelurahan_id;
            $karyawan->status = $request->status;
            
            // Set required defaults for other fields to prevent null constraint errors
            $karyawan->kode_jabatan = 0;
            $karyawan->id_status = 2; // Assuming 2 is active or standard
            $karyawan->tinggi_Badan = 0;
            $karyawan->berat_badan = 0;
            
            $karyawan->save();
            DB::commit();

            return redirect()->back()->with('success', 'Data Pegawai berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menambahkan pegawai: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pegawai' => 'required|string|max:100',
            'kode_bagian' => 'nullable|string|max:50',
            'no_ktp' => 'nullable|string|max:50',
            'tgl_lahir' => 'nullable|date',
            'tmp_lahir' => 'nullable|string|max:100',
            'alamat' => 'nullable|string',
            'tlp' => 'nullable|string|max:50',
            'id_sex' => 'nullable|integer',
            'id_dc_kawin' => 'nullable|integer',
            'npwp' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
            'provinsi' => 'nullable|string|max:100',
            'provinsi_id' => 'nullable|string|max:50',
            'kota' => 'nullable|string|max:100',
            'kota_id' => 'nullable|string|max:50',
            'kecamatan' => 'nullable|string|max:100',
            'kecamatan_id' => 'nullable|string|max:50',
            'kelurahan' => 'nullable|string|max:100',
            'kelurahan_id' => 'nullable|string|max:50',
            'status' => 'required|integer'
        ]);

        try {
            $karyawan = MtKaryawan::findOrFail($id);
            $karyawan->nama_pegawai = $request->nama_pegawai;
            $karyawan->kode_bagian = $request->kode_bagian;
            $karyawan->no_ktp = $request->no_ktp;
            $karyawan->tgl_lahir = $request->tgl_lahir;
            $karyawan->tmp_lahir = $request->tmp_lahir;
            $karyawan->alamat = $request->alamat;
            $karyawan->tlp = $request->tlp;
            $karyawan->id_sex = $request->id_sex ?? 0;
            $karyawan->id_dc_kawin = $request->id_dc_kawin ?? 0;
            $karyawan->npwp = $request->npwp;
            $karyawan->email = $request->email;
            $karyawan->provinsi = $request->provinsi;
            $karyawan->provinsi_id = $request->provinsi_id;
            $karyawan->kota = $request->kota;
            $karyawan->kota_id = $request->kota_id;
            $karyawan->kecamatan = $request->kecamatan;
            $karyawan->kecamatan_id = $request->kecamatan_id;
            $karyawan->kelurahan = $request->kelurahan;
            $karyawan->kelurahan_id = $request->kelurahan_id;
            $karyawan->status = $request->status;
            $karyawan->save();

            return redirect()->back()->with('success', 'Data Pegawai berhasil diubah.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengubah pegawai: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $karyawan = MtKaryawan::findOrFail($id);
            // Soft delete by setting status to 0 (nonaktif) instead of actual delete
            $karyawan->status = 0;
            $karyawan->save();

            return redirect()->back()->with('success', 'Pegawai berhasil dinonaktifkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menonaktifkan pegawai: ' . $e->getMessage());
        }
    }
}
