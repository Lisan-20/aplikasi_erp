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
        DB::statement("CREATE VIEW dbo.pasien_pm_sum_v
AS
SELECT     TOP (100) PERCENT dbo.mt_master_pasien.no_mr, dbo.mt_master_pasien.kota, dbo.mt_master_pasien.nama_pasien, dbo.mt_master_pasien.nama_panggilan, 
                      dbo.mt_master_pasien.nama_kel_pasien, dbo.mt_master_pasien.tgl_lhr, dbo.mt_master_pasien.tempat_lahir, dbo.mt_master_pasien.almt_ttp_pasien, dbo.mt_master_pasien.tlp_almt_ttp, 
                      dbo.mt_master_pasien.jen_kelamin, dbo.mt_master_pasien.suku, dbo.mt_master_pasien.nama_kel_ter, dbo.mt_master_pasien.nama_almt_kel, dbo.mt_master_pasien.hubungan_kel, 
                      dbo.mt_master_pasien.gol_darah, dbo.tc_kunjungan.kode_bagian_tujuan AS kode_bagian, dbo.mt_master_pasien.kode_kelompok, dbo.mt_master_pasien.kode_perusahaan
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.pm_tc_penunjang ON dbo.tc_kunjungan.no_kunjungan = dbo.pm_tc_penunjang.no_kunjungan INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_kunjungan.no_mr = dbo.mt_master_pasien.no_mr
WHERE     (dbo.tc_kunjungan.status_batal IS NULL)
GROUP BY dbo.mt_master_pasien.no_mr, dbo.mt_master_pasien.kota, dbo.mt_master_pasien.nama_pasien, dbo.mt_master_pasien.nama_panggilan, dbo.mt_master_pasien.nama_kel_pasien, 
                      dbo.mt_master_pasien.tgl_lhr, dbo.mt_master_pasien.tempat_lahir, dbo.mt_master_pasien.almt_ttp_pasien, dbo.mt_master_pasien.tlp_almt_ttp, dbo.mt_master_pasien.jen_kelamin, 
                      dbo.mt_master_pasien.suku, dbo.mt_master_pasien.nama_kel_ter, dbo.mt_master_pasien.nama_almt_kel, dbo.mt_master_pasien.hubungan_kel, dbo.mt_master_pasien.gol_darah, 
                      dbo.tc_kunjungan.kode_bagian_tujuan, dbo.mt_master_pasien.kode_kelompok, dbo.mt_master_pasien.kode_perusahaan
ORDER BY dbo.mt_master_pasien.no_mr
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pasien_pm_sum_v]");
    }
};
