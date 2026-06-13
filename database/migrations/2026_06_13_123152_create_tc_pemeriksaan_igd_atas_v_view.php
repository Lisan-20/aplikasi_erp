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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_pemeriksaan_igd_atas_v
AS
SELECT     dbo.tc_pemeriksaan_igd.kode_tc_periksa, dbo.tc_pemeriksaan_igd.id_mt_kd, dbo.tc_pemeriksaan_igd.kode_bagian, dbo.tc_pemeriksaan_igd.no_kunjungan, 
                      dbo.tc_pemeriksaan_igd.kode_pemeriksaan, dbo.tc_pemeriksaan_igd.kd_lev, dbo.tc_pemeriksaan_igd.kd_type, dbo.tc_pemeriksaan_igd.hasil, dbo.mt_acc_erm.kd_ref, dbo.mt_acc_erm.ket, 
                      dbo.mt_acc_erm.nama_pemeriksaan, dbo.tc_pemeriksaan_igd.hasil2, dbo.mt_acc_erm.kd_kk, dbo.tc_pemeriksaan_igd.ket AS ket_hasil, dbo.mt_acc_erm.kd_lev AS Expr1, 
                      dbo.mt_acc_erm.kd_type AS Expr2, dbo.mt_acc_erm.id_pen4an, dbo.mt_acc_erm.kd_periksa, dbo.tc_pemeriksaan_igd.no_registrasi, dbo.tc_kunjungan.no_mr
FROM         dbo.tc_pemeriksaan_igd INNER JOIN
                      dbo.mt_acc_erm ON dbo.tc_pemeriksaan_igd.kode_pemeriksaan = dbo.mt_acc_erm.kd_periksa INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_pemeriksaan_igd.no_kunjungan = dbo.tc_kunjungan.no_kunjungan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_pemeriksaan_igd_atas_v]");
    }
};
