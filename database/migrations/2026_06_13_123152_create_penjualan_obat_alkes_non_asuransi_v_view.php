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
        DB::statement("CREATE VIEW dbo.penjualan_obat_alkes_non_asuransi_v
AS
SELECT     TOP (100) PERCENT dbo.tc_trans_pelayanan.kode_barang, dbo.mt_barang.nama_brg, MONTH(dbo.tc_trans_kasir.tgl_jam) AS bulan, 
                      (CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * CAST(dbo.tc_trans_pelayanan.bill_rs AS int) AS harga_jual, YEAR(dbo.tc_trans_kasir.tgl_jam) AS tahun, 
                      dbo.fr_tc_far_detail.harga_beli * dbo.tc_trans_pelayanan.jumlah AS harga_beli, dbo.tc_trans_pelayanan.bill_rs
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir INNER JOIN
                      dbo.mt_barang ON dbo.tc_trans_pelayanan.kode_barang = dbo.mt_barang.kode_brg INNER JOIN
                      dbo.mt_rekap_stok ON dbo.tc_trans_pelayanan.kode_barang = dbo.mt_rekap_stok.kode_brg INNER JOIN
                      dbo.fr_tc_far_detail ON dbo.tc_trans_pelayanan.kd_tr_resep = dbo.fr_tc_far_detail.kd_tr_resep
WHERE     (dbo.tc_trans_pelayanan.jenis_tindakan IN (11)) AND (dbo.tc_trans_pelayanan.kode_kelompok IN (1, 5, 6, 7, 8)) AND 
                      (dbo.mt_rekap_stok.kode_bagian_gudang = '060101') AND (dbo.tc_trans_pelayanan.kode_barang <> 'D38A0186') AND (dbo.tc_trans_pelayanan.bill_rs > 0)
ORDER BY dbo.tc_trans_pelayanan.kode_barang, bulan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [penjualan_obat_alkes_non_asuransi_v]");
    }
};
