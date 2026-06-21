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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_acc_erm_imp_v
AS
SELECT     dbo.mt_acc_erm.id_mt_kd, dbo.mt_acc_erm.kd_periksa, dbo.mt_acc_erm.kd_ref, dbo.mt_acc_erm.nama_pemeriksaan, dbo.mt_acc_erm.kd_lev, dbo.mt_acc_erm.kd_type, 
                      dbo.mt_acc_erm.kd_utama, dbo.mt_acc_erm.kd_golongan, dbo.mt_acc_erm.kode_akun_detail, dbo.mt_acc_erm.ket, dbo.mt_acc_erm.value_2, dbo.mt_acc_erm.value_3, dbo.mt_acc_erm.kd_kk, 
                      dbo.mt_acc_erm.no_urut, dbo.mt_acc_erm.id_pen4an, dbo.mt_acc_erm.kd_periksa_awal, dbo.mt_acc_erm.kd_EWS, dbo.mt_acc_erm.sekor, dbo.mt_acc_erm.warna, 
                      dbo.mt_acc_erm_imp.nama_implementasi
FROM         dbo.mt_acc_erm INNER JOIN
                      dbo.mt_acc_erm_imp ON dbo.mt_acc_erm.kd_periksa = dbo.mt_acc_erm_imp.kd_periksa
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_acc_erm_imp_v]");
    }
};
