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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_emr_unit_terapi_v
AS
SELECT     dbo.tc_emr_form.id_tc_emr, dbo.tc_emr_form.kode_rm, dbo.tc_emr_form.no_registrasi, dbo.tc_kunjungan_terapi_detail.id_terapi, dbo.tc_kunjungan_terapi.nama_tarif, dbo.tc_emr_form.no_mr, 
                      dbo.tc_emr_form.no_urut, dbo.tc_kunjungan_terapi.tgl_awal, dbo.tc_kunjungan_terapi_detail.tgl_hadir
FROM         dbo.tc_emr_form INNER JOIN
                      dbo.tc_kunjungan_terapi_detail ON dbo.tc_emr_form.no_registrasi = dbo.tc_kunjungan_terapi_detail.no_registrasi INNER JOIN
                      dbo.tc_kunjungan_terapi ON dbo.tc_kunjungan_terapi_detail.id_terapi = dbo.tc_kunjungan_terapi.id_terapi
WHERE     (dbo.tc_emr_form.kode_rm = 213) AND (dbo.tc_kunjungan_terapi_detail.tgl_hadir IS NOT NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_emr_unit_terapi_v]");
    }
};
