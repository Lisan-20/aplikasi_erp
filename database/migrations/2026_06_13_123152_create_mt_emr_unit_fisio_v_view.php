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
        DB::statement("CREATE VIEW dbo.mt_emr_unit_fisio_v
AS
SELECT     TOP (100) PERCENT dbo.mt_emr_unit_v.no_urut, dbo.mt_emr_unit_v.kode_bagian, dbo.mt_emr_unit_v.no_urut_form, dbo.mt_emr_unit_v.nama_form, dbo.mt_emr_unit_v.url, 
                      dbo.mt_emr_unit_v.icon, dbo.mt_emr_unit_v.url_cetakan, dbo.mt_emr_unit_v.kode_rm, dbo.mt_emr_unit_v.url_edit, dbo.mt_emr_unit_terapi_v.no_registrasi, dbo.mt_emr_unit_terapi_v.nama_tarif, 
                      dbo.mt_emr_unit_terapi_v.id_terapi, dbo.mt_emr_unit_terapi_v.no_mr, dbo.mt_emr_unit_terapi_v.tgl_awal
FROM         dbo.mt_emr_unit_v CROSS JOIN
                      dbo.mt_emr_unit_terapi_v
GROUP BY dbo.mt_emr_unit_v.no_urut, dbo.mt_emr_unit_v.kode_bagian, dbo.mt_emr_unit_v.no_urut_form, dbo.mt_emr_unit_v.nama_form, dbo.mt_emr_unit_v.url, dbo.mt_emr_unit_v.icon, 
                      dbo.mt_emr_unit_v.url_cetakan, dbo.mt_emr_unit_v.kode_rm, dbo.mt_emr_unit_v.url_edit, dbo.mt_emr_unit_terapi_v.no_registrasi, dbo.mt_emr_unit_terapi_v.nama_tarif, 
                      dbo.mt_emr_unit_terapi_v.id_terapi, dbo.mt_emr_unit_terapi_v.no_mr, dbo.mt_emr_unit_terapi_v.tgl_awal
HAVING      (dbo.mt_emr_unit_v.kode_rm IN (214, 215)) AND (dbo.mt_emr_unit_v.kode_bagian = '050301')
ORDER BY dbo.mt_emr_unit_terapi_v.tgl_awal DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_emr_unit_fisio_v]");
    }
};
