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
        DB::statement("CREATE VIEW dbo.gd_mt_pasien_v
AS
SELECT     dbo.gd_tc_gawat_darurat.kode_gd, dbo.gd_tc_gawat_darurat.no_kunjungan, dbo.gd_tc_gawat_darurat.kode_penyakit, dbo.gd_tc_gawat_darurat.tanggal_gd, 
                      dbo.tc_registrasi.no_registrasi, dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.stat_pasien, 
                      dbo.mt_master_pasien.nama_pasien, dbo.tc_registrasi.kode_dokter, dbo.tc_registrasi.kode_bagian_masuk AS kode_bagian
FROM         dbo.gd_tc_gawat_darurat INNER JOIN
                      dbo.tc_kunjungan ON dbo.gd_tc_gawat_darurat.no_kunjungan = dbo.tc_kunjungan.no_kunjungan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_registrasi.no_mr = dbo.mt_master_pasien.no_mr
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [gd_mt_pasien_v]");
    }
};
