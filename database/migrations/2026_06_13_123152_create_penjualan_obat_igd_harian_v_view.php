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
        DB::statement("CREATE VIEW dbo.penjualan_obat_igd_harian_v
AS
SELECT     dbo.tc_trans_pelayanan.kode_barang AS kode_brg, dbo.tc_trans_pelayanan.nama_tindakan AS nama_brg, SUM(dbo.tc_trans_pelayanan.jumlah) 
                      AS jumlah, YEAR(dbo.tc_trans_pelayanan.tgl_transaksi) AS thn, MONTH(dbo.tc_trans_pelayanan.tgl_transaksi) AS bln, 
                      DAY(dbo.tc_trans_pelayanan.tgl_transaksi) AS tgl, SUM(dbo.tc_trans_pelayanan.bill_rs) AS bill_rs, dbo.mt_barang.satuan_kecil
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_barang ON dbo.tc_trans_pelayanan.kode_barang = dbo.mt_barang.kode_brg
WHERE     (dbo.tc_trans_pelayanan.kode_bagian = '020101') AND (dbo.tc_trans_pelayanan.jenis_tindakan = 9)
GROUP BY dbo.tc_trans_pelayanan.kode_barang, dbo.tc_trans_pelayanan.nama_tindakan, YEAR(dbo.tc_trans_pelayanan.tgl_transaksi), 
                      MONTH(dbo.tc_trans_pelayanan.tgl_transaksi), DAY(dbo.tc_trans_pelayanan.tgl_transaksi), dbo.mt_barang.satuan_kecil
HAVING      (dbo.tc_trans_pelayanan.kode_barang IS NOT NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [penjualan_obat_igd_harian_v]");
    }
};
