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
        DB::statement("CREATE VIEW dbo.tc_emr_form_igd_v
AS
SELECT dbo.mt_emr.nama_form, dbo.mt_emr.url, dbo.mt_emr.icon, dbo.mt_emr.url_cetakan, dbo.tc_emr_form.no_mr, dbo.tc_emr_form.no_registrasi, dbo.tc_emr_form.no_kunjungan, dbo.tc_emr_form.tgl_update, dbo.tc_emr_form.id_tc_emr, dbo.mt_emr.kode_rm
FROM   dbo.mt_emr INNER JOIN
             dbo.tc_emr_form ON dbo.mt_emr.kode_rm = dbo.tc_emr_form.kode_rm
WHERE (dbo.mt_emr.kode_rm IN (34, 89))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_emr_form_igd_v]");
    }
};
