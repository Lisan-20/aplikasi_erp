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
        DB::statement("CREATE VIEW dbo.tc_pemeriksaan_erm_imp_v
AS
SELECT     dbo.tc_pemeriksaan_erm.id_mt_kd, dbo.tc_pemeriksaan_erm.kode_bagian, dbo.tc_pemeriksaan_erm.no_kunjungan, dbo.tc_pemeriksaan_erm.kd_lev, dbo.tc_pemeriksaan_erm.kd_type, 
                      dbo.tc_pemeriksaan_erm.hasil, dbo.mt_acc_erm_imp_v.kd_ref, dbo.mt_acc_erm_imp_v.ket, dbo.mt_acc_erm_imp_v.nama_pemeriksaan, dbo.tc_pemeriksaan_erm.hasil2, 
                      dbo.mt_acc_erm_imp_v.kd_kk, dbo.tc_pemeriksaan_erm.ket AS ket_hasil, dbo.tc_kunjungan.no_mr, dbo.tc_registrasi.status_batal, dbo.tc_kunjungan.no_registrasi, 
                      dbo.tc_pemeriksaan_erm.kode_pemeriksaan, dbo.tc_pemeriksaan_erm.id_triase, dbo.tc_pemeriksaan_erm.sekor AS hasil_sekor, dbo.mt_acc_erm_imp_v.sekor AS nilai_sekor, 
                      dbo.mt_acc_erm_imp_v.kd_EWS, dbo.mt_acc_erm_imp_v.warna, dbo.tc_pemeriksaan_erm.no_urut, dbo.mt_acc_erm_imp_v.nama_implementasi, dbo.tc_pemeriksaan_erm.kode_rm_inp
FROM         dbo.tc_pemeriksaan_erm INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_pemeriksaan_erm.no_kunjungan = dbo.tc_kunjungan.no_kunjungan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.mt_acc_erm_imp_v ON dbo.tc_pemeriksaan_erm.kode_pemeriksaan = dbo.mt_acc_erm_imp_v.kd_periksa
WHERE     (dbo.tc_pemeriksaan_erm.kd_lev = 3) AND (dbo.tc_registrasi.status_batal IS NULL) AND (dbo.tc_pemeriksaan_erm.hasil = '1')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_pemeriksaan_erm_imp_v]");
    }
};
