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
        DB::statement("CREATE VIEW dbo.tc_pemeriksaan_mpp_v
AS
SELECT     dbo.tc_pemeriksaan_mpp.id_mt_kd, dbo.tc_pemeriksaan_mpp.kode_bagian, dbo.tc_pemeriksaan_mpp.no_kunjungan, dbo.mt_acc_erm.kd_lev, dbo.tc_pemeriksaan_mpp.hasil, 
                      dbo.mt_acc_erm.kd_ref, dbo.mt_acc_erm.ket, dbo.mt_acc_erm.nama_pemeriksaan, dbo.tc_pemeriksaan_mpp.hasil2, dbo.mt_acc_erm.kd_kk, dbo.tc_pemeriksaan_mpp.ket AS ket_hasil, 
                      dbo.tc_kunjungan.no_mr, dbo.tc_registrasi.status_batal, dbo.tc_kunjungan.no_registrasi, dbo.tc_pemeriksaan_mpp.kode_pemeriksaan, dbo.tc_pemeriksaan_mpp.id_triase, 
                      dbo.mt_acc_erm.sekor AS nilai_sekor, dbo.tc_pemeriksaan_mpp.sekor AS hasil_sekor, dbo.tc_pemeriksaan_mpp.no_urut, dbo.mt_acc_erm.kd_type
FROM         dbo.tc_pemeriksaan_mpp INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_pemeriksaan_mpp.no_kunjungan = dbo.tc_kunjungan.no_kunjungan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.mt_acc_erm ON dbo.tc_pemeriksaan_mpp.kode_pemeriksaan = dbo.mt_acc_erm.kd_periksa
GROUP BY dbo.tc_pemeriksaan_mpp.id_mt_kd, dbo.tc_pemeriksaan_mpp.kode_bagian, dbo.tc_pemeriksaan_mpp.no_kunjungan, dbo.mt_acc_erm.kd_lev, dbo.tc_pemeriksaan_mpp.hasil, 
                      dbo.mt_acc_erm.kd_ref, dbo.mt_acc_erm.ket, dbo.mt_acc_erm.nama_pemeriksaan, dbo.tc_pemeriksaan_mpp.hasil2, dbo.mt_acc_erm.kd_kk, dbo.tc_pemeriksaan_mpp.ket, dbo.tc_kunjungan.no_mr, 
                      dbo.tc_registrasi.status_batal, dbo.tc_kunjungan.no_registrasi, dbo.tc_pemeriksaan_mpp.kode_pemeriksaan, dbo.tc_pemeriksaan_mpp.id_triase, dbo.mt_acc_erm.sekor, 
                      dbo.tc_pemeriksaan_mpp.sekor, dbo.tc_pemeriksaan_mpp.no_urut, dbo.mt_acc_erm.kd_type
HAVING      (dbo.tc_registrasi.status_batal IS NULL) AND (dbo.mt_acc_erm.kd_lev = 3)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_pemeriksaan_mpp_v]");
    }
};
