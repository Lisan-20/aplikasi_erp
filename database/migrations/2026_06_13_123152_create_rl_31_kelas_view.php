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
        DB::statement("CREATE OR ALTER VIEW dbo.rl_31_kelas
AS
SELECT     COUNT(dbo.tc_kunjungan.no_registrasi) AS jml, DAY(dbo.tc_kunjungan.tgl_masuk) AS day, MONTH(dbo.tc_kunjungan.tgl_masuk) AS bln, 
                      YEAR(dbo.tc_kunjungan.tgl_masuk) AS thn, dbo.tc_kunjungan.kode_bagian_tujuan AS kode_bagian, dbo.tc_kunjungan.kode_bagian_asal, 
                      dbo.ri_tc_rawat_inap_v.kelas_pas AS kode_klas
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.ri_tc_rawat_inap_v ON dbo.tc_kunjungan.no_registrasi = dbo.ri_tc_rawat_inap_v.no_registrasi AND 
                      dbo.tc_kunjungan.no_mr = dbo.ri_tc_rawat_inap_v.no_mr
GROUP BY DAY(dbo.tc_kunjungan.tgl_masuk), MONTH(dbo.tc_kunjungan.tgl_masuk), YEAR(dbo.tc_kunjungan.tgl_masuk), 
                      dbo.tc_kunjungan.kode_bagian_tujuan, dbo.tc_kunjungan.kode_bagian_asal, dbo.ri_tc_rawat_inap_v.kelas_pas
HAVING      (dbo.tc_kunjungan.kode_bagian_asal LIKE '03%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rl_31_kelas]");
    }
};
