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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_surat_kematian_v
AS
SELECT     dbo.tc_surat_kematian.id_mt_kd, dbo.tc_surat_kematian.kode_bagian, dbo.tc_surat_kematian.no_kunjungan, dbo.tc_surat_kematian.kd_lev, dbo.tc_surat_kematian.kd_type, 
                      dbo.tc_surat_kematian.hasil, dbo.mt_acc_erm.kd_ref, dbo.mt_acc_erm.ket, dbo.mt_acc_erm.nama_pemeriksaan, dbo.tc_surat_kematian.hasil2, dbo.mt_acc_erm.kd_kk, 
                      dbo.tc_surat_kematian.ket AS ket_hasil, dbo.tc_surat_kematian.kode_pemeriksaan, dbo.tc_surat_kematian.id_triase, dbo.tc_surat_kematian.sekor AS hasil_sekor, 
                      dbo.mt_acc_erm.sekor AS nilai_sekor, dbo.mt_acc_erm.kd_EWS, dbo.mt_acc_erm.warna, dbo.tc_emr_form.tgl_update AS tgl_jam, dbo.tc_surat_kematian.no_urut_ews, 
                      dbo.tc_surat_kematian.no_urut AS no_urut2, dbo.tc_surat_kematian.kode_rm, dbo.tc_emr_form.tgl_update, dbo.tc_surat_kematian.no_registrasi, dbo.tc_emr_form.no_urut, 
                      dbo.tc_surat_kematian.no_mr
FROM         dbo.tc_surat_kematian INNER JOIN
                      dbo.mt_acc_erm ON dbo.tc_surat_kematian.kode_pemeriksaan = dbo.mt_acc_erm.kd_periksa INNER JOIN
                      dbo.tc_emr_form ON dbo.tc_surat_kematian.no_registrasi = dbo.tc_emr_form.no_registrasi AND dbo.tc_surat_kematian.kode_rm = dbo.tc_emr_form.kode_rm AND 
                      dbo.tc_surat_kematian.no_urut = dbo.tc_emr_form.no_urut
GROUP BY dbo.tc_surat_kematian.id_mt_kd, dbo.tc_surat_kematian.kode_bagian, dbo.tc_surat_kematian.no_kunjungan, dbo.tc_surat_kematian.kd_lev, dbo.tc_surat_kematian.kd_type, 
                      dbo.tc_surat_kematian.hasil, dbo.mt_acc_erm.kd_ref, dbo.mt_acc_erm.ket, dbo.mt_acc_erm.nama_pemeriksaan, dbo.tc_surat_kematian.hasil2, dbo.mt_acc_erm.kd_kk, dbo.tc_surat_kematian.ket, 
                      dbo.tc_surat_kematian.kode_pemeriksaan, dbo.tc_surat_kematian.id_triase, dbo.tc_surat_kematian.sekor, dbo.mt_acc_erm.sekor, dbo.mt_acc_erm.kd_EWS, dbo.mt_acc_erm.warna, 
                      dbo.tc_emr_form.tgl_update, dbo.tc_surat_kematian.no_urut_ews, dbo.tc_surat_kematian.no_urut, dbo.tc_surat_kematian.kode_rm, dbo.tc_surat_kematian.no_registrasi, dbo.tc_emr_form.no_urut, 
                      dbo.tc_surat_kematian.no_mr
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_surat_kematian_v]");
    }
};
