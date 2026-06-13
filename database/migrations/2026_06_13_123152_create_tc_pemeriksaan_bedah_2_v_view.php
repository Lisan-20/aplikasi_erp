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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_pemeriksaan_bedah_2_v
AS
SELECT     dbo.tc_pemeriksaan_perawat.id_mt_kd, dbo.tc_pemeriksaan_perawat.kode_bagian, dbo.tc_pemeriksaan_perawat.no_kunjungan, dbo.tc_pemeriksaan_perawat.kode_pemeriksaan, 
                      dbo.tc_pemeriksaan_perawat.ket, dbo.tc_pemeriksaan_perawat.hasil2, dbo.tc_pemeriksaan_perawat.hasil, dbo.tc_pemeriksaan_perawat.no_registrasi, dbo.mt_acc_erm.kd_ref, 
                      dbo.mt_acc_erm.nama_pemeriksaan, dbo.mt_acc_erm.kd_lev, dbo.mt_acc_erm.kd_type, dbo.mt_acc_erm.ket AS Expr1, dbo.mt_acc_erm.kd_kk, dbo.mt_acc_erm.kd_EWS, dbo.mt_acc_erm.sekor, 
                      dbo.mt_acc_erm.warna
FROM         dbo.tc_pemeriksaan_perawat INNER JOIN
                      dbo.mt_acc_erm ON dbo.tc_pemeriksaan_perawat.kode_pemeriksaan = dbo.mt_acc_erm.kd_periksa
GROUP BY dbo.tc_pemeriksaan_perawat.id_mt_kd, dbo.tc_pemeriksaan_perawat.kode_bagian, dbo.tc_pemeriksaan_perawat.no_kunjungan, dbo.tc_pemeriksaan_perawat.kode_pemeriksaan, 
                      dbo.tc_pemeriksaan_perawat.ket, dbo.tc_pemeriksaan_perawat.hasil2, dbo.tc_pemeriksaan_perawat.hasil, dbo.tc_pemeriksaan_perawat.no_registrasi, dbo.mt_acc_erm.kd_ref, 
                      dbo.mt_acc_erm.nama_pemeriksaan, dbo.mt_acc_erm.kd_lev, dbo.mt_acc_erm.kd_type, dbo.mt_acc_erm.ket, dbo.mt_acc_erm.kd_kk, dbo.mt_acc_erm.kd_EWS, dbo.mt_acc_erm.sekor, 
                      dbo.mt_acc_erm.warna
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_pemeriksaan_bedah_2_v]");
    }
};
