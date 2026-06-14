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
        DB::statement("
CREATE OR ALTER VIEW [dbo].[tc_cppt_transfusi_atas_v]
AS
SELECT        dbo.tc_cppt_transfusi_detail.id_mt_kd, dbo.tc_cppt_transfusi_detail.kode_bagian, dbo.tc_cppt_transfusi_detail.no_kunjungan, dbo.tc_cppt_transfusi_detail.kode_pemeriksaan, dbo.tc_cppt_transfusi_detail.kd_lev, 
                         dbo.tc_cppt_transfusi_detail.kd_type, dbo.tc_cppt_transfusi_detail.hasil, dbo.mt_acc_erm.kd_ref, dbo.mt_acc_erm.ket, dbo.mt_acc_erm.nama_pemeriksaan, dbo.tc_cppt_transfusi_detail.hasil2, dbo.mt_acc_erm.kd_kk, 
                         dbo.tc_cppt_transfusi_detail.ket AS ket_hasil, dbo.mt_acc_erm.kd_lev AS Expr1, dbo.mt_acc_erm.kd_type AS Expr2, dbo.mt_acc_erm.id_pen4an, dbo.mt_acc_erm.kd_periksa, dbo.tc_cppt_transfusi_detail.no_registrasi
FROM            dbo.tc_cppt_transfusi_detail INNER JOIN
                         dbo.mt_acc_erm ON dbo.tc_cppt_transfusi_detail.kode_pemeriksaan = dbo.mt_acc_erm.kd_periksa
GROUP BY dbo.tc_cppt_transfusi_detail.id_mt_kd, dbo.tc_cppt_transfusi_detail.kode_bagian, dbo.tc_cppt_transfusi_detail.no_kunjungan, dbo.tc_cppt_transfusi_detail.kode_pemeriksaan, dbo.tc_cppt_transfusi_detail.kd_lev, 
                         dbo.tc_cppt_transfusi_detail.kd_type, dbo.tc_cppt_transfusi_detail.hasil, dbo.mt_acc_erm.kd_ref, dbo.mt_acc_erm.ket, dbo.mt_acc_erm.nama_pemeriksaan, dbo.tc_cppt_transfusi_detail.hasil2, dbo.mt_acc_erm.kd_kk, 
                         dbo.tc_cppt_transfusi_detail.ket, dbo.mt_acc_erm.kd_lev, dbo.mt_acc_erm.kd_type, dbo.mt_acc_erm.id_pen4an, dbo.mt_acc_erm.kd_periksa, dbo.tc_cppt_transfusi_detail.no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_cppt_transfusi_atas_v]");
    }
};
