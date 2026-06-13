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
        DB::statement("CREATE VIEW dbo.mt_emr_unit_v
AS
SELECT     dbo.mt_emr_det.no_urut, dbo.mt_emr_det.kode_bagian, dbo.mt_emr_det.no_urut_form, dbo.mt_emr.nama_form, dbo.mt_emr.url, dbo.mt_emr.icon, dbo.mt_emr.url_cetakan, 
                      dbo.mt_bagian.nama_bagian, dbo.mt_emr.kode_rm, dbo.mt_emr.url_edit, dbo.mt_emr.url_cetakan_his, dbo.mt_emr.url_implementasi
FROM         dbo.mt_emr_det INNER JOIN
                      dbo.mt_emr ON dbo.mt_emr_det.kode_rm = dbo.mt_emr.kode_rm LEFT OUTER JOIN
                      dbo.mt_bagian ON dbo.mt_emr_det.kode_bagian = dbo.mt_bagian.kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_emr_unit_v]");
    }
};
