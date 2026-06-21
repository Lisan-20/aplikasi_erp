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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_trans_pelayanan_HB_1_v
AS
SELECT     dbo.tc_trans_pelayanan_HB_v.kode_tarif, dbo.tc_trans_pelayanan_HB_v.kode_trans_pelayanan, dbo.pm_tc_hasilpenunjang.hasil, dbo.tc_trans_pelayanan_HB_v.no_registrasi, 
                      dbo.pm_tc_hasilpenunjang.kode_mt_hasilpm, dbo.pm_mt_standarhasil.nama_pemeriksaan, dbo.pm_tc_hasilpenunjang.waktu_sampel
FROM         dbo.tc_trans_pelayanan_HB_v INNER JOIN
                      dbo.pm_mt_standarhasil INNER JOIN
                      dbo.pm_tc_hasilpenunjang ON dbo.pm_mt_standarhasil.kode_mt_hasilpm = dbo.pm_tc_hasilpenunjang.kode_mt_hasilpm ON 
                      dbo.tc_trans_pelayanan_HB_v.kode_trans_pelayanan = dbo.pm_tc_hasilpenunjang.kode_trans_pelayanan AND dbo.tc_trans_pelayanan_HB_v.kode_tarif = dbo.pm_mt_standarhasil.kode_tarif
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_trans_pelayanan_HB_1_v]");
    }
};
