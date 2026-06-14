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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_pemeriksaan_gizi_atas_v
AS
SELECT     dbo.tc_pemeriksaan_gizi.kode_bagian, dbo.tc_pemeriksaan_gizi.no_kunjungan, dbo.tc_pemeriksaan_gizi.kode_pemeriksaan, dbo.tc_pemeriksaan_gizi.hasil, dbo.mt_acc_erm.kd_ref, 
                      dbo.mt_acc_erm.ket, dbo.mt_acc_erm.nama_pemeriksaan, dbo.tc_pemeriksaan_gizi.hasil2, dbo.tc_pemeriksaan_gizi.ket AS ket_hasil, dbo.mt_acc_erm.kd_lev, dbo.mt_acc_erm.kd_type, 
                      dbo.mt_acc_erm.id_pen4an, dbo.mt_acc_erm.kd_periksa, dbo.tc_pemeriksaan_gizi.no_registrasi, dbo.tc_kunjungan.no_mr, dbo.tc_pemeriksaan_gizi.kode_tc_periksa, 
                      dbo.tc_pemeriksaan_gizi.no_urut_ews, dbo.tc_pemeriksaan_gizi.no_urut_entry, dbo.tc_pemeriksaan_gizi.no_urut
FROM         dbo.tc_pemeriksaan_gizi INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_pemeriksaan_gizi.no_kunjungan = dbo.tc_kunjungan.no_kunjungan INNER JOIN
                      dbo.mt_acc_erm ON dbo.tc_pemeriksaan_gizi.id_mt_kd = dbo.mt_acc_erm.id_mt_kd
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_pemeriksaan_gizi_atas_v]");
    }
};
