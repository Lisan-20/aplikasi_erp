<?php

namespace App\Http\Controllers\Manajemen;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use App\Models\Pengadaan\TcErpPo;

class AccPurchasingController extends Controller
{
    public function index(Request $request)
    {
        $query = TcErpPo::query()->with('supplier')->orderBy('tgl_po', 'desc');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('no_po', 'like', "%{$search}%")
                  ->orWhereHas('supplier', function ($sq) use ($search) {
                      $sq->where('nama_supplier', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->has('status') && $request->status != '') {
            if ($request->status == 'belum') {
                $query->where('status', 0); // Draft/Menunggu ACC
            } elseif ($request->status == 'sudah') {
                $query->whereIn('status', [1, 2, 3, 4]); // ACC / Selesai / Batal
            }
        } else {
            // Default show only pending ACC
            $query->where('status', 0);
        }

        $pos = $query->paginate(20)->withQueryString();

        // Eager load details first
        $pos->getCollection()->transform(function ($po) {
            $po->load('details');
            return $po;
        });

        // Collect all item codes and fetch names
        $allKodeBrg = [];
        foreach ($pos->items() as $po) {
            $allKodeBrg = array_merge($allKodeBrg, $po->details->pluck('kode_brg')->toArray());
        }
        
        $barangs = [];
        if (count($allKodeBrg) > 0) {
            $barangs = \Illuminate\Support\Facades\DB::table('mt_barang_jasa')
                ->whereIn('kode_brg', array_unique($allKodeBrg))
                ->pluck('nama_brg', 'kode_brg');
        }

        $pos->getCollection()->transform(function ($po) use ($barangs) {
            $po->jml_brg = $po->details->count();
            foreach ($po->details as $det) {
                $det->nama_brg = isset($barangs[$det->kode_brg]) ? $barangs[$det->kode_brg] : $det->kode_brg;
            }
            return $po;
        });

        return Inertia::render('Manajemen/AccPurchasing/Index', [
            'pos' => $pos,
            'filters' => $request->only(['search', 'status']),
        ]);
    }

    public function approve(Request $request, $id)
    {
        $po = TcErpPo::find($id);
        if (! $po) {
            return back()->withErrors(['error' => 'Purchase Order tidak ditemukan.']);
        }

        if ($po->status != 0) {
            return back()->withErrors(['error' => 'Purchase Order ini tidak dalam status Menunggu ACC.']);
        }

        try {
            DB::beginTransaction();

            $po->status = 1; // ACC / Menunggu Penerimaan
            $po->tgl_acc = Carbon::now();
            $po->acc_by = auth()->id() ?? 1;
            $po->save();

            DB::commit();

            return redirect()->back()->with('success', 'Purchase Order berhasil disetujui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan sistem: ' . $e->getMessage()]);
        }
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'alasan' => 'required|string|max:255'
        ]);

        $po = TcErpPo::findOrFail($id);

        if ($po->status != 0) {
            return back()->withErrors(['error' => 'Purchase Order ini tidak dalam status Menunggu ACC.']);
        }

        try {
            DB::beginTransaction();

            $po->status = 2; // Revisi
            $po->keterangan_revisi = $request->alasan;
            $po->save();

            DB::commit();

            return redirect()->back()->with('success', 'Purchase Order dikembalikan ke bagian pengadaan untuk direvisi.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan sistem: ' . $e->getMessage()]);
        }
    }
}
