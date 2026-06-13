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
        DB::statement("CREATE VIEW dbo.rg_info_pasienRi_v
AS
SELECT     dbo.ri_tc_rawatinap.kode_ri, dbo.ri_tc_rawatinap.no_kunjungan, dbo.ri_tc_rawatinap.kode_ruangan, dbo.ri_tc_rawatinap.bag_pas, 
                      dbo.ri_tc_rawatinap.kelas_pas, dbo.ri_tc_rawatinap.tgl_masuk, dbo.ri_tc_rawatinap.tgl_keluar, dbo.tc_kunjungan.no_kunjungan AS kunjungan, 
                      dbo.tc_kunjungan.no_registrasi, dbo.tc_kunjungan.no_mr, dbo.mt_bagian.nama_bagian, dbo.mt_klas.nama_klas, dbo.rg_master_pasien_v.nasabah, 
                      dbo.rg_master_pasien_v.perusahaan, dbo.rg_master_pasien_v.nama_pasien, dbo.ri_tc_rawatinap.status_pulang, dbo.mt_ruangan.no_kamar, 
                      dbo.tc_kunjungan.status_batal, dbo.mt_ruangan.no_bed, dbo.mt_ruangan.status
FROM         dbo.ri_tc_rawatinap INNER JOIN
                      dbo.tc_kunjungan ON dbo.ri_tc_rawatinap.no_kunjungan = dbo.tc_kunjungan.no_kunjungan INNER JOIN
                      dbo.mt_bagian ON dbo.ri_tc_rawatinap.bag_pas = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_klas ON dbo.ri_tc_rawatinap.kelas_pas = dbo.mt_klas.kode_klas INNER JOIN
                      dbo.rg_master_pasien_v ON dbo.tc_kunjungan.no_mr = dbo.rg_master_pasien_v.no_mr INNER JOIN
                      dbo.mt_ruangan ON dbo.ri_tc_rawatinap.kode_ruangan = dbo.mt_ruangan.kode_ruangan
WHERE     (dbo.ri_tc_rawatinap.tgl_keluar IS NULL) AND (dbo.ri_tc_rawatinap.status_pulang = 0 OR
                      dbo.ri_tc_rawatinap.status_pulang IS NULL) AND (dbo.tc_kunjungan.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rg_info_pasienRi_v]");
    }
};
