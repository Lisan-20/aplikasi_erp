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
        DB::statement("CREATE VIEW dbo.tc_emr_form_unit_lain3_v
AS
SELECT        dbo.tc_emr_form.no_mr, dbo.tc_emr_form.no_registrasi, dbo.tc_emr_form.no_kunjungan, dbo.tc_emr_form.kode_rm, COUNT(dbo.tc_emr_form.id_tc_emr) AS Expr1, dbo.mt_bagian.nama_bagian, dbo.mt_emr.nama_form, 
                         dbo.mt_emr.url_cetakan, dbo.tc_emr_form.kode_bagian
FROM            dbo.mt_emr INNER JOIN
                         dbo.tc_emr_form ON dbo.mt_emr.kode_rm = dbo.tc_emr_form.kode_rm INNER JOIN
                         dbo.mt_bagian ON dbo.tc_emr_form.kode_bagian = dbo.mt_bagian.kode_bagian
GROUP BY dbo.tc_emr_form.no_mr, dbo.tc_emr_form.no_registrasi, dbo.tc_emr_form.no_kunjungan, dbo.tc_emr_form.kode_rm, dbo.mt_bagian.nama_bagian, dbo.mt_emr.nama_form, dbo.mt_emr.url_cetakan, 
                         dbo.tc_emr_form.kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_emr_form_unit_lain3_v]");
    }
};
