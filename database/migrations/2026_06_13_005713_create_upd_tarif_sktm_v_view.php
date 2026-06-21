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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_tarif_sktm_v
AS
SELECT     TOP (100) PERCENT dbo.mt_master_tarif.kode_tarif, dbo.mt_master_tarif.nama_tarif, dbo.mt_master_tarif_detail_sktm.kode_klas, 
                      dbo.mt_master_tarif_detail_sktm.bill_rs, dbo.mt_master_tarif_detail_sktm.bill_dr1, dbo.mt_master_tarif_detail_sktm.bill_dr2, 
                      dbo.mt_master_tarif_detail_sktm.kode_tgl_tarif, dbo.mt_master_tarif_detail_sktm.total, dbo.mt_master_tarif_detail_sktm.bhp
FROM         dbo.mt_master_tarif INNER JOIN
                      dbo.mt_master_tarif_detail_sktm ON dbo.mt_master_tarif.kode_tarif = dbo.mt_master_tarif_detail_sktm.kode_tarif
WHERE     (dbo.mt_master_tarif.tingkatan = 5) AND (dbo.mt_master_tarif_detail_sktm.bill_rs + dbo.mt_master_tarif_detail_sktm.bill_dr1 <> dbo.mt_master_tarif_detail_sktm.total)
ORDER BY dbo.mt_master_tarif.kode_tarif, dbo.mt_master_tarif_detail_sktm.kode_klas
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_tarif_sktm_v]");
    }
};
