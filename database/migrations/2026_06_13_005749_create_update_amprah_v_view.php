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
        DB::statement("CREATE OR ALTER VIEW dbo.update_amprah_v
AS
SELECT     dbo.tc_trans_pelayanan.kode_barang, dbo.tc_trans_pelayanan.jumlah AS jml, dbo.mt_barang.nama_brg, dbo.mt_barang.satuan_kecil, 
                      dbo.tc_trans_pelayanan.kode_bagian, dbo.mt_bagian.nama_bagian, dbo.tc_trans_pelayanan.flag_amprah, 
                      YEAR(dbo.tc_trans_pelayanan.tgl_transaksi) AS tahun, dbo.mt_barang.kode_brg, dbo.mt_depo_stok.jml_sat_kcl, 
                      (CASE WHEN status_kredit = 1 THEN (- 1) ELSE 1 END) * dbo.tc_trans_pelayanan.jumlah AS jumlah, dbo.tc_trans_pelayanan.kode_trans_pelayanan, 
                      dbo.tc_trans_pelayanan.id_tc_permintaan_inst
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.mt_barang ON dbo.tc_trans_pelayanan.kode_barang = dbo.mt_barang.kode_brg INNER JOIN
                      dbo.mt_bagian ON dbo.tc_trans_pelayanan.kode_bagian = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_depo_stok ON dbo.mt_bagian.kode_bagian = dbo.mt_depo_stok.kode_bagian AND 
                      dbo.mt_barang.kode_brg = dbo.mt_depo_stok.kode_brg
WHERE     (dbo.tc_trans_pelayanan.kode_barang <> '') AND (YEAR(dbo.tc_trans_pelayanan.tgl_transaksi) >= 2015)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_amprah_v]");
    }
};
