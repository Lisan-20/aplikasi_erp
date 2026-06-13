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
        DB::statement("CREATE VIEW dbo.tc_pemeriksaan_fisik_dok_lanjutan_v
AS
SELECT     dbo.tc_pemeriksaan_dokter_v.kode_pemeriksaan, dbo.tc_pemeriksaan_dokter_v.no_kunjungan, dbo.tc_pemeriksaan_dokter_v.kd_type, dbo.tc_pemeriksaan_dokter_v.nama_pemeriksaan, 
                      dbo.tc_pemeriksaan_dokter_v.no_registrasi, dbo.mt_acc_erm_det.value AS hasil, dbo.tc_pemeriksaan_dokter_v.kd_ref, dbo.tc_pemeriksaan_dokter_v.hasil AS hasil_ok
FROM         dbo.tc_pemeriksaan_dokter_v INNER JOIN
                      dbo.mt_acc_erm_det ON dbo.tc_pemeriksaan_dokter_v.hasil = dbo.mt_acc_erm_det.nama_pemeriksaan_det AND 
                      dbo.tc_pemeriksaan_dokter_v.kode_pemeriksaan = dbo.mt_acc_erm_det.kd_periksa
WHERE     (dbo.tc_pemeriksaan_dokter_v.kode_pemeriksaan >= N'80300') AND (dbo.tc_pemeriksaan_dokter_v.kode_pemeriksaan < N'80347') AND (dbo.mt_acc_erm_det.value = 2)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_pemeriksaan_fisik_dok_lanjutan_v]");
    }
};
