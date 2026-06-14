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
        DB::statement("CREATE OR ALTER VIEW dbo.update_harga_beli_trans_pelayanan_v
AS
SELECT     dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.harga_beli, dbo.tc_trans_pelayanan.kode_barang, 
                      dbo.mt_rekap_stok.harga_beli * dbo.tc_trans_pelayanan.jumlah AS harga_beli_stok, dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.jumlah, 
                      dbo.tc_trans_pelayanan.tgl_transaksi
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_rekap_stok ON dbo.tc_trans_pelayanan.kode_barang = dbo.mt_rekap_stok.kode_brg
WHERE     (dbo.tc_trans_pelayanan.harga_beli IS NULL) AND (dbo.tc_trans_pelayanan.jenis_tindakan = 9) AND (dbo.mt_rekap_stok.kode_bagian_gudang = '060101') AND 
                      (MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) >= 6) AND (dbo.tc_trans_pelayanan.bill_rs > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_harga_beli_trans_pelayanan_v]");
    }
};
