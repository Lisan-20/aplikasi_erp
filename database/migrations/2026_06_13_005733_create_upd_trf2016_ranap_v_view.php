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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_trf2016_ranap_v
AS
SELECT     dbo.upd_trf2016_ranap.kode_tarif, dbo.upd_trf2016_ranap.nama_tindakan, dbo.upd_trf2016_ranap.total, dbo.upd_trf2016_ranap.bill_rs, dbo.upd_trf2016_ranap.bill_dr, dbo.upd_trf2016_ranap.klas, 
                      dbo.mt_master_tarif_detail.bill_rs AS bill_rs_upd, dbo.mt_master_tarif_detail.bill_dr1, dbo.mt_master_tarif_detail.total AS total_upd, dbo.mt_master_tarif_detail.kode_klas
FROM         dbo.mt_master_tarif_detail INNER JOIN
                      dbo.upd_trf2016_ranap ON dbo.mt_master_tarif_detail.kode_tarif = dbo.upd_trf2016_ranap.kode_tarif
WHERE     (dbo.upd_trf2016_ranap.klas = 4) AND (dbo.mt_master_tarif_detail.kode_klas = 4)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_trf2016_ranap_v]");
    }
};
