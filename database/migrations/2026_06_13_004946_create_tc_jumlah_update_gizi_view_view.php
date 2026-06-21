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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_jumlah_update_gizi_view
AS
SELECT     dbo.tc_jumlah_gizi_view.bln, dbo.tc_jumlah_gizi_view.tgl, dbo.tc_jumlah_gizi_view.thn, CASE WHEN anak IS NULL THEN 0 ELSE anak END AS anak, CASE WHEN dewasa IS NULL 
                      THEN 0 ELSE dewasa END AS dewasa
FROM         dbo.tc_jumlah_gizi_view LEFT OUTER JOIN
                      dbo.tc_jumlah_anak_gizi_view ON dbo.tc_jumlah_gizi_view.thn = dbo.tc_jumlah_anak_gizi_view.thn AND dbo.tc_jumlah_gizi_view.bln = dbo.tc_jumlah_anak_gizi_view.bln AND 
                      dbo.tc_jumlah_gizi_view.tgl = dbo.tc_jumlah_anak_gizi_view.tgl LEFT OUTER JOIN
                      dbo.tc_jumlah_dewasa_gizi_view ON dbo.tc_jumlah_gizi_view.tgl = dbo.tc_jumlah_dewasa_gizi_view.tgl AND dbo.tc_jumlah_gizi_view.bln = dbo.tc_jumlah_dewasa_gizi_view.bln AND 
                      dbo.tc_jumlah_gizi_view.thn = dbo.tc_jumlah_dewasa_gizi_view.thn
GROUP BY dbo.tc_jumlah_gizi_view.bln, dbo.tc_jumlah_gizi_view.tgl, dbo.tc_jumlah_gizi_view.thn, CASE WHEN anak IS NULL THEN 0 ELSE anak END, CASE WHEN dewasa IS NULL 
                      THEN 0 ELSE dewasa END
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_jumlah_update_gizi_view]");
    }
};
