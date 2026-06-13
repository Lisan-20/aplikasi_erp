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
        DB::statement("CREATE VIEW dbo.ref_harga_umd_nm_v
AS
SELECT     dbo.transaksi_umd_detail.kode_brg, dbo.transaksi_umd_detail.harga_satuan, dbo.transaksi_umd_detail.harga_satuan_netto, DAY(dbo.transaksi_umd.tgl_transaksi) AS tgl, 
                      MONTH(dbo.transaksi_umd.tgl_transaksi) AS bln, YEAR(dbo.transaksi_umd.tgl_transaksi) AS thn, dbo.transaksi_umd.tgl_transaksi
FROM         dbo.transaksi_umd INNER JOIN
                      dbo.transaksi_umd_detail ON dbo.transaksi_umd.id_trans_umd = dbo.transaksi_umd_detail.id_trans_umd
WHERE     (dbo.transaksi_umd.kode_bagian IN ('070201', '070101'))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ref_harga_umd_nm_v]");
    }
};
