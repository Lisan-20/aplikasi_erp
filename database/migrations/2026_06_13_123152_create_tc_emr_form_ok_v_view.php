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
        DB::statement("CREATE VIEW dbo.tc_emr_form_ok_v
AS
SELECT     TOP (100) PERCENT dbo.tc_emr_form.no_mr, dbo.tc_emr_form.no_registrasi, dbo.tc_pemeriksaan_ri.no_kunjungan, dbo.tc_emr_form.kode_rm, dbo.tc_pemeriksaan_ri.no_urut, 
                      dbo.tc_emr_form.tgl_update
FROM         dbo.tc_pemeriksaan_ri INNER JOIN
                      dbo.tc_emr_form ON dbo.tc_pemeriksaan_ri.kode_rm = dbo.tc_emr_form.kode_rm AND dbo.tc_pemeriksaan_ri.no_registrasi = dbo.tc_emr_form.no_registrasi
GROUP BY dbo.tc_emr_form.no_mr, dbo.tc_emr_form.no_registrasi, dbo.tc_pemeriksaan_ri.no_kunjungan, dbo.tc_emr_form.kode_rm, dbo.tc_pemeriksaan_ri.no_urut, dbo.tc_emr_form.tgl_update
ORDER BY dbo.tc_pemeriksaan_ri.no_kunjungan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_emr_form_ok_v]");
    }
};
