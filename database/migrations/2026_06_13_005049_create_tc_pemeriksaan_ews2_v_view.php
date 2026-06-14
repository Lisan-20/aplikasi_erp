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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_pemeriksaan_ews2_v
AS
SELECT     TOP (100) PERCENT dbo.tc_pemeriksaan_ews.no_urut_ews, dbo.tc_pemeriksaan_ews.no_registrasi, dbo.tc_pemeriksaan_ews.user_id, dbo.tc_pemeriksaan_ews.tgl_jam, 
                      dbo.tc_pemeriksaan_ews_det.hasil, dbo.mt_acc_erm.kd_EWS, dbo.mt_acc_erm.sekor, dbo.tc_pemeriksaan_ews.no_kunjungan, dbo.tc_pemeriksaan_ews_det.kd_EWS_lev3 AS kode_pemeriksaan, 
                      dbo.tc_pemeriksaan_ews_det.warna AS warna_hasil, dbo.tc_pemeriksaan_ews_det.kode_tc_periksa, dbo.tc_pemeriksaan_ews_det.skor, dbo.tc_pemeriksaan_ews_det.kd_type, 
                      dbo.tc_pemeriksaan_ews.jenis, dbo.tc_pemeriksaan_ews_det.hasil AS hasil_x
FROM         dbo.tc_pemeriksaan_ews INNER JOIN
                      dbo.tc_pemeriksaan_ews_det ON dbo.tc_pemeriksaan_ews.no_urut_ews = dbo.tc_pemeriksaan_ews_det.no_urut_ews INNER JOIN
                      dbo.mt_acc_erm ON dbo.tc_pemeriksaan_ews_det.kd_EWS_lev3 = dbo.mt_acc_erm.kd_periksa
WHERE     (dbo.tc_pemeriksaan_ews.jenis = 2)
ORDER BY dbo.tc_pemeriksaan_ews_det.kode_tc_periksa
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_pemeriksaan_ews2_v]");
    }
};
