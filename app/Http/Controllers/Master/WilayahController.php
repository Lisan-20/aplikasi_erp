<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Master\MtErpNegara;
use App\Models\Master\MtErpProvinsi;
use App\Models\Master\MtErpKota;
use App\Models\Master\MtErpKecamatan;
use App\Models\Master\MtErpKelurahan;

class WilayahController extends Controller
{
    public function index()
    {
        // For the first pane, we just need the countries list (which is usually just 1).
        $negaras = MtErpNegara::where('is_active', true)->get();
        return Inertia::render('Master/Wilayah/Index', [
            'negaras' => $negaras
        ]);
    }

    public function getProvinsi(Request $request)
    {
        $query = MtErpProvinsi::query();
        
        if ($request->filled('negara_id')) {
            $query->where('negara_id', $request->negara_id);
        }
        if ($request->filled('search')) {
            $query->where('nama_provinsi', 'like', '%' . $request->search . '%');
        }

        $perPage = min($request->get('per_page', 20), 1000);
        return response()->json(
            $query->orderBy('nama_provinsi')->paginate($perPage)
        );
    }

    public function getKota(Request $request)
    {
        $query = MtErpKota::query();
        
        if ($request->filled('provinsi_id')) {
            $query->where('provinsi_id', $request->provinsi_id);
        }
        if ($request->filled('search')) {
            $query->where('nama_kota', 'like', '%' . $request->search . '%');
        }

        $perPage = min($request->get('per_page', 20), 1000);
        return response()->json(
            $query->orderBy('nama_kota')->paginate($perPage)
        );
    }

    public function getKecamatan(Request $request)
    {
        $query = MtErpKecamatan::query();
        
        if ($request->filled('kota_id')) {
            $query->where('kota_id', $request->kota_id);
        }
        if ($request->filled('search')) {
            $query->where('nama_kecamatan', 'like', '%' . $request->search . '%');
        }

        $perPage = min($request->get('per_page', 20), 1000);
        return response()->json(
            $query->orderBy('nama_kecamatan')->paginate($perPage)
        );
    }

    public function getKelurahan(Request $request)
    {
        $query = MtErpKelurahan::query();
        
        if ($request->filled('kecamatan_id')) {
            $query->where('kecamatan_id', $request->kecamatan_id);
        }
        if ($request->filled('search')) {
            $query->where('nama_kelurahan', 'like', '%' . $request->search . '%');
        }

        $perPage = min($request->get('per_page', 20), 1000);
        return response()->json(
            $query->orderBy('nama_kelurahan')->paginate($perPage)
        );
    }

    // --- PROVINSI CRUD ---
    public function storeProvinsi(Request $request)
    {
        $request->validate(['negara_id' => 'required', 'kode_provinsi' => 'required', 'nama_provinsi' => 'required']);
        $provinsi = MtErpProvinsi::create($request->all());
        return response()->json(['message' => 'Provinsi berhasil ditambahkan', 'data' => $provinsi]);
    }
    public function updateProvinsi(Request $request, $id)
    {
        $request->validate(['kode_provinsi' => 'required', 'nama_provinsi' => 'required']);
        $provinsi = MtErpProvinsi::findOrFail($id);
        $provinsi->update($request->all());
        return response()->json(['message' => 'Provinsi berhasil diubah', 'data' => $provinsi]);
    }
    public function destroyProvinsi($id)
    {
        try {
            MtErpProvinsi::findOrFail($id)->delete();
            return response()->json(['message' => 'Provinsi berhasil dihapus']);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['message' => 'Gagal menghapus! Data masih digunakan oleh jenjang di bawahnya.'], 400);
        }
    }

    // --- KOTA CRUD ---
    public function storeKota(Request $request)
    {
        $request->validate(['provinsi_id' => 'required', 'kode_kota' => 'required', 'nama_kota' => 'required']);
        $kota = MtErpKota::create($request->all());
        return response()->json(['message' => 'Kota berhasil ditambahkan', 'data' => $kota]);
    }
    public function updateKota(Request $request, $id)
    {
        $request->validate(['kode_kota' => 'required', 'nama_kota' => 'required']);
        $kota = MtErpKota::findOrFail($id);
        $kota->update($request->all());
        return response()->json(['message' => 'Kota berhasil diubah', 'data' => $kota]);
    }
    public function destroyKota($id)
    {
        try {
            MtErpKota::findOrFail($id)->delete();
            return response()->json(['message' => 'Kota berhasil dihapus']);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['message' => 'Gagal menghapus! Data masih digunakan oleh jenjang di bawahnya.'], 400);
        }
    }

    // --- KECAMATAN CRUD ---
    public function storeKecamatan(Request $request)
    {
        $request->validate(['kota_id' => 'required', 'kode_kecamatan' => 'required', 'nama_kecamatan' => 'required']);
        $kec = MtErpKecamatan::create($request->all());
        return response()->json(['message' => 'Kecamatan berhasil ditambahkan', 'data' => $kec]);
    }
    public function updateKecamatan(Request $request, $id)
    {
        $request->validate(['kode_kecamatan' => 'required', 'nama_kecamatan' => 'required']);
        $kec = MtErpKecamatan::findOrFail($id);
        $kec->update($request->all());
        return response()->json(['message' => 'Kecamatan berhasil diubah', 'data' => $kec]);
    }
    public function destroyKecamatan($id)
    {
        try {
            MtErpKecamatan::findOrFail($id)->delete();
            return response()->json(['message' => 'Kecamatan berhasil dihapus']);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['message' => 'Gagal menghapus! Data masih digunakan oleh jenjang di bawahnya.'], 400);
        }
    }

    // --- KELURAHAN CRUD ---
    public function storeKelurahan(Request $request)
    {
        $request->validate(['kecamatan_id' => 'required', 'kode_kelurahan' => 'required', 'nama_kelurahan' => 'required']);
        $kel = MtErpKelurahan::create($request->all());
        return response()->json(['message' => 'Kelurahan berhasil ditambahkan', 'data' => $kel]);
    }
    public function updateKelurahan(Request $request, $id)
    {
        $request->validate(['kode_kelurahan' => 'required', 'nama_kelurahan' => 'required']);
        $kel = MtErpKelurahan::findOrFail($id);
        $kel->update($request->all());
        return response()->json(['message' => 'Kelurahan berhasil diubah', 'data' => $kel]);
    }
    public function destroyKelurahan($id)
    {
        try {
            MtErpKelurahan::findOrFail($id)->delete();
            return response()->json(['message' => 'Kelurahan berhasil dihapus']);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['message' => 'Gagal menghapus! Data masih digunakan oleh jenjang di bawahnya.'], 400);
        }
    }
}
