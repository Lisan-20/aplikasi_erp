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
        DB::statement("CREATE VIEW dbo.pm_tc_hasilpenunjang_new2_v
AS
SELECT     dbo.pm_tc_hasilpenunjang.kode_trans_pelayanan, dbo.pm_tc_hasilpenunjang.keterangan, dbo.pm_tc_hasilpenunjang.kode_mt_hasilpm, dbo.pm_tc_hasilpenunjang.hasil, 
                      dbo.tc_trans_pelayanan_temp.no_mr, dbo.tc_trans_pelayanan_temp.no_registrasi, dbo.tc_trans_pelayanan_temp.nama_tindakan, dbo.pm_mt_standarhasil.nama_pemeriksaan, 
                      dbo.pm_mt_standarhasil.standar_hasil_wanita, dbo.pm_mt_standarhasil.standar_hasil_pria, dbo.tc_trans_pelayanan_temp.kode_penunjang, dbo.tc_trans_pelayanan_temp.tgl_transaksi
FROM         dbo.pm_tc_hasilpenunjang INNER JOIN
                      dbo.tc_trans_pelayanan_temp ON dbo.pm_tc_hasilpenunjang.kode_trans_pelayanan = dbo.tc_trans_pelayanan_temp.kode_trans_pelayanan INNER JOIN
                      dbo.pm_mt_standarhasil ON dbo.pm_tc_hasilpenunjang.kode_mt_hasilpm = dbo.pm_mt_standarhasil.kode_mt_hasilpm
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pm_tc_hasilpenunjang_new2_v]");
    }
};
