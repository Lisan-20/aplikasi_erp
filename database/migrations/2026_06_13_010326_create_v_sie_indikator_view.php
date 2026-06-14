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
        DB::statement("CREATE OR ALTER VIEW dbo.v_sie_indikator
AS
SELECT     TOP (100) PERCENT dbo.pasien_pulang_sum_v.bag_pas, dbo.pasien_pulang_sum_v.bln, dbo.pasien_pulang_sum_v.thn, 
                      SUM(dbo.pasien_pulang_sum_v.jml_pasien) AS keluar, SUM(dbo.sum_lap_kunjungan_ranap_fix_v.masuk) AS masuk, 
                      SUM(dbo.sum_lap_kunjungan_ranap_fix_v.hari_rawat) AS hari_rawat, dbo.sum_lap_kunjungan_ranap_fix_v.kelas_pas, dbo.jml_bed_v.jml_bed
FROM         dbo.pasien_pulang_sum_v INNER JOIN
                      dbo.sum_lap_kunjungan_ranap_fix_v ON dbo.pasien_pulang_sum_v.bln = dbo.sum_lap_kunjungan_ranap_fix_v.bln_masuk AND 
                      dbo.pasien_pulang_sum_v.thn = dbo.sum_lap_kunjungan_ranap_fix_v.thn_masuk AND 
                      dbo.pasien_pulang_sum_v.bag_pas = dbo.sum_lap_kunjungan_ranap_fix_v.kode_bagian AND 
                      dbo.pasien_pulang_sum_v.kelas_pas = dbo.sum_lap_kunjungan_ranap_fix_v.kelas_pas INNER JOIN
                      dbo.jml_bed_v ON dbo.sum_lap_kunjungan_ranap_fix_v.kode_bagian = dbo.jml_bed_v.kode_bagian AND 
                      dbo.sum_lap_kunjungan_ranap_fix_v.kelas_pas = dbo.jml_bed_v.kode_klas
GROUP BY dbo.pasien_pulang_sum_v.bln, dbo.pasien_pulang_sum_v.thn, dbo.pasien_pulang_sum_v.bag_pas, dbo.sum_lap_kunjungan_ranap_fix_v.kelas_pas, 
                      dbo.jml_bed_v.jml_bed
ORDER BY dbo.pasien_pulang_sum_v.bln DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_sie_indikator]");
    }
};
