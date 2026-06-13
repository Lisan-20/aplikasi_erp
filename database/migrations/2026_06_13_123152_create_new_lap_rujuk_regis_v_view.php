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
        DB::statement("CREATE OR ALTER VIEW dbo.new_lap_rujuk_regis_v
AS
SELECT     dbo.dc_asal_pasien.asal_pasien, dbo.mt_bagian.nama_bagian, dbo.mt_perusahaan.nama_perusahaan, dbo.mt_master_pasien.nama_pasien, 
                      dbo.tc_registrasi.kode_bagian_masuk AS kode_bagian, MONTH(dbo.tc_registrasi.tgl_jam_masuk) AS bln, dbo.tc_registrasi.id_dc_asal_pasien, dbo.dc_sub_asal_pasien.detail, 
                      dbo.tc_registrasi.tgl_jam_masuk, dbo.mt_master_pasien.no_mr, dbo.tc_registrasi.status_batal, dbo.tc_registrasi.tgl_jam_masuk AS tgl_masuk, YEAR(dbo.tc_registrasi.tgl_jam_masuk) AS thn, 
                      dbo.v_daftar_rawat_inap.kode_ruangan, dbo.v_daftar_rawat_inap.bag_pas, dbo.v_daftar_rawat_inap.kode_ruangan AS no_kamar, dbo.dc_asal_pasien.flag, dbo.tc_registrasi.no_registrasi, 
                      dbo.tc_registrasi.stat_pasien, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.no_induk
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.dc_asal_pasien ON dbo.tc_registrasi.id_dc_asal_pasien = dbo.dc_asal_pasien.id_dc_asal_pasien INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_registrasi.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.mt_bagian ON dbo.tc_registrasi.kode_bagian_masuk = dbo.mt_bagian.kode_bagian LEFT OUTER JOIN
                      dbo.dc_sub_asal_pasien ON dbo.tc_registrasi.id_dc_sub_asal_pasien = dbo.dc_sub_asal_pasien.id_dc_sub_asal_pasien LEFT OUTER JOIN
                      dbo.mt_perusahaan ON dbo.tc_registrasi.kode_perusahaan = dbo.mt_perusahaan.kode_perusahaan LEFT OUTER JOIN
                      dbo.v_daftar_rawat_inap ON dbo.tc_registrasi.no_registrasi = dbo.v_daftar_rawat_inap.no_registrasi
WHERE     (dbo.tc_registrasi.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [new_lap_rujuk_regis_v]");
    }
};
