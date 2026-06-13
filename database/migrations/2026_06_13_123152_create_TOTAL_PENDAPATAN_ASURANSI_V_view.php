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
        DB::statement("CREATE VIEW dbo.TOTAL_PENDAPATAN_ASURANSI_V
AS
SELECT     MONTH(dbo.tc_trans_kasir.tgl_jam) AS bulan, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) 
                      * (CASE WHEN dbo.tc_trans_pelayanan.bill_rs_jatah IS NULL THEN 0 ELSE dbo.tc_trans_pelayanan.bill_rs_jatah END)) AS bill_rs, 
                      SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * (CASE WHEN dbo.tc_trans_pelayanan.bill_dr1_jatah IS NULL 
                      THEN 0 ELSE dbo.tc_trans_pelayanan.bill_dr1_jatah END)) AS bill_dr1, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) 
                      * (CASE WHEN dbo.tc_trans_pelayanan.bill_dr2_jatah IS NULL THEN 0 ELSE dbo.tc_trans_pelayanan.bill_dr2_jatah END)) AS bill_dr2, 
                      SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * dbo.tc_trans_pelayanan.lain_lain) AS LAIN_LAIN, SUM((CASE WHEN status_kredit = 1 THEN (- 1) 
                      ELSE 1 END) * (CASE WHEN dbo.tc_trans_pelayanan.diskon_rs IS NULL THEN 0 ELSE dbo.tc_trans_pelayanan.diskon_rs END)) AS diskon_rs, 
                      SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * (CASE WHEN dbo.tc_trans_pelayanan.diskon_dr1 IS NULL 
                      THEN 0 ELSE dbo.tc_trans_pelayanan.diskon_dr1 END)) AS diskon_dr1, SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) 
                      * (CASE WHEN dbo.tc_trans_pelayanan.diskon_dr2 IS NULL THEN 0 ELSE dbo.tc_trans_pelayanan.diskon_dr2 END)) AS diskon_dr2, 
                      dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.tunai, dbo.tc_trans_kasir.debet, 
                      dbo.tc_trans_kasir.kredit, dbo.tc_trans_kasir.nd, dbo.tc_trans_kasir.nk, dbo.tc_trans_kasir.nk_perusahaan
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.tc_trans_pelayanan.kode_tc_trans_kasir
WHERE     (dbo.tc_trans_pelayanan.kode_kelompok = 3) AND (MONTH(dbo.tc_trans_kasir.tgl_jam) = 9) AND (dbo.tc_trans_pelayanan.status_batal IS NULL)
GROUP BY dbo.tc_trans_kasir.kode_tc_trans_kasir, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.tunai, dbo.tc_trans_kasir.debet, 
                      dbo.tc_trans_kasir.kredit, dbo.tc_trans_kasir.nd, dbo.tc_trans_kasir.nk, dbo.tc_trans_kasir.nk_perusahaan, MONTH(dbo.tc_trans_kasir.tgl_jam)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [TOTAL_PENDAPATAN_ASURANSI_V]");
    }
};
