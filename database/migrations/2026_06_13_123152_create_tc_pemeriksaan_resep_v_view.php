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
        DB::statement("CREATE VIEW dbo.tc_pemeriksaan_resep_v
AS
SELECT     dbo.tc_pemeriksaan_resep.id_mt_kd, dbo.tc_pemeriksaan_resep.kode_bagian, dbo.tc_pemeriksaan_resep.no_kunjungan, dbo.tc_pemeriksaan_resep.kd_lev, dbo.tc_pemeriksaan_resep.kd_type, 
                      dbo.tc_pemeriksaan_resep.hasil, dbo.mt_acc_erm.kd_ref, dbo.mt_acc_erm.ket, dbo.mt_acc_erm.nama_pemeriksaan, dbo.tc_pemeriksaan_resep.hasil2, dbo.mt_acc_erm.kd_kk, 
                      dbo.tc_pemeriksaan_resep.ket AS ket_hasil, dbo.tc_pemeriksaan_resep.kode_pemeriksaan, dbo.tc_pemeriksaan_resep.id_triase, dbo.tc_pemeriksaan_resep.sekor AS hasil_sekor, 
                      dbo.mt_acc_erm.sekor AS nilai_sekor, dbo.mt_acc_erm.kd_EWS, dbo.mt_acc_erm.warna, dbo.tc_pemeriksaan_resep.kode_trans_far
FROM         dbo.tc_pemeriksaan_resep INNER JOIN
                      dbo.mt_acc_erm ON dbo.tc_pemeriksaan_resep.kode_pemeriksaan = dbo.mt_acc_erm.kd_periksa
WHERE     (dbo.tc_pemeriksaan_resep.kd_lev = 3)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_pemeriksaan_resep_v]");
    }
};
