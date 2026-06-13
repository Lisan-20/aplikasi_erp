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
        DB::statement("CREATE VIEW dbo.upd_tarif_lagi_v
AS
SELECT     dbo.['Tarif BPJS$'].nama_tindakan, dbo.['Tarif BPJS$'].dr, dbo.['Tarif BPJS$'].rs, dbo.['Tarif BPJS$'].total, dbo.mt_master_tarif_detail.kode_tarif, 
                      dbo.mt_master_tarif_detail.total_bpjs, dbo.mt_master_tarif_detail.bill_rs_bpjs, dbo.mt_master_tarif_detail.bill_dr1_bpjs
FROM         dbo.['Tarif BPJS$'] INNER JOIN
                      dbo.mt_master_tarif_detail ON dbo.['Tarif BPJS$'].kode_tarif = dbo.mt_master_tarif_detail.kode_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_tarif_lagi_v]");
    }
};
