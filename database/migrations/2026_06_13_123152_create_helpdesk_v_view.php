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
        DB::statement("CREATE VIEW dbo.helpdesk_v
AS
SELECT     TOP (100) PERCENT dbo.tc_report.id_report, dbo.tc_report.tgl_report, dbo.tc_report.pengirim, dbo.tc_report.flag, dbo.tc_report.group_pengirim, dbo.tc_solusi.solusi, dbo.tc_solusi.tgl_solusi, 
                      dbo.tc_report.keterangan, dbo.tc_report.alasan_permintaan, dbo.tc_report.permintaan, dbo.tc_report.submodul, dbo.tc_report.nama_modul, dbo.tc_report.nama_file, dbo.tc_report.nama_file_respon, 
                      dbo.tc_solusi.id_solusi
FROM         dbo.tc_report LEFT OUTER JOIN
                      dbo.tc_solusi ON dbo.tc_report.id_report = dbo.tc_solusi.id_report
ORDER BY dbo.tc_report.id_report DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [helpdesk_v]");
    }
};
