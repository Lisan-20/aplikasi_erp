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
        DB::statement("CREATE OR ALTER VIEW dbo.hitung_hasil_triase_v
AS
SELECT     dbo.tc_pemeriksaan_erm.id_triase, dbo.tc_pemeriksaan_erm.kode_pemeriksaan, dbo.mt_acc_erm.kd_ref, dbo.tc_pemeriksaan_erm.hasil, dbo.mt_acc_erm.kd_utama, 
                      dbo.mt_acc_erm.kd_golongan
FROM         dbo.tc_pemeriksaan_erm INNER JOIN
                      dbo.mt_acc_erm ON dbo.tc_pemeriksaan_erm.kode_pemeriksaan = dbo.mt_acc_erm.kd_periksa
WHERE     (dbo.tc_pemeriksaan_erm.id_triase IS NOT NULL) AND (dbo.tc_pemeriksaan_erm.kode_pemeriksaan LIKE '31%') AND (dbo.tc_pemeriksaan_erm.hasil >= '1')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [hitung_hasil_triase_v]");
    }
};
