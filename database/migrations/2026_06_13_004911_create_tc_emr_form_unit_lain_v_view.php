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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_emr_form_unit_lain_v
AS
SELECT     dbo.mt_emr_unit_v.kode_bagian, dbo.mt_emr_unit_v.kode_rm, dbo.mt_emr_unit_v.no_urut_form, dbo.mt_emr_unit_v.nama_form, dbo.mt_emr_unit_v.url_cetakan, dbo.mt_emr_unit_v.icon, 
                      dbo.tc_emr_form.no_registrasi, dbo.mt_emr_unit_v.nama_bagian, dbo.tc_emr_form.no_kunjungan, dbo.tc_registrasi.id_triase_identitas, dbo.tc_emr_form.id_tc_emr, 
                      dbo.tc_emr_form.tgl_update
FROM         dbo.mt_emr_unit_v INNER JOIN
                      dbo.tc_emr_form ON dbo.mt_emr_unit_v.kode_rm = dbo.tc_emr_form.kode_rm INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_emr_form.no_registrasi = dbo.tc_registrasi.no_registrasi
GROUP BY dbo.mt_emr_unit_v.kode_bagian, dbo.mt_emr_unit_v.kode_rm, dbo.mt_emr_unit_v.no_urut_form, dbo.mt_emr_unit_v.nama_form, dbo.mt_emr_unit_v.url_cetakan, dbo.mt_emr_unit_v.icon, 
                      dbo.tc_emr_form.no_registrasi, dbo.mt_emr_unit_v.nama_bagian, dbo.tc_emr_form.no_kunjungan, dbo.tc_registrasi.id_triase_identitas, dbo.tc_emr_form.id_tc_emr, 
                      dbo.tc_emr_form.tgl_update
HAVING      (dbo.mt_emr_unit_v.kode_bagian IN ('020101', '031001', '030901', '030501'))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_emr_form_unit_lain_v]");
    }
};
