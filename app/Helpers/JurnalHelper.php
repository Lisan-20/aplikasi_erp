<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class JurnalHelper
{
    /**
     * Membuat Jurnal Otomatis terintegrasi dari berbagai modul
     * 
     * @param string $referensi (Nomor Faktur, No Transaksi, dll)
     * @param string $tgl_jurnal (Format Y-m-d)
     * @param string $keterangan
     * @param array $details (Array of array: ['kode_akun' => '1111', 'posisi' => 'debit'/'kredit', 'nominal' => 1000, 'keterangan' => '...'])
     * @return int id_jurnal_header
     * @throws \Exception
     */
    public static function buatJurnalOtomatis($referensi, $tgl_jurnal, $keterangan, $details)
    {
        // Abaikan jika detail kosong
        if (empty($details)) {
            return null;
        }

        // Generate No Jurnal
        $prefix = "JUR-" . date('Ymd', strtotime($tgl_jurnal)) . "-";
        $lastJurnal = DB::table('tc_erp_jurnal_header')
            ->where('no_jurnal', 'like', $prefix . '%')
            ->orderBy('no_jurnal', 'desc')
            ->first();

        $urut = 1;
        if ($lastJurnal) {
            $lastNo = str_replace($prefix, '', $lastJurnal->no_jurnal);
            $urut = (int) $lastNo + 1;
        }
        $no_jurnal = $prefix . str_pad($urut, 4, '0', STR_PAD_LEFT);

        // Hitung Total Debit & Kredit
        $total_debit = 0;
        $total_kredit = 0;

        foreach ($details as $d) {
            if ($d['posisi'] === 'debit') {
                $total_debit += (float) $d['nominal'];
            } else if ($d['posisi'] === 'kredit') {
                $total_kredit += (float) $d['nominal'];
            }
        }

        // Insert Header
        $id_header = DB::table('tc_erp_jurnal_header')->insertGetId([
            'no_jurnal' => $no_jurnal,
            'tgl_jurnal' => $tgl_jurnal,
            'keterangan' => $keterangan,
            'referensi' => $referensi,
            'total_debit' => $total_debit,
            'total_kredit' => $total_kredit,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert Details
        foreach ($details as $d) {
            $coa = DB::table('mt_erp_coa')->where('kode_akun', $d['kode_akun'])->first();
            if (!$coa) {
                throw new \Exception("Akun COA dengan kode {$d['kode_akun']} tidak ditemukan di Master COA!");
            }

            DB::table('tc_erp_jurnal_detail')->insert([
                'id_jurnal_header' => $id_header,
                'id_coa' => $coa->id,
                'debit' => ($d['posisi'] === 'debit') ? (float) $d['nominal'] : 0,
                'kredit' => ($d['posisi'] === 'kredit') ? (float) $d['nominal'] : 0,
                'keterangan_detail' => $d['keterangan'] ?? null,
            ]);
        }

        return $id_header;
    }
}
