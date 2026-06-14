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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_emr_form_unit_lain2_v
AS
SELECT     dbo.tc_emr_form.no_mr, dbo.tc_emr_form.no_registrasi, dbo.tc_emr_form.no_kunjungan, dbo.tc_emr_form.kode_rm, COUNT(dbo.tc_emr_form.id_tc_emr) AS jumlah, 
                      dbo.tc_kunjungan.kode_bagian_tujuan AS kode_bagian, dbo.mt_bagian.nama_bagian, dbo.mt_emr.nama_form, dbo.mt_emr.url_cetakan, mt_bagian_1.nama_bagian AS depo
FROM         dbo.tc_emr_form INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_emr_form.no_kunjungan = dbo.tc_kunjungan.no_kunjungan INNER JOIN
                      dbo.mt_bagian ON dbo.tc_kunjungan.kode_bagian_tujuan = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_emr ON dbo.tc_emr_form.kode_rm = dbo.mt_emr.kode_rm LEFT OUTER JOIN
                      dbo.mt_bagian AS mt_bagian_1 ON dbo.mt_bagian.kode_depo_bag = mt_bagian_1.kode_bagian
GROUP BY dbo.tc_emr_form.no_mr, dbo.tc_emr_form.no_registrasi, dbo.tc_emr_form.no_kunjungan, dbo.tc_emr_form.kode_rm, dbo.tc_kunjungan.kode_bagian_tujuan, dbo.mt_bagian.nama_bagian, 
                      dbo.mt_emr.nama_form, dbo.mt_emr.url_cetakan, mt_bagian_1.nama_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_emr_form_unit_lain2_v]");
    }
};
