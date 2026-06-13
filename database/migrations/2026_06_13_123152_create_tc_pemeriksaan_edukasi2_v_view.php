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
        DB::statement("CREATE VIEW dbo.tc_pemeriksaan_edukasi2_v
AS
SELECT     dbo.tc_edukasi_terpadu_det.kode_bagian, dbo.tc_edukasi_terpadu_det.no_kunjungan, dbo.tc_edukasi_terpadu_det.kd_lev, dbo.tc_edukasi_terpadu_det.kd_type, dbo.tc_edukasi_terpadu_det.hasil, 
                      dbo.mt_acc_erm.kd_ref, dbo.mt_acc_erm.ket, dbo.mt_acc_erm.nama_pemeriksaan, dbo.tc_edukasi_terpadu_det.hasil2, dbo.mt_acc_erm.kd_kk, dbo.tc_edukasi_terpadu_det.ket AS ket_hasil, 
                      dbo.tc_kunjungan.no_mr, dbo.tc_registrasi.status_batal, dbo.tc_kunjungan.no_registrasi, dbo.tc_edukasi_terpadu_det.kode_pemeriksaan, dbo.mt_acc_erm.sekor AS nilai_sekor, 
                      dbo.mt_acc_erm.kd_EWS, dbo.mt_acc_erm.warna
FROM         dbo.tc_edukasi_terpadu_det INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_edukasi_terpadu_det.no_kunjungan = dbo.tc_kunjungan.no_kunjungan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.mt_acc_erm ON dbo.tc_edukasi_terpadu_det.kode_pemeriksaan = dbo.mt_acc_erm.kd_periksa
GROUP BY dbo.tc_edukasi_terpadu_det.kode_bagian, dbo.tc_edukasi_terpadu_det.no_kunjungan, dbo.tc_edukasi_terpadu_det.kd_lev, dbo.tc_edukasi_terpadu_det.kd_type, 
                      dbo.tc_edukasi_terpadu_det.hasil, dbo.mt_acc_erm.kd_ref, dbo.mt_acc_erm.ket, dbo.mt_acc_erm.nama_pemeriksaan, dbo.tc_edukasi_terpadu_det.hasil2, dbo.mt_acc_erm.kd_kk, 
                      dbo.tc_edukasi_terpadu_det.ket, dbo.tc_kunjungan.no_mr, dbo.tc_registrasi.status_batal, dbo.tc_kunjungan.no_registrasi, dbo.tc_edukasi_terpadu_det.kode_pemeriksaan, dbo.mt_acc_erm.sekor, 
                      dbo.mt_acc_erm.kd_EWS, dbo.mt_acc_erm.warna
HAVING      (dbo.tc_edukasi_terpadu_det.kd_lev = 3) AND (dbo.tc_registrasi.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_pemeriksaan_edukasi2_v]");
    }
};
