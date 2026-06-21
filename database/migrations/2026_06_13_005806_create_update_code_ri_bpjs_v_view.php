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
        DB::statement("CREATE OR ALTER VIEW dbo.update_code_ri_bpjs_v
AS
SELECT     dbo.tc_registrasi.code, dbo.tc_registrasi.kdDiag, dbo.tc_registrasi.klsRawat, dbo.tc_registrasi.no_registrasi, dbo.ri_tc_rawatinap.icd10, dbo.ri_tc_rawatinap.kode_plafon, 
                      dbo.ri_tc_rawatinap.kelas_pas, dbo.KelasBPJS(dbo.ri_tc_rawatinap.kelas_pas) AS KL_BPJS, dbo.mapping_tariff_inacbg_diag_v.[ tariff] AS tarif_bpjs, dbo.ri_tc_rawatinap.code_inacbg, 
                      dbo.mapping_tariff_inacbg_diag_v.kode_icd_diagnosa, dbo.tc_registrasi.plafon_bpjs
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.ri_tc_rawatinap ON dbo.tc_kunjungan.no_kunjungan = dbo.ri_tc_rawatinap.no_kunjungan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.mapping_tariff_inacbg_diag_v ON dbo.ri_tc_rawatinap.code_inacbg = dbo.mapping_tariff_inacbg_diag_v.inacbg_inp AND dbo.KelasBPJS(dbo.ri_tc_rawatinap.kelas_pas) 
                      = dbo.mapping_tariff_inacbg_diag_v.kelas_rawat AND dbo.ri_tc_rawatinap.icd10 = dbo.mapping_tariff_inacbg_diag_v.kode_icd_diagnosa
WHERE     (dbo.tc_registrasi.kdDiag <> '') AND (dbo.tc_registrasi.code = '')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_code_ri_bpjs_v]");
    }
};
