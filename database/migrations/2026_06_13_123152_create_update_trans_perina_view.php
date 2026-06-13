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
        DB::statement("CREATE OR ALTER VIEW dbo.update_trans_perina
AS
SELECT     dbo.mt_master_tarif_detail.kode_klas, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.nama_tindakan, 
                      dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.bill_dr1, dbo.tc_trans_pelayanan.bill_rs_jatah, dbo.tc_trans_pelayanan.bill_dr1_jatah, 
                      dbo.tc_trans_pelayanan.kode_kelompok, dbo.mt_master_tarif_detail.bill_dr1_ass, dbo.mt_master_tarif_detail.bill_rs AS bill_rs_mt, 
                      dbo.mt_master_tarif_detail.bill_dr1 AS bill_dr1_mt, dbo.mt_master_tarif_detail.bill_rs_ass
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_master_tarif_detail ON dbo.tc_trans_pelayanan.kode_tarif = dbo.mt_master_tarif_detail.kode_tarif
WHERE     (dbo.mt_master_tarif_detail.kode_klas = 7) AND (dbo.tc_trans_pelayanan.no_registrasi IN (13899, 14005, 14125, 14148, 14150, 14152))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_trans_perina]");
    }
};
