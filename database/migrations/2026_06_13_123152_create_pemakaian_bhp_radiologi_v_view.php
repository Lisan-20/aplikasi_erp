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
        DB::statement("CREATE VIEW dbo.pemakaian_bhp_radiologi_v
AS
SELECT     dbo.pm_tc_obalkes.kode_brg, dbo.mt_rekap_stok.harga_beli, dbo.pm_tc_obalkes.volume, MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) AS bulan
FROM         dbo.pm_tc_obalkes INNER JOIN
                      dbo.pm_tc_penunjang ON dbo.pm_tc_obalkes.kode_penunjang = dbo.pm_tc_penunjang.kode_penunjang INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.pm_tc_penunjang.kode_penunjang = dbo.tc_trans_pelayanan.kode_penunjang INNER JOIN
                      dbo.mt_rekap_stok ON dbo.pm_tc_obalkes.kode_brg = dbo.mt_rekap_stok.kode_brg
WHERE     (dbo.tc_trans_pelayanan.kode_tc_trans_kasir > 0) AND (dbo.pm_tc_penunjang.status_batal IS NULL) AND (MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) BETWEEN 
                      7 AND 9) AND (dbo.mt_rekap_stok.kode_bagian_gudang = '060101') AND (dbo.pm_tc_obalkes.kode_brg = 'D01A01101')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pemakaian_bhp_radiologi_v]");
    }
};
