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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_pemeriksaan_hamil_edit_v
AS
SELECT     dbo.mt_acc_erm.id_mt_kd, dbo.mt_acc_erm.kd_ref, dbo.mt_acc_erm.nama_pemeriksaan, dbo.mt_acc_erm.kd_lev, dbo.mt_acc_erm.kd_type, dbo.tc_riwayat_hamil_det.kode_pemeriksaan, 
                      dbo.tc_riwayat_hamil_det.no_kunjungan, dbo.tc_riwayat_hamil_det.no_registrasi, dbo.tc_riwayat_hamil_det.ket, dbo.tc_riwayat_hamil_det.hasil, dbo.tc_riwayat_hamil_det.hasil2, 
                      dbo.tc_riwayat_hamil_det.no_mr
FROM         dbo.tc_riwayat_hamil_det INNER JOIN
                      dbo.mt_acc_erm ON dbo.tc_riwayat_hamil_det.kode_pemeriksaan = dbo.mt_acc_erm.kd_periksa
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_pemeriksaan_hamil_edit_v]");
    }
};
