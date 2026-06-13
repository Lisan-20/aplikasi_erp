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
        DB::statement("CREATE VIEW dbo.pm_tc_hasilpenunjang_new_v
AS
SELECT     dbo.pm_tc_hasilpenunjang.kode_trans_pelayanan, dbo.pm_tc_hasilpenunjang.keterangan, dbo.pm_mt_standarhasil.standar_hasil_pria, dbo.pm_mt_standarhasil.standar_hasil_wanita, 
                      dbo.pm_tc_hasilpenunjang.kode_mt_hasilpm, dbo.pm_tc_hasilpenunjang.hasil, dbo.pm_mt_standarhasil.nama_pemeriksaan
FROM         dbo.pm_mt_standarhasil INNER JOIN
                      dbo.pm_tc_hasilpenunjang ON dbo.pm_mt_standarhasil.kode_mt_hasilpm = dbo.pm_tc_hasilpenunjang.kode_mt_hasilpm
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pm_tc_hasilpenunjang_new_v]");
    }
};
