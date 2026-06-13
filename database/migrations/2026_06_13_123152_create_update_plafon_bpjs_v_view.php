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
        DB::statement("CREATE VIEW dbo.update_plafon_bpjs_v
AS
SELECT     dbo.ri_tc_rawatinap.plafon_bpjs, dbo.ri_tc_rawatinap.diagnosa_awal, dbo.ri_tc_rawatinap.icd10, dbo.tc_registrasi.code, dbo.tc_registrasi.kdDiag, dbo.tc_registrasi.diagAwal, 
                      dbo.v_diag_bpjs.code_inacbg, dbo.mt_tariff_bpjs_ri.kelas_3, dbo.mt_tariff_bpjs_ri.kelas_2, dbo.mt_tariff_bpjs_ri.kelas_1, dbo.mt_tariff_bpjs_ri.alos, dbo.ri_tc_rawatinap.kelas_pas, 
                      dbo.mt_klas.nama_klas, dbo.ri_tc_rawatinap.alos AS alosri
FROM         dbo.ri_tc_rawatinap INNER JOIN
                      dbo.tc_kunjungan ON dbo.ri_tc_rawatinap.no_kunjungan = dbo.tc_kunjungan.no_kunjungan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.v_diag_bpjs ON dbo.tc_registrasi.kdDiag = dbo.v_diag_bpjs.kode INNER JOIN
                      dbo.mt_tariff_bpjs_ri ON dbo.v_diag_bpjs.code_inacbg = dbo.mt_tariff_bpjs_ri.code INNER JOIN
                      dbo.mt_klas ON dbo.ri_tc_rawatinap.kelas_pas = dbo.mt_klas.kode_klas
WHERE     (dbo.tc_registrasi.kdDiag <> '') AND (dbo.ri_tc_rawatinap.kelas_pas = 7)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_plafon_bpjs_v]");
    }
};
