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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_jumlah_lap_update_gizi_view
AS
SELECT     dbo.lap_kunjungan_gizi_temp.tgl, dbo.lap_kunjungan_gizi_temp.bln, dbo.lap_kunjungan_gizi_temp.thn, dbo.lap_kunjungan_gizi_temp.anak AS ank, dbo.lap_kunjungan_gizi_temp.dewasa AS dws, 
                      dbo.tc_jumlah_dewasa_gizi_view.dewasa, dbo.tc_jumlah_anak_gizi_view.anak, dbo.lap_kunjungan_gizi_temp.distribusi
FROM         dbo.lap_kunjungan_gizi_temp LEFT OUTER JOIN
                      dbo.tc_jumlah_dewasa_gizi_view ON dbo.lap_kunjungan_gizi_temp.distribusi = dbo.tc_jumlah_dewasa_gizi_view.distribusi AND 
                      dbo.lap_kunjungan_gizi_temp.tgl = dbo.tc_jumlah_dewasa_gizi_view.tgl AND dbo.lap_kunjungan_gizi_temp.bln = dbo.tc_jumlah_dewasa_gizi_view.bln AND 
                      dbo.lap_kunjungan_gizi_temp.thn = dbo.tc_jumlah_dewasa_gizi_view.thn LEFT OUTER JOIN
                      dbo.tc_jumlah_anak_gizi_view ON dbo.lap_kunjungan_gizi_temp.distribusi = dbo.tc_jumlah_anak_gizi_view.distribusi AND 
                      dbo.lap_kunjungan_gizi_temp.tgl = dbo.tc_jumlah_anak_gizi_view.tgl AND dbo.lap_kunjungan_gizi_temp.bln = dbo.tc_jumlah_anak_gizi_view.bln AND 
                      dbo.lap_kunjungan_gizi_temp.thn = dbo.tc_jumlah_anak_gizi_view.thn
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_jumlah_lap_update_gizi_view]");
    }
};
