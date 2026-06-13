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
        DB::statement("CREATE OR ALTER VIEW dbo.selisih_plafon_bpjs_ranap_v
AS
SELECT     dbo.mt_plafon_bpjs_detail.kode_plafon, dbo.mt_plafon_bpjs_detail.kode_bagian, dbo.mt_plafon_bpjs_detail.persen, dbo.tc_registrasi.plafon_bpjs, 
                      dbo.tc_registrasi.plafon_bpjs * dbo.mt_plafon_bpjs_detail.persen / 100 AS selisih, dbo.tc_registrasi.no_registrasi, dbo.mt_plafon_bpjs_detail.id_jenis_layanan
FROM         dbo.mt_plafon_bpjs_detail INNER JOIN
                      dbo.tc_registrasi ON dbo.mt_plafon_bpjs_detail.kode_plafon = dbo.tc_registrasi.kode_plafon
WHERE     (dbo.mt_plafon_bpjs_detail.id_jenis_layanan IN (5, 13))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [selisih_plafon_bpjs_ranap_v]");
    }
};
