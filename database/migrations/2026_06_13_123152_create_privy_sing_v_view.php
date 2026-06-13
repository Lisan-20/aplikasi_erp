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
        DB::statement("CREATE VIEW dbo.privy_sing_v
AS
SELECT     dbo.tc_emr_form.id_tc_emr, dbo.tc_emr_form.no_mr, dbo.tc_emr_form.no_registrasi, dbo.tc_emr_form.kode_rm, dbo.tc_emr_form.tgl_update, dbo.tc_emr_form.reference_number, 
                      dbo.tc_emr_form.document_token, dbo.tc_emr_form.signed_document, dbo.tc_emr_form.update_at, dbo.tc_emr_form.link_url, dbo.mt_master_pasien.nama_pasien, dbo.mt_emr.nama_form, 
                      dbo.mt_karyawan.nama_pegawai, dbo.tc_emr_form.id_user, dbo.mt_karyawan.kode_dokter, dbo.tc_emr_form.flag_privy, dbo.tc_emr_form.filename
FROM         dbo.tc_emr_form INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_emr_form.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.mt_emr ON dbo.tc_emr_form.kode_rm = dbo.mt_emr.kode_rm LEFT OUTER JOIN
                      dbo.mt_karyawan ON dbo.tc_emr_form.id_user = dbo.mt_karyawan.no_induk
GROUP BY dbo.tc_emr_form.no_mr, dbo.tc_emr_form.no_registrasi, dbo.tc_emr_form.kode_rm, dbo.tc_emr_form.tgl_update, dbo.tc_emr_form.reference_number, dbo.tc_emr_form.document_token, 
                      dbo.tc_emr_form.signed_document, dbo.tc_emr_form.update_at, dbo.tc_emr_form.link_url, dbo.mt_master_pasien.nama_pasien, dbo.mt_emr.nama_form, dbo.tc_emr_form.id_tc_emr, 
                      dbo.mt_karyawan.nama_pegawai, dbo.tc_emr_form.id_user, dbo.mt_karyawan.kode_dokter, dbo.tc_emr_form.flag_privy, dbo.tc_emr_form.filename
HAVING      (dbo.tc_emr_form.reference_number IS NOT NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [privy_sing_v]");
    }
};
