<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("CREATE OR ALTER VIEW dbo.v_biaya_apotik_ri
AS
SELECT     TOP (100) PERCENT no_kunjungan, no_registrasi, no_mr, nama_pasien_layan, kode_kelompok, kode_perusahaan, tgl_transaksi, jenis_tindakan, 
                      nama_tindakan, SUM(CASE WHEN bill_rs IS NULL THEN 0 ELSE bill_rs END) AS bill_rs, SUM(CASE WHEN bill_rs_jatah IS NULL 
                      THEN 0 ELSE bill_rs_jatah END) AS bill_rs_jatah, SUM(CASE WHEN lain_lain IS NULL THEN 0 ELSE lain_lain END) AS lain_lain, SUM(jumlah) 
                      AS jumlah, kode_barang, kd_tr_resep, kode_trans_far, kode_bagian, kode_bagian_asal, kode_profit, status_kredit, status_selesai, 
                      kode_tc_trans_kasir
FROM         dbo.tc_trans_pelayanan
GROUP BY no_kunjungan, no_registrasi, no_mr, nama_pasien_layan, kode_kelompok, kode_perusahaan, tgl_transaksi, jenis_tindakan, nama_tindakan, 
                      kode_barang, kd_tr_resep, kode_trans_far, kode_bagian, kode_bagian_asal, kode_profit, status_kredit, status_selesai, kode_tc_trans_kasir
HAVING      (kode_bagian LIKE '06%') AND (jenis_tindakan = 11) AND (status_kredit = 0)
ORDER BY tgl_transaksi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_biaya_apotik_ri]");
    }
};
