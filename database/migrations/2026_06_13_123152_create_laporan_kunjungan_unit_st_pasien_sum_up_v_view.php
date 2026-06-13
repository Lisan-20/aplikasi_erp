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
        DB::statement("CREATE VIEW dbo.laporan_kunjungan_unit_st_pasien_sum_up_v
AS
SELECT     dbo.laporan_kunjungan_unit_st_pasien_sum_v.jml_lamabaru, dbo.laporan_kunjungan_unit_st_pasien_sum_v.stat_pasien, dbo.laporan_kunjungan_unit_detail_temp.kode_kelompok, 
                      dbo.laporan_kunjungan_unit_detail_temp.kode_bagian, dbo.laporan_kunjungan_unit_detail_temp.bln, dbo.laporan_kunjungan_unit_detail_temp.thn, dbo.laporan_kunjungan_unit_detail_temp.lama, 
                      dbo.laporan_kunjungan_unit_detail_temp.baru
FROM         dbo.laporan_kunjungan_unit_detail_temp INNER JOIN
                      dbo.laporan_kunjungan_unit_st_pasien_sum_v ON dbo.laporan_kunjungan_unit_detail_temp.kode_bagian = dbo.laporan_kunjungan_unit_st_pasien_sum_v.kode_bagian AND 
                      dbo.laporan_kunjungan_unit_detail_temp.bln = dbo.laporan_kunjungan_unit_st_pasien_sum_v.bln AND 
                      dbo.laporan_kunjungan_unit_detail_temp.thn = dbo.laporan_kunjungan_unit_st_pasien_sum_v.thn AND 
                      dbo.laporan_kunjungan_unit_detail_temp.kode_perusahaan = dbo.laporan_kunjungan_unit_st_pasien_sum_v.kode_perusahaan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [laporan_kunjungan_unit_st_pasien_sum_up_v]");
    }
};
