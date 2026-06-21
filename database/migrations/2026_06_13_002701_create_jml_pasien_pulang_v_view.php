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
        DB::statement("CREATE OR ALTER VIEW dbo.jml_pasien_pulang_v
AS
SELECT     dbo.ri_tc_rawatinap.kode_ri AS jml, dbo.ri_tc_rawatinap.status_pulang, YEAR(dbo.ri_tc_rawatinap.tgl_keluar) AS thn, MONTH(dbo.ri_tc_rawatinap.tgl_keluar) AS bln, 
                      dbo.ri_tc_riwayat_kelas.ket_keluar, dbo.ri_tc_rawatinap.bag_pas, dbo.ri_tc_rawatinap.input_pulang, dbo.ri_tc_riwayat_kelas.status_hidup, dbo.ri_tc_riwayat_kelas.kode_kematian, 
                      dbo.ri_tc_riwayat_kelas.waktu_kematian
FROM         dbo.ri_tc_rawatinap INNER JOIN
                      dbo.ri_tc_riwayat_kelas ON dbo.ri_tc_rawatinap.kode_ri = dbo.ri_tc_riwayat_kelas.kode_ri
WHERE     (dbo.ri_tc_rawatinap.status_pulang = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jml_pasien_pulang_v]");
    }
};
