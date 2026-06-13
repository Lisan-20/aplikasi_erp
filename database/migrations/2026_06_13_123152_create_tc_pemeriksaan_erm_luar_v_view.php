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
        DB::statement("CREATE VIEW dbo.tc_pemeriksaan_erm_luar_v
AS
SELECT     dbo.tc_pemeriksaan_luar.id_mt_kd, dbo.tc_pemeriksaan_luar.kode_bagian, dbo.tc_pemeriksaan_luar.no_kunjungan, dbo.tc_pemeriksaan_luar.kd_lev, dbo.tc_pemeriksaan_luar.kd_type, 
                      dbo.tc_pemeriksaan_luar.hasil, dbo.mt_acc_erm.kd_ref, dbo.mt_acc_erm.ket, dbo.mt_acc_erm.nama_pemeriksaan, dbo.tc_pemeriksaan_luar.hasil2, dbo.mt_acc_erm.kd_kk, 
                      dbo.tc_pemeriksaan_luar.ket AS ket_hasil, dbo.tc_pemeriksaan_luar.kode_pemeriksaan, dbo.mt_acc_erm.kd_EWS, dbo.tc_pemeriksaan_luar.no_registrasi, 
                      dbo.tc_pemeriksaan_luar.sekor AS hasil_sekor, dbo.mt_acc_erm.sekor AS point, dbo.tc_pemeriksaan_luar.id_luar
FROM         dbo.tc_pemeriksaan_luar INNER JOIN
                      dbo.mt_acc_erm ON dbo.tc_pemeriksaan_luar.kode_pemeriksaan = dbo.mt_acc_erm.kd_periksa
WHERE     (dbo.tc_pemeriksaan_luar.kd_lev = 3)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_pemeriksaan_erm_luar_v]");
    }
};
