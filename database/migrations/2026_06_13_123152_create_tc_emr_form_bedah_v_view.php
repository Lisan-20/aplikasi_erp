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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_emr_form_bedah_v
AS
SELECT     dbo.tc_emr_form.kode_rm, dbo.tc_emr_form.no_urut, dbo.tc_emr_form.id_user, dbo.tc_emr_form.no_registrasi, dbo.mt_emr.nama_form, dbo.mt_emr.url_cetakan, dbo.tc_emr_form.tgl_update, 
                      dbo.tc_emr_form.no_mr
FROM         dbo.tc_emr_form INNER JOIN
                      dbo.mt_emr ON dbo.tc_emr_form.kode_rm = dbo.mt_emr.kode_rm
WHERE     (dbo.tc_emr_form.kode_rm IN (158, 159, 160, 161))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_emr_form_bedah_v]");
    }
};
