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
        DB::statement("CREATE VIEW dbo.tc_pemeriksaan_edukasi_atas_v
AS
SELECT     dbo.tc_edukasi_terpadu_det.kode_pemeriksaan, dbo.tc_edukasi_terpadu_det.kd_lev, dbo.tc_edukasi_terpadu_det.hasil, dbo.mt_acc_erm.kd_ref, dbo.mt_acc_erm.ket, 
                      dbo.mt_acc_erm.nama_pemeriksaan, dbo.tc_edukasi_terpadu_det.hasil2, dbo.tc_edukasi_terpadu_det.ket AS ket_hasil, dbo.mt_acc_erm.kd_lev AS Expr1, dbo.mt_acc_erm.kd_type AS Expr2, 
                      dbo.mt_acc_erm.id_pen4an, dbo.mt_acc_erm.kd_periksa, dbo.tc_edukasi_terpadu_det.no_registrasi, dbo.tc_kunjungan.no_mr, dbo.tc_edukasi_terpadu_det.no_urut_edukasi
FROM         dbo.tc_edukasi_terpadu_det INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_edukasi_terpadu_det.no_kunjungan = dbo.tc_kunjungan.no_kunjungan INNER JOIN
                      dbo.mt_acc_erm ON dbo.tc_edukasi_terpadu_det.kode_pemeriksaan = dbo.mt_acc_erm.kd_periksa
GROUP BY dbo.tc_edukasi_terpadu_det.kode_pemeriksaan, dbo.tc_edukasi_terpadu_det.kd_lev, dbo.tc_edukasi_terpadu_det.hasil, dbo.mt_acc_erm.kd_ref, dbo.mt_acc_erm.ket, 
                      dbo.mt_acc_erm.nama_pemeriksaan, dbo.tc_edukasi_terpadu_det.hasil2, dbo.tc_edukasi_terpadu_det.ket, dbo.mt_acc_erm.kd_lev, dbo.mt_acc_erm.kd_type, dbo.mt_acc_erm.id_pen4an, 
                      dbo.mt_acc_erm.kd_periksa, dbo.tc_edukasi_terpadu_det.no_registrasi, dbo.tc_kunjungan.no_mr, dbo.tc_edukasi_terpadu_det.no_urut_edukasi
HAVING      (dbo.mt_acc_erm.kd_lev = 2)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_pemeriksaan_edukasi_atas_v]");
    }
};
