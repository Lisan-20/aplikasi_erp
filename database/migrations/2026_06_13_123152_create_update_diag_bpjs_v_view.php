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
        DB::statement("CREATE VIEW dbo.update_diag_bpjs_v
AS
SELECT     dbo.ri_tc_rawatinap.code_inacbg, dbo.ri_tc_rawatinap.diagnosa_awal, dbo.v_diag_bpjs.code_inacbg AS kode_cbg, dbo.mt_tariff_bpjs_ri.code, dbo.mt_tariff_bpjs_ri.kelas_3, 
                      dbo.mt_tariff_bpjs_ri.kelas_2, dbo.mt_tariff_bpjs_ri.kelas_1, dbo.ri_tc_rawatinap.kelas_pas, dbo.mt_klas.nama_klas, dbo.ri_tc_rawatinap.plafon_bpjs, dbo.mt_tariff_bpjs_ri.vip, 
                      dbo.ri_tc_rawatinap.alos, dbo.mt_tariff_bpjs_ri.alos AS rawat, dbo.ri_tc_rawatinap.kode_plafon
FROM         dbo.ri_tc_rawatinap INNER JOIN
                      dbo.v_diag_bpjs ON dbo.ri_tc_rawatinap.diagnosa_awal = dbo.v_diag_bpjs.Description INNER JOIN
                      dbo.mt_tariff_bpjs_ri ON dbo.v_diag_bpjs.code_inacbg = dbo.mt_tariff_bpjs_ri.code INNER JOIN
                      dbo.mt_klas ON dbo.ri_tc_rawatinap.kelas_pas = dbo.mt_klas.kode_klas INNER JOIN
                      dbo.update_kode_plafon_ri_bpjs_v ON dbo.ri_tc_rawatinap.kode_ri = dbo.update_kode_plafon_ri_bpjs_v.kode_ri
WHERE     (dbo.ri_tc_rawatinap.diagnosa_awal <> '')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_diag_bpjs_v]");
    }
};
