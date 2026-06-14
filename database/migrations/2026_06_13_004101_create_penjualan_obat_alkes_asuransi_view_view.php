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
        DB::statement("CREATE OR ALTER VIEW dbo.penjualan_obat_alkes_asuransi_view
AS
SELECT     TOP (100) PERCENT dbo.tc_trans_pelayanan.kode_barang, dbo.tc_trans_pelayanan.nama_tindakan, MONTH(dbo.tc_trans_kasir.tgl_jam) AS bulan, 
                      SUM((CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * CAST(dbo.tc_trans_pelayanan.bill_rs_jatah AS int)) AS harga_jual, YEAR(dbo.tc_trans_kasir.tgl_jam) 
                      AS tahun, SUM(dbo.fr_tc_far_detail.harga_beli * dbo.tc_trans_pelayanan.jumlah) AS harga_beli
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir INNER JOIN
                      dbo.mt_rekap_stok ON dbo.tc_trans_pelayanan.kode_barang = dbo.mt_rekap_stok.kode_brg INNER JOIN
                      dbo.fr_tc_far_detail ON dbo.tc_trans_pelayanan.kd_tr_resep = dbo.fr_tc_far_detail.kd_tr_resep
GROUP BY dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.kode_barang, MONTH(dbo.tc_trans_kasir.tgl_jam), dbo.mt_rekap_stok.harga_beli, 
                      dbo.mt_rekap_stok.kode_bagian_gudang, dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.nama_tindakan, YEAR(dbo.tc_trans_kasir.tgl_jam), 
                      dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.flag_jurnal, dbo.fr_tc_far_detail.harga_beli
HAVING      (dbo.tc_trans_pelayanan.jenis_tindakan IN (11)) AND (dbo.tc_trans_pelayanan.kode_kelompok IN (3)) AND (dbo.mt_rekap_stok.kode_bagian_gudang = '060101') AND 
                      (dbo.tc_trans_pelayanan.kode_tc_trans_kasir > 0) AND (dbo.tc_trans_pelayanan.flag_jurnal = 1)
ORDER BY bulan, tahun
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [penjualan_obat_alkes_asuransi_view]");
    }
};
