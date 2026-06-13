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
        DB::statement("CREATE VIEW dbo.tc_pemeriksaan_edit_v
AS
SELECT     dbo.tc_pemeriksaan_erm.kode_rm, dbo.tc_pemeriksaan_erm.kode_pemeriksaan, dbo.mt_acc_erm.id_mt_kd, dbo.mt_acc_erm.kd_ref, dbo.mt_acc_erm.nama_pemeriksaan, dbo.mt_acc_erm.kd_lev, 
                      dbo.mt_acc_erm.kd_type, dbo.mt_acc_erm.ket, dbo.mt_acc_erm.value_2, dbo.mt_acc_erm.kd_kk, dbo.mt_acc_erm.id_pen4an, dbo.mt_acc_erm.kd_EWS, dbo.mt_acc_erm.sekor, 
                      dbo.mt_acc_erm.warna, dbo.tc_pemeriksaan_erm.ket AS Expr1, dbo.tc_pemeriksaan_erm.hasil, dbo.tc_pemeriksaan_erm.no_kunjungan, dbo.tc_pemeriksaan_erm.kode_bagian, 
                      dbo.tc_pemeriksaan_erm.no_registrasi, dbo.tc_pemeriksaan_erm.no_mr, dbo.tc_pemeriksaan_erm.hasil2, dbo.mt_acc_erm.kd_periksa
FROM         dbo.tc_pemeriksaan_erm INNER JOIN
                      dbo.mt_acc_erm ON dbo.tc_pemeriksaan_erm.kode_pemeriksaan = dbo.mt_acc_erm.kd_periksa
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_pemeriksaan_edit_v]");
    }
};
