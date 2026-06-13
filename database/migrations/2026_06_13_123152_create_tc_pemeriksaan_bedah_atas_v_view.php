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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_pemeriksaan_bedah_atas_v
AS
SELECT     dbo.tc_pemeriksaan_bedah.kode_bagian, dbo.tc_pemeriksaan_bedah.no_kunjungan, dbo.tc_pemeriksaan_bedah.kode_pemeriksaan, dbo.tc_pemeriksaan_bedah.kd_lev, 
                      dbo.tc_pemeriksaan_bedah.hasil, dbo.mt_acc_erm_bedah.kd_ref, dbo.mt_acc_erm_bedah.ket, dbo.mt_acc_erm_bedah.nama_pemeriksaan, dbo.tc_pemeriksaan_bedah.hasil2, 
                      dbo.tc_pemeriksaan_bedah.ket AS ket_hasil, dbo.mt_acc_erm_bedah.kd_lev AS Expr1, dbo.mt_acc_erm_bedah.kd_type AS Expr2, dbo.mt_acc_erm_bedah.id_pen4an, 
                      dbo.mt_acc_erm_bedah.kd_periksa, dbo.tc_pemeriksaan_bedah.no_registrasi, dbo.tc_kunjungan.no_mr, dbo.tc_pemeriksaan_bedah.kode_tc_periksa, dbo.tc_pemeriksaan_bedah.no_urut_ews, 
                      dbo.tc_pemeriksaan_bedah.no_urut_entry, dbo.tc_pemeriksaan_bedah.no_urut
FROM         dbo.tc_pemeriksaan_bedah INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_pemeriksaan_bedah.no_kunjungan = dbo.tc_kunjungan.no_kunjungan INNER JOIN
                      dbo.mt_acc_erm_bedah ON dbo.tc_pemeriksaan_bedah.id_mt_kd = dbo.mt_acc_erm_bedah.id_mt_kd
GROUP BY dbo.tc_pemeriksaan_bedah.kode_bagian, dbo.tc_pemeriksaan_bedah.no_kunjungan, dbo.tc_pemeriksaan_bedah.kode_pemeriksaan, dbo.tc_pemeriksaan_bedah.kd_lev, 
                      dbo.tc_pemeriksaan_bedah.hasil, dbo.mt_acc_erm_bedah.kd_ref, dbo.mt_acc_erm_bedah.ket, dbo.mt_acc_erm_bedah.nama_pemeriksaan, dbo.tc_pemeriksaan_bedah.hasil2, 
                      dbo.tc_pemeriksaan_bedah.ket, dbo.mt_acc_erm_bedah.kd_lev, dbo.mt_acc_erm_bedah.kd_type, dbo.mt_acc_erm_bedah.id_pen4an, dbo.mt_acc_erm_bedah.kd_periksa, 
                      dbo.tc_pemeriksaan_bedah.no_registrasi, dbo.tc_kunjungan.no_mr, dbo.tc_pemeriksaan_bedah.kode_tc_periksa, dbo.tc_pemeriksaan_bedah.no_urut_ews, 
                      dbo.tc_pemeriksaan_bedah.no_urut_entry, dbo.tc_pemeriksaan_bedah.no_urut
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_pemeriksaan_bedah_atas_v]");
    }
};
