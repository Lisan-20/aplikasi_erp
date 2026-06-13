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
        DB::statement("CREATE VIEW dbo.cppt_hasil_lab_v
AS
SELECT     dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.kode_bagian, dbo.pm_tc_hasilpenunjang.hasil, dbo.pm_tc_hasilpenunjang.keterangan, 
                      dbo.pm_mt_standarhasil.nama_pemeriksaan AS detail, dbo.tc_trans_pelayanan.nama_tindakan, dbo.pm_mt_standarhasil.standar_hasil_wanita, dbo.pm_mt_standarhasil.standar_hasil_pria, 
                      dbo.tc_trans_pelayanan.kode_trans_pelayanan, dbo.tc_trans_pelayanan.tgl_transaksi, dbo.pm_tc_hasilpenunjang.kode_tc_hasilpenunjang
FROM         dbo.pm_tc_hasilpenunjang INNER JOIN
                      dbo.pm_mt_standarhasil ON dbo.pm_tc_hasilpenunjang.kode_mt_hasilpm = dbo.pm_mt_standarhasil.kode_mt_hasilpm INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.pm_tc_hasilpenunjang.kode_trans_pelayanan = dbo.tc_trans_pelayanan.kode_trans_pelayanan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cppt_hasil_lab_v]");
    }
};
