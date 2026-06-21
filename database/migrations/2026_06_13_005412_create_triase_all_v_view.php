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
        DB::statement("CREATE OR ALTER VIEW dbo.triase_all_v
AS
SELECT     dbo.lap_kunjungan_igd_new_temp.tglnya, dbo.lap_kunjungan_igd_new_temp.blnnya, dbo.lap_kunjungan_igd_new_temp.thnnya, dbo.lap_kunjungan_igd_new_temp.tri_hijau, 
                      dbo.lap_kunjungan_igd_new_temp.tri_kuning, dbo.lap_kunjungan_igd_new_temp.tri_merah, dbo.lap_kunjungan_igd_new_temp.tri_hitam, CASE WHEN triase_hijau_v.jmlpas IS NULL 
                      THEN 0 ELSE triase_hijau_v.jmlpas END AS hijau, CASE WHEN triase_hitam_v.jmlpas IS NULL THEN 0 ELSE triase_hitam_v.jmlpas END AS hitam, CASE WHEN triase_kuning_v.jmlpas IS NULL 
                      THEN 0 ELSE triase_kuning_v.jmlpas END AS kuning, CASE WHEN triase_merah_v.jmlpas IS NULL THEN 0 ELSE triase_merah_v.jmlpas END AS merah
FROM         dbo.lap_kunjungan_igd_new_temp LEFT OUTER JOIN
                      dbo.triase_kuning_v ON dbo.lap_kunjungan_igd_new_temp.tglnya = dbo.triase_kuning_v.tgl AND dbo.lap_kunjungan_igd_new_temp.blnnya = dbo.triase_kuning_v.bln AND 
                      dbo.lap_kunjungan_igd_new_temp.thnnya = dbo.triase_kuning_v.thn LEFT OUTER JOIN
                      dbo.triase_merah_v ON dbo.lap_kunjungan_igd_new_temp.tglnya = dbo.triase_merah_v.tgl AND dbo.lap_kunjungan_igd_new_temp.blnnya = dbo.triase_merah_v.bln AND 
                      dbo.lap_kunjungan_igd_new_temp.thnnya = dbo.triase_merah_v.thn LEFT OUTER JOIN
                      dbo.triase_hitam_v ON dbo.lap_kunjungan_igd_new_temp.tglnya = dbo.triase_hitam_v.tgl AND dbo.lap_kunjungan_igd_new_temp.blnnya = dbo.triase_hitam_v.bln AND 
                      dbo.lap_kunjungan_igd_new_temp.thnnya = dbo.triase_hitam_v.thn LEFT OUTER JOIN
                      dbo.triase_hijau_v ON dbo.lap_kunjungan_igd_new_temp.tglnya = dbo.triase_hijau_v.tgl AND dbo.lap_kunjungan_igd_new_temp.blnnya = dbo.triase_hijau_v.bln AND 
                      dbo.lap_kunjungan_igd_new_temp.thnnya = dbo.triase_hijau_v.thn
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [triase_all_v]");
    }
};
