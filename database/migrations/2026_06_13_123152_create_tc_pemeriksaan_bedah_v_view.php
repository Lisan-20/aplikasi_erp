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
        DB::statement("CREATE VIEW dbo.tc_pemeriksaan_bedah_v
AS
SELECT dbo.tc_pemeriksaan_bedah.id_mt_kd, dbo.tc_pemeriksaan_bedah.kode_bagian, dbo.tc_pemeriksaan_bedah.no_kunjungan, dbo.mt_acc_erm_bedah.kd_lev, dbo.mt_acc_erm_bedah.kd_type, dbo.tc_pemeriksaan_bedah.hasil, dbo.mt_acc_erm_bedah.kd_ref, 
             dbo.mt_acc_erm_bedah.ket, dbo.mt_acc_erm_bedah.nama_pemeriksaan, dbo.tc_pemeriksaan_bedah.hasil2, dbo.mt_acc_erm_bedah.kd_kk, dbo.tc_pemeriksaan_bedah.ket AS ket_hasil, dbo.tc_pemeriksaan_bedah.kode_pemeriksaan, dbo.tc_pemeriksaan_bedah.id_triase, 
             dbo.tc_pemeriksaan_bedah.sekor AS hasil_sekor, dbo.mt_acc_erm_bedah.sekor AS nilai_sekor, dbo.mt_acc_erm_bedah.kd_EWS, dbo.mt_acc_erm_bedah.warna, dbo.tc_pemeriksaan_bedah.no_urut_ews, dbo.tc_pemeriksaan_bedah.no_urut, dbo.tc_pemeriksaan_bedah.tgl_update, 
             dbo.tc_pemeriksaan_bedah.no_registrasi
FROM   dbo.tc_pemeriksaan_bedah INNER JOIN
             dbo.mt_acc_erm_bedah ON dbo.tc_pemeriksaan_bedah.kode_pemeriksaan = dbo.mt_acc_erm_bedah.kd_periksa INNER JOIN
             dbo.tc_emr_form ON dbo.tc_pemeriksaan_bedah.kode_rm = dbo.tc_emr_form.kode_rm
GROUP BY dbo.tc_pemeriksaan_bedah.id_mt_kd, dbo.tc_pemeriksaan_bedah.kode_bagian, dbo.tc_pemeriksaan_bedah.no_kunjungan, dbo.mt_acc_erm_bedah.kd_lev, dbo.mt_acc_erm_bedah.kd_type, dbo.tc_pemeriksaan_bedah.hasil, dbo.mt_acc_erm_bedah.kd_ref, 
             dbo.mt_acc_erm_bedah.ket, dbo.mt_acc_erm_bedah.nama_pemeriksaan, dbo.tc_pemeriksaan_bedah.hasil2, dbo.mt_acc_erm_bedah.kd_kk, dbo.tc_pemeriksaan_bedah.ket, dbo.tc_pemeriksaan_bedah.kode_pemeriksaan, dbo.tc_pemeriksaan_bedah.id_triase, 
             dbo.tc_pemeriksaan_bedah.sekor, dbo.mt_acc_erm_bedah.sekor, dbo.mt_acc_erm_bedah.kd_EWS, dbo.mt_acc_erm_bedah.warna, dbo.tc_pemeriksaan_bedah.no_urut_ews, dbo.tc_pemeriksaan_bedah.no_urut, dbo.tc_pemeriksaan_bedah.tgl_update, 
             dbo.tc_pemeriksaan_bedah.no_registrasi
HAVING (dbo.mt_acc_erm_bedah.kd_lev = 3)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_pemeriksaan_bedah_v]");
    }
};
