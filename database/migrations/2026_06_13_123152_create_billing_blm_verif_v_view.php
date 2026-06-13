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
        DB::statement("CREATE OR ALTER VIEW dbo.billing_blm_verif_v
AS
SELECT     TOP (100) PERCENT MONTH(dbo.tc_trans_kasir.tgl_jam) AS bln, YEAR(dbo.tc_trans_kasir.tgl_jam) AS thn, SUM(dbo.tc_trans_kasir.nk_perusahaan) AS ttl_tagih, 
                      dbo.tc_registrasi.kode_kelompok, CASE WHEN dbo.tc_trans_kasir.kode_perusahaan IS NULL 
                      THEN 0 ELSE dbo.tc_trans_kasir.kode_perusahaan END AS kode_perusahaan, dbo.mt_perusahaan.flag_jpk, dbo.mt_perusahaan.flag_kapitasi
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_kasir.no_registrasi = dbo.tc_registrasi.no_registrasi LEFT OUTER JOIN
                      dbo.mt_perusahaan ON dbo.tc_trans_kasir.kode_perusahaan = dbo.mt_perusahaan.kode_perusahaan
WHERE     (dbo.tc_trans_kasir.kd_inv_persh_tx IS NULL OR
                      dbo.tc_trans_kasir.kd_inv_persh_tx = 0) AND (dbo.tc_trans_kasir.status_batal IS NULL) AND (dbo.tc_trans_kasir.flag_tagih IS NULL OR
                      dbo.tc_trans_kasir.flag_tagih = 0)
GROUP BY dbo.tc_registrasi.kode_kelompok, MONTH(dbo.tc_trans_kasir.tgl_jam), YEAR(dbo.tc_trans_kasir.tgl_jam), CASE WHEN dbo.tc_trans_kasir.kode_perusahaan IS NULL 
                      THEN 0 ELSE dbo.tc_trans_kasir.kode_perusahaan END, dbo.mt_perusahaan.flag_jpk, dbo.mt_perusahaan.flag_kapitasi
HAVING      (SUM(dbo.tc_trans_kasir.nk_perusahaan) > 0)
ORDER BY bln
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [billing_blm_verif_v]");
    }
};
