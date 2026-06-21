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
        DB::statement("CREATE OR ALTER VIEW dbo.update_plafon_bpjs_RI_v
AS
SELECT        dbo.tc_sep_ri_temp.no_sep, dbo.tc_sep_ri_temp.kode_cbg, dbo.tc_sep_ri_temp.total_tarif, dbo.tc_sep_ri_temp.tarif_rs, dbo.tc_sep_ri_temp.jenis, dbo.registrasi_simrs_v.no_mr, 
                         dbo.registrasi_simrs_v.no_registrasi, dbo.registrasi_simrs_v.plafon_bpjs, dbo.registrasi_simrs_v.kode_plafon, dbo.registrasi_simrs_v.TglMasuk, dbo.registrasi_simrs_v.TglKeluar, 
                         dbo.tc_sep_ri_temp.tgl_masuk, dbo.tc_sep_ri_temp.tgl_pulang, dbo.ri_tc_rawatinap.code_inacbg, dbo.ri_tc_rawatinap.alos, dbo.ri_tc_rawatinap.kode_plafon AS kd_plafon, 
                         dbo.ri_tc_rawatinap.plafon_bpjs AS plafon
FROM            dbo.ri_tc_rawatinap INNER JOIN
                         dbo.tc_kunjungan ON dbo.ri_tc_rawatinap.no_kunjungan = dbo.tc_kunjungan.no_kunjungan INNER JOIN
                         dbo.tc_sep_ri_temp INNER JOIN
                         dbo.registrasi_simrs_v ON dbo.tc_sep_ri_temp.tgl_pulang = dbo.registrasi_simrs_v.TglKeluar AND dbo.tc_sep_ri_temp.tgl_masuk = dbo.registrasi_simrs_v.TglMasuk AND 
                         dbo.tc_sep_ri_temp.no_mr = dbo.registrasi_simrs_v.no_mr ON dbo.tc_kunjungan.no_registrasi = dbo.registrasi_simrs_v.no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_plafon_bpjs_RI_v]");
    }
};
