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
        DB::statement("CREATE VIEW dbo.pasien_masuk_malam_v
AS
SELECT     MONTH(dbo.ri_tc_rawatinap.tgl_masuk) AS bln_masuk, YEAR(dbo.ri_tc_rawatinap.tgl_masuk) AS thn_masuk, dbo.hari_rawat_v_sum.jumlah, 
                      MONTH(dbo.ri_tc_rawatinap.tgl_keluar) AS bln_keluar, YEAR(dbo.ri_tc_rawatinap.tgl_keluar) AS thn_keluar, dbo.mt_bagian.nama_bagian, 
                      dbo.tc_kunjungan.no_registrasi, dbo.tc_kunjungan.no_mr, dbo.tc_kunjungan.kode_bagian_tujuan, dbo.tc_kunjungan.kode_bagian_asal, 
                      dbo.tc_kunjungan.status_batal, DAY(dbo.ri_tc_rawatinap.tgl_masuk) AS tgl1_masuk, DAY(dbo.ri_tc_rawatinap.tgl_keluar) AS tgl1_keluar, 
                      { fn HOUR(dbo.ri_tc_rawatinap.tgl_masuk) } AS jam, dbo.tc_kunjungan.tgl_masuk
FROM         dbo.hari_rawat_v_sum INNER JOIN
                      dbo.ri_tc_rawatinap ON dbo.hari_rawat_v_sum.no_kunjungan = dbo.ri_tc_rawatinap.no_kunjungan INNER JOIN
                      dbo.tc_kunjungan ON dbo.hari_rawat_v_sum.no_kunjungan = dbo.tc_kunjungan.no_kunjungan INNER JOIN
                      dbo.mt_bagian ON dbo.ri_tc_rawatinap.bag_pas = dbo.mt_bagian.kode_bagian
WHERE     ({ fn HOUR(dbo.ri_tc_rawatinap.tgl_masuk) } > 17)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pasien_masuk_malam_v]");
    }
};
