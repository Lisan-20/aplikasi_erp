<?php

namespace App\Http\Controllers\Akuntansi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Models\Coa;

class LaporanKeuanganController extends Controller
{
    private function getNormalBalance($kode_akun)
    {
        $prefix = substr($kode_akun, 0, 1);
        // 1 = Asset, 5 = HPP, 6 = Expense, 7 = Other Expense -> Normal Balance Debit
        if (in_array($prefix, ['1', '5', '6', '7'])) {
            return 'D';
        }
        // 2 = Liability, 3 = Equity, 4 = Revenue, 8 = Other Revenue -> Normal Balance Kredit
        return 'K';
    }

    public function bukuBesar(Request $request)
    {
        $coas = Coa::orderBy('kode_akun')->get();
        $id_coa = $request->id_coa;
        $start_date = $request->start_date ?: date('Y-m-01');
        $end_date = $request->end_date ?: date('Y-m-t');

        $saldo_awal = 0;
        $transaksi = [];
        $selected_coa = null;

        if ($id_coa) {
            $selected_coa = Coa::find($id_coa);
            if ($selected_coa) {
                $normal_balance = $this->getNormalBalance($selected_coa->kode_akun);

                // Hitung Saldo Awal (sebelum start_date)
                $queryAwal = DB::table('tc_erp_jurnal_detail as d')
                    ->join('tc_erp_jurnal_header as h', 'd.id_jurnal_header', '=', 'h.id')
                    ->where('d.id_coa', $id_coa)
                    ->where('h.tgl_jurnal', '<', $start_date)
                    ->select(DB::raw('SUM(d.debit) as sum_debit, SUM(d.kredit) as sum_kredit'))
                    ->first();

                $sum_debit = (float) ($queryAwal->sum_debit ?? 0);
                $sum_kredit = (float) ($queryAwal->sum_kredit ?? 0);

                if ($normal_balance == 'D') {
                    $saldo_awal = $sum_debit - $sum_kredit;
                } else {
                    $saldo_awal = $sum_kredit - $sum_debit;
                }

                // Ambil Transaksi pada rentang tanggal
                $transaksi = DB::table('tc_erp_jurnal_detail as d')
                    ->join('tc_erp_jurnal_header as h', 'd.id_jurnal_header', '=', 'h.id')
                    ->where('d.id_coa', $id_coa)
                    ->whereBetween('h.tgl_jurnal', [$start_date, $end_date])
                    ->select(
                        'h.tgl_jurnal',
                        'h.no_jurnal',
                        'h.keterangan as keterangan_jurnal',
                        'd.keterangan_detail',
                        'd.debit',
                        'd.kredit'
                    )
                    ->orderBy('h.tgl_jurnal', 'asc')
                    ->orderBy('h.id', 'asc')
                    ->get();
            }
        }

        return Inertia::render('Akuntansi/Laporan/BukuBesar', [
            'coas' => $coas,
            'filters' => [
                'id_coa' => $id_coa,
                'start_date' => $start_date,
                'end_date' => $end_date,
            ],
            'selected_coa' => $selected_coa,
            'saldo_awal' => $saldo_awal,
            'transaksi' => $transaksi
        ]);
    }

