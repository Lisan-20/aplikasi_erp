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
        DB::statement("CREATE VIEW dbo.detail_laporan_bpjs_v
AS
SELECT     TOP (100) PERCENT dbo.detail_lap_rajal_bpjs_v.rajal, dbo.detail_lap_ranap_bpjs_v.ranap, dbo.detail_lap_rajal_bpjs_v.bill_rajal, 
                      dbo.detail_lap_ranap_bpjs_v.bill_ranap, dbo.detail_lap_rajal_bpjs_v.tgl, dbo.detail_lap_ranap_bpjs_v.bln, dbo.detail_lap_rajal_bpjs_v.thn, 
                      SUM(dbo.detail_lap_rajal_bpjs_v.Tarif) AS tagihan_rajal, SUM(dbo.detail_lap_ranap_bpjs_v.Tarif) AS tagihan_ranap
FROM         dbo.detail_lap_rajal_bpjs_v INNER JOIN
                      dbo.detail_lap_ranap_bpjs_v ON dbo.detail_lap_rajal_bpjs_v.tgl = dbo.detail_lap_ranap_bpjs_v.tgl AND 
                      dbo.detail_lap_rajal_bpjs_v.bln = dbo.detail_lap_ranap_bpjs_v.bln AND dbo.detail_lap_rajal_bpjs_v.thn = dbo.detail_lap_ranap_bpjs_v.thn
GROUP BY dbo.detail_lap_rajal_bpjs_v.rajal, dbo.detail_lap_ranap_bpjs_v.ranap, dbo.detail_lap_rajal_bpjs_v.bill_rajal, dbo.detail_lap_ranap_bpjs_v.bill_ranap, 
                      dbo.detail_lap_rajal_bpjs_v.tgl, dbo.detail_lap_ranap_bpjs_v.bln, dbo.detail_lap_rajal_bpjs_v.thn
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [detail_laporan_bpjs_v]");
    }
};
