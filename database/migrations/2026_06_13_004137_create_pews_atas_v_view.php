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
        DB::statement("CREATE OR ALTER VIEW dbo.pews_atas_v
AS
SELECT     dbo.tc_pemeriksaan_ri.kode_rm, dbo.tc_pemeriksaan_ri.no_registrasi, dbo.tc_emr_form.tgl_update AS tgl_jam, dbo.tc_emr_form.id_tc_emr AS no_urut
FROM         dbo.tc_pemeriksaan_ri INNER JOIN
                      dbo.tc_emr_form ON dbo.tc_pemeriksaan_ri.kode_rm = dbo.tc_emr_form.kode_rm AND dbo.tc_pemeriksaan_ri.no_registrasi = dbo.tc_emr_form.no_registrasi
GROUP BY dbo.tc_pemeriksaan_ri.kode_rm, dbo.tc_pemeriksaan_ri.no_registrasi, dbo.tc_emr_form.tgl_update, dbo.tc_emr_form.id_tc_emr
HAVING      (dbo.tc_pemeriksaan_ri.kode_rm = 131)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pews_atas_v]");
    }
};
