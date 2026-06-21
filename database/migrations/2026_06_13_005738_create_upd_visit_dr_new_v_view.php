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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_visit_dr_new_v
AS
SELECT     TOP (100) PERCENT dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.kode_kelompok, dbo.mt_tarif_v.bill_rs_bpjs, dbo.tc_trans_pelayanan.bill_rs AS rs_lama, 
                      dbo.mt_tarif_v.bill_dr1_bpjs, dbo.tc_trans_pelayanan.bill_dr1 AS dr_lama, dbo.mt_tarif_v.kode_tarif, dbo.mt_tarif_v.kode_klas, dbo.tc_trans_pelayanan.tgl_transaksi, 
                      dbo.tc_trans_pelayanan.flag_dr1
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_tarif_v ON dbo.tc_trans_pelayanan.kode_klas = dbo.mt_tarif_v.kode_klas AND dbo.tc_trans_pelayanan.kode_tarif = dbo.mt_tarif_v.kode_tarif
WHERE     (NOT (dbo.tc_trans_pelayanan.kode_kelompok IN (1, 5, 3))) AND (dbo.tc_trans_pelayanan.nama_tindakan LIKE 'Visite dr. Umum') AND (dbo.tc_trans_pelayanan.flag_dr1 IS NULL) AND 
                      (dbo.tc_trans_pelayanan.tgl_transaksi > CONVERT(DATETIME, '2018-05-25 00:00:00', 102))
ORDER BY dbo.tc_trans_pelayanan.tgl_transaksi DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_visit_dr_new_v]");
    }
};
