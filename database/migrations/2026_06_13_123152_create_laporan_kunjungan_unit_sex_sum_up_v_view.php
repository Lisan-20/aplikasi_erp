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
        DB::statement("CREATE VIEW dbo.laporan_kunjungan_unit_sex_sum_up_v
AS
SELECT     TOP (100) PERCENT dbo.laporan_kunjungan_unit_detail_temp.kode_bagian, dbo.laporan_kunjungan_unit_detail_temp.bln, dbo.laporan_kunjungan_unit_detail_temp.kode_perusahaan, 
                      dbo.laporan_kunjungan_unit_detail_temp.laki, dbo.laporan_kunjungan_unit_detail_temp.wanita, dbo.laporan_kunjungan_unit_detail_temp.thn, dbo.laporan_kunjungan_unit_sex_temp.jen_kelamin, 
                      dbo.laporan_kunjungan_unit_sex_temp.jen_kelamin_up
FROM         dbo.laporan_kunjungan_unit_detail_temp INNER JOIN
                      dbo.laporan_kunjungan_unit_sex_temp ON dbo.laporan_kunjungan_unit_detail_temp.kode_bagian = dbo.laporan_kunjungan_unit_sex_temp.kode_bagian AND 
                      dbo.laporan_kunjungan_unit_detail_temp.kode_perusahaan = dbo.laporan_kunjungan_unit_sex_temp.kode_perusahaan AND 
                      dbo.laporan_kunjungan_unit_detail_temp.bln = dbo.laporan_kunjungan_unit_sex_temp.bln AND dbo.laporan_kunjungan_unit_detail_temp.thn = dbo.laporan_kunjungan_unit_sex_temp.thn
ORDER BY dbo.laporan_kunjungan_unit_detail_temp.kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [laporan_kunjungan_unit_sex_sum_up_v]");
    }
};
