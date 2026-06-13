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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_pemeriksaan_gizi_v
AS
SELECT     dbo.tc_pemeriksaan_gizi.id_mt_kd, dbo.tc_pemeriksaan_gizi.kode_bagian, dbo.tc_pemeriksaan_gizi.no_kunjungan, dbo.mt_acc_erm.kd_lev, dbo.tc_pemeriksaan_gizi.kd_type, 
                      dbo.tc_pemeriksaan_gizi.hasil, dbo.mt_acc_erm.kd_ref, dbo.mt_acc_erm.ket, dbo.mt_acc_erm.nama_pemeriksaan, dbo.tc_pemeriksaan_gizi.hasil2, dbo.mt_acc_erm.kd_kk, 
                      dbo.tc_pemeriksaan_gizi.ket AS ket_hasil, dbo.tc_kunjungan.no_mr, dbo.tc_registrasi.status_batal, dbo.tc_kunjungan.no_registrasi, dbo.tc_pemeriksaan_gizi.kode_pemeriksaan, 
                      dbo.tc_pemeriksaan_gizi.id_triase, dbo.tc_pemeriksaan_gizi.sekor AS hasil_sekor, dbo.mt_acc_erm.sekor AS nilai_sekor, dbo.mt_acc_erm.kd_EWS, dbo.mt_acc_erm.warna, 
                      dbo.tc_pemeriksaan_gizi.no_urut_ews, dbo.tc_pemeriksaan_gizi.no_urut, dbo.tc_emr_form.tgl_update, dbo.tc_pemeriksaan_gizi.kode_rm
FROM         dbo.tc_pemeriksaan_gizi INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_pemeriksaan_gizi.no_kunjungan = dbo.tc_kunjungan.no_kunjungan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.mt_acc_erm ON dbo.tc_pemeriksaan_gizi.kode_pemeriksaan = dbo.mt_acc_erm.kd_periksa INNER JOIN
                      dbo.tc_emr_form ON dbo.tc_pemeriksaan_gizi.kode_rm = dbo.tc_emr_form.kode_rm AND dbo.tc_kunjungan.no_registrasi = dbo.tc_emr_form.no_registrasi AND 
                      dbo.tc_pemeriksaan_gizi.no_urut = dbo.tc_emr_form.no_urut
GROUP BY dbo.tc_pemeriksaan_gizi.id_mt_kd, dbo.tc_pemeriksaan_gizi.kode_bagian, dbo.tc_pemeriksaan_gizi.no_kunjungan, dbo.mt_acc_erm.kd_lev, dbo.tc_pemeriksaan_gizi.kd_type, 
                      dbo.tc_pemeriksaan_gizi.hasil, dbo.mt_acc_erm.kd_ref, dbo.mt_acc_erm.ket, dbo.mt_acc_erm.nama_pemeriksaan, dbo.tc_pemeriksaan_gizi.hasil2, dbo.mt_acc_erm.kd_kk, 
                      dbo.tc_pemeriksaan_gizi.ket, dbo.tc_kunjungan.no_mr, dbo.tc_registrasi.status_batal, dbo.tc_kunjungan.no_registrasi, dbo.tc_pemeriksaan_gizi.kode_pemeriksaan, 
                      dbo.tc_pemeriksaan_gizi.id_triase, dbo.tc_pemeriksaan_gizi.sekor, dbo.mt_acc_erm.sekor, dbo.mt_acc_erm.kd_EWS, dbo.mt_acc_erm.warna, dbo.tc_pemeriksaan_gizi.no_urut_ews, 
                      dbo.tc_pemeriksaan_gizi.no_urut, dbo.tc_emr_form.tgl_update, dbo.tc_pemeriksaan_gizi.kode_rm
HAVING      (dbo.tc_registrasi.status_batal IS NULL) AND (dbo.mt_acc_erm.kd_lev = 3)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_pemeriksaan_gizi_v]");
    }
};
