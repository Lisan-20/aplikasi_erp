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
        DB::statement("CREATE OR ALTER VIEW dbo.total_bed_v
AS
SELECT     2 AS nilai, dbo.tbl_lap_rekam_medis.kode_lap_rm, dbo.tbl_lap_rekam_medis.nama_kolom, dbo.tbl_jumlah_tt.bulan, dbo.tbl_jumlah_tt.tahun, 
                      dbo.tbl_jumlah_tt.jumlah_tt
FROM         dbo.tbl_lap_rekam_medis INNER JOIN
                      dbo.tbl_jumlah_tt ON dbo.tbl_lap_rekam_medis.kode_lap_rm = dbo.tbl_jumlah_tt.nilai
GROUP BY dbo.tbl_lap_rekam_medis.kode_lap_rm, dbo.tbl_lap_rekam_medis.nama_kolom, dbo.tbl_jumlah_tt.bulan, dbo.tbl_jumlah_tt.tahun, dbo.tbl_jumlah_tt.jumlah_tt
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [total_bed_v]");
    }
};
