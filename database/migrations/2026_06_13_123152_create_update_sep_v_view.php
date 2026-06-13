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
        DB::statement("CREATE VIEW dbo.update_sep_v
AS
SELECT     TOP (100) PERCENT dbo.registrasi_simrs_v.no_mr, dbo.registrasi_simrs_v.tgl_jam_masuk, dbo.tc_sep_ri_v.tgl_masuk, dbo.registrasi_simrs_v.plafon_bpjs, 
                      dbo.registrasi_simrs_v.noSep, dbo.tc_sep_ri_v.total_tarif, dbo.tc_sep_ri_v.no_sep, dbo.registrasi_simrs_v.kode_bagian_keluar, 
                      dbo.registrasi_simrs_v.tgl_jam_keluar, dbo.tc_sep_ri_v.tgl_pulang
FROM         dbo.registrasi_simrs_v INNER JOIN
                      dbo.tc_sep_ri_v ON dbo.registrasi_simrs_v.bln = dbo.tc_sep_ri_v.bln AND dbo.registrasi_simrs_v.no_mr = dbo.tc_sep_ri_v.no_mr
WHERE     (dbo.tc_sep_ri_v.jenis = 'RI') AND (dbo.registrasi_simrs_v.kode_bagian_keluar LIKE '03%') AND (dbo.registrasi_simrs_v.noSep IS NULL OR
                      dbo.registrasi_simrs_v.noSep = '0') AND (NOT (dbo.registrasi_simrs_v.no_mr IN
                          (SELECT     no_mr
                            FROM          dbo.cek_sep_ri_temp_v)))
ORDER BY dbo.registrasi_simrs_v.no_mr
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_sep_v]");
    }
};
