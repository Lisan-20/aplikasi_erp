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
        DB::statement("CREATE VIEW dbo.lap_rekap_anggaran_far_v
AS
SELECT     dbo.fr_tc_far_detail.kode_brg, dbo.fr_tc_far_detail.jumlah_tebus AS tebus, dbo.fr_tc_far_detail.jumlah_pesan AS pesan, MONTH(dbo.fr_tc_far.tgl_trans) AS bln, 
                      YEAR(dbo.fr_tc_far.tgl_trans) AS thn, dbo.fr_tc_far_detail.jumlah_retur AS retur, CASE WHEN (dbo.fr_tc_far_detail.jumlah_retur) 
                      > 0 THEN (dbo.fr_tc_far_detail.jumlah_tebus) - (dbo.fr_tc_far_detail.jumlah_retur) ELSE (dbo.fr_tc_far_detail.jumlah_tebus) END AS real, 
                      dbo.mt_barang.nama_brg
FROM         dbo.fr_tc_far INNER JOIN
                      dbo.fr_tc_far_detail ON dbo.fr_tc_far.kode_trans_far = dbo.fr_tc_far_detail.kode_trans_far INNER JOIN
                      dbo.mt_barang ON dbo.fr_tc_far_detail.kode_brg = dbo.mt_barang.kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_rekap_anggaran_far_v]");
    }
};
