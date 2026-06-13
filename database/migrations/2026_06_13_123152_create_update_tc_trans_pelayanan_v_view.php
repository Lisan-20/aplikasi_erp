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
        DB::statement("CREATE OR ALTER VIEW dbo.update_tc_trans_pelayanan_v
AS
SELECT     dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.bill_rs, dbo.mt_master_tarif_detail.bill_rs AS rs, dbo.tc_trans_pelayanan.kode_tarif, 
                      dbo.tc_trans_pelayanan.tgl_transaksi, DAY(dbo.tc_trans_pelayanan.tgl_transaksi) AS Expr2
FROM         dbo.mt_master_tarif_detail INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.mt_master_tarif_detail.kode_tarif = dbo.tc_trans_pelayanan.kode_tarif
WHERE     (dbo.tc_trans_pelayanan.nama_tindakan LIKE 'admin%') AND (dbo.tc_trans_pelayanan.bill_rs = 0) AND (DAY(dbo.tc_trans_pelayanan.tgl_transaksi) = 22)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_tc_trans_pelayanan_v]");
    }
};
