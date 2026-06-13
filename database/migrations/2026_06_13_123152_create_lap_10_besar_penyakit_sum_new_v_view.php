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
        DB::statement("CREATE VIEW dbo.lap_10_besar_penyakit_sum_new_v
AS
SELECT     TOP (100) PERCENT dbo.lap_10_besar_penyakit_v.bulan, dbo.lap_10_besar_penyakit_v.tahun, dbo.lap_10_besar_penyakit_v.tipe_rl, COUNT(dbo.lap_10_besar_penyakit_v.kode_icd) AS jumlah, 
                      dbo.lap_10_besar_penyakit_v.kode_icd, dbo.lap_10_besar_penyakit_v.nama_icd_10, dbo.rm_format_lap_rl.nomer, dbo.rm_format_lap_rl.no_urut_dtd, dbo.rm_format_lap_rl.no_dtd, 
                      dbo.rm_format_lap_rl.no_urut_bulan, dbo.rm_format_lap_rl.nama_group, dbo.rm_format_lap_rl.icd_10, dbo.lap_10_besar_penyakit_v.tgl_jam
FROM         dbo.lap_10_besar_penyakit_v LEFT OUTER JOIN
                      dbo.rm_format_lap_rl ON dbo.lap_10_besar_penyakit_v.kode_icd = dbo.rm_format_lap_rl.icd_10
GROUP BY dbo.lap_10_besar_penyakit_v.bulan, dbo.lap_10_besar_penyakit_v.tahun, dbo.lap_10_besar_penyakit_v.tipe_rl, dbo.lap_10_besar_penyakit_v.kode_icd, 
                      dbo.lap_10_besar_penyakit_v.nama_icd_10, dbo.rm_format_lap_rl.nomer, dbo.rm_format_lap_rl.no_urut_dtd, dbo.rm_format_lap_rl.no_dtd, dbo.rm_format_lap_rl.no_urut_bulan, 
                      dbo.rm_format_lap_rl.nama_group, dbo.rm_format_lap_rl.icd_10, dbo.lap_10_besar_penyakit_v.tgl_jam
HAVING      (dbo.lap_10_besar_penyakit_v.bulan > 0)
ORDER BY jumlah DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_10_besar_penyakit_sum_new_v]");
    }
};
