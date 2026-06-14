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
        DB::statement("CREATE OR ALTER VIEW dbo.data_pendukung_rm_v
AS
SELECT     dbo.tbl_lap_rekam_medis.kode_lap_rm, dbo.tbl_lap_rekam_medis.nama_kolom, dbo.jumlah_pasien_v2.bulan, dbo.jumlah_pasien_v2.tahun, dbo.jumlah_pasien_v2.jumlah_pasien, 
                      dbo.total_bed_v.jumlah_tt, dbo.total_bed_v.bulan AS bulan_bed, dbo.total_bed_v.tahun AS tahun_bed
FROM         dbo.total_bed_v RIGHT OUTER JOIN
                      dbo.jumlah_pasien_v2 ON dbo.total_bed_v.bulan = dbo.jumlah_pasien_v2.bulan AND dbo.total_bed_v.tahun = dbo.jumlah_pasien_v2.tahun CROSS JOIN
                      dbo.tbl_lap_rekam_medis
WHERE     (dbo.tbl_lap_rekam_medis.kode_lap_rm IN (1, 2))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [data_pendukung_rm_v]");
    }
};
