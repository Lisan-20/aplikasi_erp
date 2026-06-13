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
        DB::statement("CREATE VIEW dbo.ri_tc_rawatinap2_v
AS
SELECT     MAX(dbo.ri_tc_rawatinap.kode_ri) AS kode_ri, dbo.ri_tc_rawatinap.no_kunjungan, dbo.ri_tc_rawatinap.bag_pas, dbo.ri_tc_rawatinap.tgl_keluar, dbo.ri_tc_rawatinap.kode_ruangan, 
                      dbo.ri_tc_rawatinap.kelas_pas, dbo.tc_kunjungan.no_registrasi
FROM         dbo.ri_tc_rawatinap INNER JOIN
                      dbo.tc_kunjungan ON dbo.ri_tc_rawatinap.no_kunjungan = dbo.tc_kunjungan.no_kunjungan
GROUP BY dbo.ri_tc_rawatinap.no_kunjungan, dbo.ri_tc_rawatinap.bag_pas, dbo.ri_tc_rawatinap.tgl_keluar, dbo.ri_tc_rawatinap.kode_ruangan, dbo.ri_tc_rawatinap.kelas_pas, 
                      dbo.tc_kunjungan.no_registrasi
HAVING      (dbo.ri_tc_rawatinap.tgl_keluar IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ri_tc_rawatinap2_v]");
    }
};
