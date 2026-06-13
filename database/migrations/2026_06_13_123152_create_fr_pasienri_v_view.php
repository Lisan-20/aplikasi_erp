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
        DB::statement("CREATE VIEW dbo.fr_pasienri_v
AS
SELECT     dbo.mt_master_pasien.no_mr, dbo.tc_registrasi.no_registrasi, dbo.tc_kunjungan.no_kunjungan, dbo.ri_tc_rawatinap.kode_ri, 
                      dbo.mt_master_pasien.nama_pasien, dbo.ri_tc_rawatinap.kode_ruangan, dbo.ri_tc_rawatinap.bag_pas, dbo.ri_tc_rawatinap.kelas_pas, 
                      dbo.ri_tc_rawatinap.tgl_masuk, dbo.ri_tc_rawatinap.dr_merawat, dbo.ri_tc_rawatinap.asal_pasien, dbo.ri_tc_rawatinap.bag_ibu, 
                      dbo.ri_tc_rawatinap.kelas_ibu, dbo.mt_master_pasien.kode_kelompok, dbo.mt_master_pasien.kode_perusahaan, dbo.mt_master_pasien.gol_darah, 
                      dbo.mt_master_pasien.alergi, dbo.mt_master_pasien.tgl_lhr, dbo.mt_master_pasien.jen_kelamin, dbo.mt_master_pasien.almt_ttp_pasien, 
                      dbo.ri_tc_rawatinap.tgl_keluar, dbo.ri_tc_rawatinap.status_pulang
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.ri_tc_rawatinap ON dbo.tc_kunjungan.no_kunjungan = dbo.ri_tc_rawatinap.no_kunjungan INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_registrasi.no_mr = dbo.mt_master_pasien.no_mr
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fr_pasienri_v]");
    }
};
