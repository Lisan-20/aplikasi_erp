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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_pemeriksaan_erm_triase_v
AS
SELECT     dbo.tc_pemeriksaan_erm.id_mt_kd, dbo.tc_pemeriksaan_erm.kode_bagian, dbo.tc_pemeriksaan_erm.no_kunjungan, dbo.tc_pemeriksaan_erm.kd_lev, dbo.tc_pemeriksaan_erm.kd_type, 
                      dbo.tc_pemeriksaan_erm.hasil, dbo.mt_acc_erm.kd_ref, dbo.mt_acc_erm.ket, dbo.mt_acc_erm.nama_pemeriksaan, dbo.tc_pemeriksaan_erm.hasil2, dbo.mt_acc_erm.kd_kk, 
                      dbo.tc_pemeriksaan_erm.ket AS ket_hasil, dbo.tc_pemeriksaan_erm.kode_pemeriksaan, dbo.tc_pemeriksaan_erm.id_triase, dbo.mt_acc_erm.kd_EWS, dbo.tc_pemeriksaan_erm.no_registrasi, 
                      dbo.tc_pemeriksaan_erm.sekor AS hasil_sekor, dbo.mt_acc_erm.sekor AS point, dbo.tc_pemeriksaan_erm.no_urut
FROM         dbo.tc_pemeriksaan_erm INNER JOIN
                      dbo.mt_acc_erm ON dbo.tc_pemeriksaan_erm.kode_pemeriksaan = dbo.mt_acc_erm.kd_periksa
GROUP BY dbo.tc_pemeriksaan_erm.id_mt_kd, dbo.tc_pemeriksaan_erm.kode_bagian, dbo.tc_pemeriksaan_erm.no_kunjungan, dbo.tc_pemeriksaan_erm.kd_lev, dbo.tc_pemeriksaan_erm.kd_type, 
                      dbo.tc_pemeriksaan_erm.hasil, dbo.mt_acc_erm.kd_ref, dbo.mt_acc_erm.ket, dbo.mt_acc_erm.nama_pemeriksaan, dbo.tc_pemeriksaan_erm.hasil2, dbo.mt_acc_erm.kd_kk, 
                      dbo.tc_pemeriksaan_erm.ket, dbo.tc_pemeriksaan_erm.kode_pemeriksaan, dbo.tc_pemeriksaan_erm.id_triase, dbo.mt_acc_erm.kd_EWS, dbo.tc_pemeriksaan_erm.no_registrasi, 
                      dbo.tc_pemeriksaan_erm.sekor, dbo.mt_acc_erm.sekor, dbo.tc_pemeriksaan_erm.no_urut
HAVING      (dbo.tc_pemeriksaan_erm.kd_lev = 3)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_pemeriksaan_erm_triase_v]");
    }
};
