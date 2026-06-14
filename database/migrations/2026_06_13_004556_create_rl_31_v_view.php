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
        DB::statement("CREATE OR ALTER VIEW dbo.rl_31_v
AS
SELECT     dbo.tc_kunjungan.no_registrasi AS jml, DAY(dbo.tc_kunjungan.tgl_masuk) AS day, MONTH(dbo.tc_kunjungan.tgl_masuk) AS bln, YEAR(dbo.tc_kunjungan.tgl_masuk) AS thn, 
                      dbo.tc_kunjungan.kode_bagian_tujuan AS kode_bagian, dbo.tc_kunjungan.kode_bagian_asal, dbo.tc_kunjungan.no_registrasi, dbo.tc_kunjungan.no_mr, dbo.tc_kunjungan.kode_dokter, 
                      dbo.mt_bagian.nama_bagian, dbo.mt_bagian.kode_rs, dbo.ri_tc_rawatinap.diagnosa_awal, dbo.ri_tc_rawatinap.kelas_pas, dbo.ri_tc_rawatinap.tgl_keluar, dbo.ri_tc_rawatinap.tgl_masuk
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.ri_tc_rawatinap ON dbo.tc_kunjungan.no_kunjungan = dbo.ri_tc_rawatinap.no_kunjungan LEFT OUTER JOIN
                      dbo.mt_bagian ON dbo.tc_kunjungan.kode_bagian_asal = dbo.mt_bagian.kode_bagian
WHERE     (dbo.tc_kunjungan.kode_bagian_asal LIKE '03%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rl_31_v]");
    }
};
