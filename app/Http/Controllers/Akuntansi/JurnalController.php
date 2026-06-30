<?php

namespace App\Http\Controllers\Akuntansi;

use App\Http\Controllers\Controller;
use App\Models\JurnalHeader;
use App\Models\JurnalDetail;
use App\Models\Coa;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class JurnalController extends Controller
{
    public function index(Request $request)
    {
        $query = JurnalHeader::with(['details.coa', 'user']);

        if ($request->has('search') && $request->search != '') {
            $query->where('no_jurnal', 'like', '%' . $request->search . '%')
                  ->orWhere('keterangan', 'like', '%' . $request->search . '%');
        }

        $jurnals = $query->orderBy('tgl_jurnal', 'desc')->orderBy('created_at', 'desc')->paginate(20)->withQueryString();

        return Inertia::render('Akuntansi/Jurnal/Index', [
            'jurnals' => $jurnals,
            'filters' => $request->only(['search'])
        ]);
    }

    public function create()
    {
        $coas = Coa::where('is_active', 1)->orderBy('kode_akun')->get();
        return Inertia::render('Akuntansi/Jurnal/Form', [
            'coas' => $coas
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_jurnal' => 'required|string|unique:tc_erp_jurnal_header,no_jurnal',
            'tgl_jurnal' => 'required|date',
            'keterangan' => 'required|string|max:255',
            'referensi' => 'nullable|string|max:100',
            'details' => 'required|array|min:2',
            'details.*.id_coa' => 'required|exists:mt_erp_coa,id',
            'details.*.debit' => 'required|numeric|min:0',
            'details.*.kredit' => 'required|numeric|min:0',
        ]);

        // Validasi Balance
        $totalDebit = collect($request->details)->sum('debit');
        $totalKredit = collect($request->details)->sum('kredit');

        if (round($totalDebit, 2) !== round($totalKredit, 2)) {
            return back()->withErrors(['balance' => 'Total Debit dan Kredit tidak seimbang.'])->withInput();
        }

        DB::beginTransaction();
        try {
            $jurnal = JurnalHeader::create([
                'no_jurnal' => $request->no_jurnal,
                'tgl_jurnal' => $request->tgl_jurnal,
                'keterangan' => $request->keterangan,
                'referensi' => $request->referensi,
                'total_debit' => $totalDebit,
                'total_kredit' => $totalKredit,
                'id_dd_user' => auth()->id() ?? 1, // fallback
            ]);

            foreach ($request->details as $detail) {
                JurnalDetail::create([
                    'id_jurnal_header' => $jurnal->id,
                    'id_coa' => $detail['id_coa'],
                    'debit' => $detail['debit'],
                    'kredit' => $detail['kredit'],
                    'keterangan_detail' => $detail['keterangan_detail'] ?? null,
                ]);
            }

            DB::commit();
            return redirect()->route('akuntansi.jurnal')->with('success', 'Jurnal berhasil disimpan.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    public function edit($id)
    {
        $jurnal = JurnalHeader::with('details')->findOrFail($id);
        $coas = Coa::where('is_active', 1)->orderBy('kode_akun')->get();

        return Inertia::render('Akuntansi/Jurnal/Form', [
            'jurnal' => $jurnal,
            'coas' => $coas
        ]);
    }

    public function update(Request $request, $id)
    {
        $jurnal = JurnalHeader::findOrFail($id);
        
        $request->validate([
            'no_jurnal' => 'required|string|unique:tc_erp_jurnal_header,no_jurnal,' . $id,
            'tgl_jurnal' => 'required|date',
            'keterangan' => 'required|string|max:255',
            'referensi' => 'nullable|string|max:100',
            'details' => 'required|array|min:2',
            'details.*.id_coa' => 'required|exists:mt_erp_coa,id',
            'details.*.debit' => 'required|numeric|min:0',
            'details.*.kredit' => 'required|numeric|min:0',
        ]);

        $totalDebit = collect($request->details)->sum('debit');
        $totalKredit = collect($request->details)->sum('kredit');

        if (round($totalDebit, 2) !== round($totalKredit, 2)) {
            return back()->withErrors(['balance' => 'Total Debit dan Kredit tidak seimbang.'])->withInput();
        }

        DB::beginTransaction();
        try {
            $jurnal->update([
                'no_jurnal' => $request->no_jurnal,
                'tgl_jurnal' => $request->tgl_jurnal,
                'keterangan' => $request->keterangan,
                'referensi' => $request->referensi,
                'total_debit' => $totalDebit,
                'total_kredit' => $totalKredit,
            ]);

            // Hapus detail lama, insert yang baru
            $jurnal->details()->delete();

            foreach ($request->details as $detail) {
                JurnalDetail::create([
                    'id_jurnal_header' => $jurnal->id,
                    'id_coa' => $detail['id_coa'],
                    'debit' => $detail['debit'],
                    'kredit' => $detail['kredit'],
                    'keterangan_detail' => $detail['keterangan_detail'] ?? null,
                ]);
            }

            DB::commit();
            return redirect()->route('akuntansi.jurnal')->with('success', 'Jurnal berhasil diperbarui.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy($id)
    {
        $jurnal = JurnalHeader::findOrFail($id);
        $jurnal->delete();
        return redirect()->route('akuntansi.jurnal')->with('success', 'Jurnal berhasil dihapus.');
    }
}

