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
        DB::statement("CREATE OR ALTER VIEW dbo.laporan_kunjungan_unit_usia_sum_up_v
AS
SELECT     TOP (100) PERCENT dbo.laporan_kunjungan_unit_detail_temp.kode_bagian, dbo.laporan_kunjungan_unit_detail_temp.bln, dbo.laporan_kunjungan_unit_detail_temp.kode_perusahaan, 
                      dbo.laporan_kunjungan_unit_detail_temp.dewasa, dbo.laporan_kunjungan_unit_detail_temp.anak, dbo.laporan_kunjungan_unit_detail_temp.thn, dbo.laporan_kunjungan_unit_usia_temp.ket, 
                      dbo.laporan_kunjungan_unit_usia_temp.jum_pasien
FROM         dbo.laporan_kunjungan_unit_detail_temp INNER JOIN
                      dbo.laporan_kunjungan_unit_usia_temp ON dbo.laporan_kunjungan_unit_detail_temp.kode_bagian = dbo.laporan_kunjungan_unit_usia_temp.kode_bagian AND 
                      dbo.laporan_kunjungan_unit_detail_temp.kode_perusahaan = dbo.laporan_kunjungan_unit_usia_temp.kode_perusahaan AND 
                      dbo.laporan_kunjungan_unit_detail_temp.bln = dbo.laporan_kunjungan_unit_usia_temp.bln AND dbo.laporan_kunjungan_unit_detail_temp.thn = dbo.laporan_kunjungan_unit_usia_temp.thn
ORDER BY dbo.laporan_kunjungan_unit_detail_temp.kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [laporan_kunjungan_unit_usia_sum_up_v]");
    }
};
