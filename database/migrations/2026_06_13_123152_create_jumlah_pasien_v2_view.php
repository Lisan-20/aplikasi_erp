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
        DB::statement("CREATE VIEW dbo.jumlah_pasien_v2
AS
SELECT     dbo.tbl_lap_rekam_medis.kode_lap_rm, dbo.tbl_lap_rekam_medis.nama_kolom, dbo.jumlah_pasien_v.bulan, dbo.jumlah_pasien_v.tahun, dbo.jumlah_pasien_v.jumlah_pasien
FROM         dbo.jumlah_pasien_v INNER JOIN
                      dbo.tbl_lap_rekam_medis ON dbo.jumlah_pasien_v.nilai = dbo.tbl_lap_rekam_medis.kode_lap_rm
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jumlah_pasien_v2]");
    }
};
