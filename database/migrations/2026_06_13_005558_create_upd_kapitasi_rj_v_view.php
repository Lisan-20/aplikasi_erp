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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_kapitasi_rj_v
AS
SELECT     dbo.['Rawat Jalan$'].kode_tarif, dbo.['Rawat Jalan$'].nama_tindakan, dbo.['Rawat Jalan$'].total, dbo.['Rawat Jalan$'].bill_rs, dbo.['Rawat Jalan$'].bill_dr, 
                      dbo.['Rawat Jalan$'].klas, dbo.mt_master_tarif_detail.bill_rs_kapitasi, dbo.mt_master_tarif_detail.bill_dr1_kapitasi, dbo.mt_master_tarif_detail.bill_dr2_kapitasi, 
                      dbo.mt_master_tarif_detail.total_kapitasi
FROM         dbo.['Rawat Jalan$'] INNER JOIN
                      dbo.mt_master_tarif_detail ON dbo.['Rawat Jalan$'].kode_tarif = dbo.mt_master_tarif_detail.kode_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_kapitasi_rj_v]");
    }
};
