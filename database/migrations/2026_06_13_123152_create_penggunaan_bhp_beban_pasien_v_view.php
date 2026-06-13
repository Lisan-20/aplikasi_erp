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
        DB::statement("CREATE VIEW dbo.penggunaan_bhp_beban_pasien_v
AS
SELECT     dbo.tc_trans_pelayanan.kode_barang, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.mt_barang.satuan_kecil, 
                      SUM(dbo.tc_trans_pelayanan.jumlah) AS jumlah, dbo.mt_barang.nama_brg, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, 
                      dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.mt_bagian.nama_bagian, dbo.tc_trans_pelayanan.tgl_transaksi
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_barang ON dbo.tc_trans_pelayanan.kode_barang = dbo.mt_barang.kode_brg INNER JOIN
                      dbo.mt_bagian ON dbo.tc_trans_pelayanan.kode_bagian = dbo.mt_bagian.kode_bagian
GROUP BY dbo.tc_trans_pelayanan.kode_barang, dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.mt_barang.satuan_kecil, 
                      dbo.mt_barang.nama_brg, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, 
                      dbo.mt_bagian.nama_bagian, dbo.tc_trans_pelayanan.tgl_transaksi
HAVING      (dbo.tc_trans_pelayanan.kode_barang IS NOT NULL) AND (NOT (dbo.tc_trans_pelayanan.kode_bagian IN ('060102', '060101'))) AND 
                      (dbo.tc_trans_pelayanan.jenis_tindakan IN ('9', '7')) AND (SUM(dbo.tc_trans_pelayanan.jumlah) > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [penggunaan_bhp_beban_pasien_v]");
    }
};
