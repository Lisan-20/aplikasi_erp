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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_emr_unit_askep_igd_v
AS
SELECT     dbo.tc_pemeriksaan_erm.kode_bagian, dbo.tc_pemeriksaan_erm.no_kunjungan, dbo.tc_pemeriksaan_erm.kode_pemeriksaan, dbo.tc_pemeriksaan_erm.hasil, dbo.mt_emr.kode_rm, 
                      dbo.mt_emr.nama_form, dbo.mt_emr.url, dbo.mt_emr.icon, dbo.mt_emr.no_urut AS no_urut_x, dbo.mt_emr.url_cetakan, dbo.mt_emr.url_edit, dbo.mt_emr.url_cetakan_his, 
                      dbo.mt_emr.url_implementasi, dbo.tc_pemeriksaan_erm.no_registrasi, dbo.mt_acc_erm.nama_pemeriksaan, dbo.tc_pemeriksaan_erm.kode_rm AS kode_rm_inp, dbo.tc_emr_form.no_urut, 
                      dbo.tc_pemeriksaan_erm.tgl_update AS Expr1, dbo.tc_emr_form.id_tc_emr, dbo.tc_emr_form.tgl_update
FROM         dbo.tc_pemeriksaan_erm INNER JOIN
                      dbo.mt_acc_erm ON dbo.tc_pemeriksaan_erm.kode_pemeriksaan = dbo.mt_acc_erm.kd_periksa INNER JOIN
                      dbo.mt_emr ON dbo.mt_acc_erm.kode_rm = dbo.mt_emr.kode_rm INNER JOIN
                      dbo.tc_emr_form ON dbo.tc_pemeriksaan_erm.kode_rm = dbo.tc_emr_form.kode_rm AND dbo.tc_pemeriksaan_erm.no_registrasi = dbo.tc_emr_form.no_registrasi AND 
                      dbo.tc_pemeriksaan_erm.no_urut = dbo.tc_emr_form.no_urut
WHERE     (dbo.tc_pemeriksaan_erm.kode_pemeriksaan >= 10500) AND (dbo.tc_pemeriksaan_erm.kode_pemeriksaan < 10530) AND (dbo.tc_pemeriksaan_erm.hasil = '1') OR
                      (dbo.tc_pemeriksaan_erm.kode_pemeriksaan IN (105011, 105013, 105014))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_emr_unit_askep_igd_v]");
    }
};
