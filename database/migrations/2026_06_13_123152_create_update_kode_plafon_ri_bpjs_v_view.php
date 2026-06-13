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
        DB::statement("CREATE VIEW dbo.update_kode_plafon_ri_bpjs_v
AS
SELECT     TOP (100) PERCENT dbo.ri_tc_riwayat_kelas.bagian_asal, dbo.mt_bagian.nama_bagian, dbo.ri_tc_riwayat_kelas.kode_ri, dbo.ri_tc_rawatinap.kode_plafon, dbo.ri_tc_rawatinap.code_inacbg, 
                      dbo.ri_tc_riwayat_kelas.bagian_tujuan
FROM         dbo.ri_tc_riwayat_kelas INNER JOIN
                      dbo.ri_tc_rawatinap ON dbo.ri_tc_riwayat_kelas.kode_ri = dbo.ri_tc_rawatinap.kode_ri INNER JOIN
                      dbo.mt_bagian ON dbo.ri_tc_riwayat_kelas.bagian_tujuan = dbo.mt_bagian.kode_bagian
GROUP BY dbo.ri_tc_riwayat_kelas.bagian_asal, dbo.mt_bagian.nama_bagian, dbo.ri_tc_riwayat_kelas.kode_ri, dbo.ri_tc_rawatinap.kode_plafon, dbo.ri_tc_rawatinap.code_inacbg, 
                      dbo.ri_tc_riwayat_kelas.bagian_tujuan, dbo.mt_bagian.kode_bagian
HAVING      (dbo.ri_tc_riwayat_kelas.bagian_asal <> '') AND (dbo.ri_tc_rawatinap.code_inacbg <> '') AND (dbo.mt_bagian.kode_bagian = '031001')
ORDER BY dbo.mt_bagian.nama_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_kode_plafon_ri_bpjs_v]");
    }
};
