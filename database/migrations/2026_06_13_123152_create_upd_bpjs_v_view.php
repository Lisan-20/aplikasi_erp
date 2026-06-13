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
        DB::statement("CREATE VIEW dbo.upd_bpjs_v
AS
SELECT     dbo.['Tarif BPJS$'].kode_tarif, dbo.['Tarif BPJS$'].nama_tindakan, dbo.['Tarif BPJS$'].kode_kls, dbo.mt_master_tarif_detail.bill_rs_bpjs, 
                      dbo.mt_master_tarif_detail.bill_dr1_bpjs, dbo.mt_master_tarif_detail.bill_dr2_bpjs, dbo.['Tarif BPJS$'].total, 
                      dbo.mt_master_tarif_detail.bill_rs_pt + dbo.mt_master_tarif_detail.bill_dr1_pt AS total_real, dbo.['Tarif BPJS$'].dr
FROM         dbo.mt_master_tarif_detail INNER JOIN
                      dbo.['Tarif BPJS$'] ON dbo.mt_master_tarif_detail.kode_tarif = dbo.['Tarif BPJS$'].kode_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_bpjs_v]");
    }
};