    public function neracaSaldo(Request $request)
    {
        $start_date = $request->start_date ?: date('Y-m-01');
        $end_date = $request->end_date ?: date('Y-m-t');

        // Mengambil semua coa dan menghitung total mutasi (debit dan kredit) dalam periode
        $coas = Coa::orderBy('kode_akun')->get();
        
        $mutasi = DB::table('tc_erp_jurnal_detail as d')
            ->join('tc_erp_jurnal_header as h', 'd.id_jurnal_header', '=', 'h.id')
            ->whereBetween('h.tgl_jurnal', [$start_date, $end_date])
            ->select('d.id_coa', DB::raw('SUM(d.debit) as sum_debit'), DB::raw('SUM(d.kredit) as sum_kredit'))
            ->groupBy('d.id_coa')
            ->get()
            ->keyBy('id_coa');

        // Menghitung Saldo Awal per COA untuk mendapatkan saldo akhir
        $awal = DB::table('tc_erp_jurnal_detail as d')
            ->join('tc_erp_jurnal_header as h', 'd.id_jurnal_header', '=', 'h.id')
            ->where('h.tgl_jurnal', '<', $start_date)
            ->select('d.id_coa', DB::raw('SUM(d.debit) as sum_debit'), DB::raw('SUM(d.kredit) as sum_kredit'))
            ->groupBy('d.id_coa')
            ->get()
            ->keyBy('id_coa');

        $laporan = [];
        $total_debit_ns = 0;
        $total_kredit_ns = 0;

        foreach ($coas as $coa) {
            $m_debit = (float) ($mutasi[$coa->id]->sum_debit ?? 0);
            $m_kredit = (float) ($mutasi[$coa->id]->sum_kredit ?? 0);
            
            $a_debit = (float) ($awal[$coa->id]->sum_debit ?? 0);
            $a_kredit = (float) ($awal[$coa->id]->sum_kredit ?? 0);

            $normal_balance = $this->getNormalBalance($coa->kode_akun);
            
            $saldo_akhir = 0;
            if ($normal_balance == 'D') {
                $saldo_akhir = ($a_debit - $a_kredit) + ($m_debit - $m_kredit);
            } else {
                $saldo_akhir = ($a_kredit - $a_debit) + ($m_kredit - $m_debit);
            }

            // Di Neraca Saldo, kita sajikan saldo akhir pada kolom Normal Balance-nya
            $saldo_debit = 0;
            $saldo_kredit = 0;

            if ($saldo_akhir > 0) {
                if ($normal_balance == 'D') {
                    $saldo_debit = $saldo_akhir;
                    $total_debit_ns += $saldo_akhir;
                } else {
                    $saldo_kredit = $saldo_akhir;
                    $total_kredit_ns += $saldo_akhir;
                }
            } else if ($saldo_akhir < 0) {
                // Saldo minus berarti berada di posisi berlawanan
                if ($normal_balance == 'D') {
                    $saldo_kredit = abs($saldo_akhir);
                    $total_kredit_ns += abs($saldo_akhir);
                } else {
                    $saldo_debit = abs($saldo_akhir);
                    $total_debit_ns += abs($saldo_akhir);
                }
            }

            // Hanya tampilkan jika ada mutasi atau saldo akhir
            if ($m_debit > 0 || $m_kredit > 0 || $saldo_akhir != 0) {
                $laporan[] = [
                    'kode_akun' => $coa->kode_akun,
                    'nama_akun' => $coa->nama_akun,
                    'level' => $coa->level,
                    'mutasi_debit' => $m_debit,
                    'mutasi_kredit' => $m_kredit,
                    'saldo_debit' => $saldo_debit,
                    'saldo_kredit' => $saldo_kredit
                ];
            }
        }

        return Inertia::render('Akuntansi/Laporan/NeracaSaldo', [
            'laporan' => $laporan,
            'total_debit_ns' => $total_debit_ns,
            'total_kredit_ns' => $total_kredit_ns,
            'filters' => [
                'start_date' => $start_date,
                'end_date' => $end_date,
            ],
        ]);
    }

    public function labaRugi(Request $request)
    {
        $start_date = $request->start_date ?: date('Y-m-01');
        $end_date = $request->end_date ?: date('Y-m-t');

        $coas = Coa::where('kode_akun', 'like', '4%')
                   ->orWhere('kode_akun', 'like', '5%')
                   ->orWhere('kode_akun', 'like', '6%')
                   ->orWhere('kode_akun', 'like', '7%')
                   ->orderBy('kode_akun')
                   ->get();

        // Hitung total mutasi saja (Pendapatan & Beban selalu di-nol-kan di awal tahun, 
        // tapi untuk ERP sederhana kita ambil total berjalan di rentang tanggal tersebut).
        // Seharusnya (hingga tanggal end_date untuk YTD, tapi ini laporan periode).
        $saldo = DB::table('tc_erp_jurnal_detail as d')
            ->join('tc_erp_jurnal_header as h', 'd.id_jurnal_header', '=', 'h.id')
            ->whereBetween('h.tgl_jurnal', [$start_date, $end_date])
            ->select('d.id_coa', DB::raw('SUM(d.debit) as sum_debit'), DB::raw('SUM(d.kredit) as sum_kredit'))
            ->groupBy('d.id_coa')
            ->get()
            ->keyBy('id_coa');

        $pendapatan = [];
        $hpp = [];
        $beban = [];

        $total_pendapatan = 0;
        $total_hpp = 0;
        $total_beban = 0;

        foreach ($coas as $coa) {
            $debit = (float) ($saldo[$coa->id]->sum_debit ?? 0);
            $kredit = (float) ($saldo[$coa->id]->sum_kredit ?? 0);
            
            if ($debit == 0 && $kredit == 0) continue;

            $normal_balance = $this->getNormalBalance($coa->kode_akun);
            $nilai = ($normal_balance == 'K') ? ($kredit - $debit) : ($debit - $kredit);

            $data = [
                'kode_akun' => $coa->kode_akun,
                'nama_akun' => $coa->nama_akun,
                'nilai' => $nilai
            ];

            $prefix = substr($coa->kode_akun, 0, 1);
            if ($prefix == '4') {
                $pendapatan[] = $data;
                $total_pendapatan += $nilai;
            } else if ($prefix == '5') {
                $hpp[] = $data;
                $total_hpp += $nilai;
            } else if ($prefix == '6' || $prefix == '7') {
                $beban[] = $data;
                $total_beban += $nilai;
            }
        }

        $laba_kotor = $total_pendapatan - $total_hpp;
        $laba_bersih = $laba_kotor - $total_beban;

        return Inertia::render('Akuntansi/Laporan/LabaRugi', [
            'pendapatan' => $pendapatan,
            'hpp' => $hpp,
            'beban' => $beban,
            'total_pendapatan' => $total_pendapatan,
            'total_hpp' => $total_hpp,
            'total_beban' => $total_beban,
            'laba_kotor' => $laba_kotor,
            'laba_bersih' => $laba_bersih,
            'filters' => [
                'start_date' => $start_date,
                'end_date' => $end_date,
            ]
        ]);
    }
}
