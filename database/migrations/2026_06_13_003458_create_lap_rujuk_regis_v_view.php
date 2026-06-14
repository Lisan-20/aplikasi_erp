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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_rujuk_regis_v
AS
SELECT     dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.no_kamar, dbo.dc_asal_pasien.asal_pasien, dbo.mt_bagian.nama_bagian, dbo.mt_perusahaan.nama_perusahaan, 
                      YEAR(dbo.tc_kunjungan.tgl_masuk) AS thn, MONTH(dbo.tc_kunjungan.tgl_masuk) AS bln, dbo.tc_kunjungan.tgl_masuk, dbo.mt_master_pasien.nama_pasien, 
                      dbo.tc_registrasi.kode_bagian_masuk AS kode_bagian, dbo.tc_kunjungan.tgl_masuk AS Expr1
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_trans_pelayanan.no_kunjungan = dbo.tc_kunjungan.no_kunjungan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_trans_pelayanan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.dc_asal_pasien ON dbo.tc_registrasi.id_dc_asal_pasien = dbo.dc_asal_pasien.id_dc_asal_pasien INNER JOIN
                      dbo.mt_bagian ON dbo.tc_trans_pelayanan.kode_bagian = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_perusahaan ON dbo.tc_trans_pelayanan.kode_perusahaan = dbo.mt_perusahaan.kode_perusahaan INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_trans_pelayanan.no_mr = dbo.mt_master_pasien.no_mr
GROUP BY dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.no_kamar, dbo.dc_asal_pasien.asal_pasien, dbo.mt_bagian.nama_bagian, dbo.mt_perusahaan.nama_perusahaan, 
                      YEAR(dbo.tc_kunjungan.tgl_masuk), MONTH(dbo.tc_kunjungan.tgl_masuk), dbo.tc_kunjungan.tgl_masuk, dbo.mt_master_pasien.nama_pasien, dbo.tc_registrasi.kode_bagian_masuk
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_rujuk_regis_v]");
    }
};
