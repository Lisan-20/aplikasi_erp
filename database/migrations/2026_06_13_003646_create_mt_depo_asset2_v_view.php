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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_depo_asset2_v
AS
SELECT     dbo.mt_asset.id_asset, dbo.mt_asset.kode_bagian, dbo.mt_asset.asset_type, dbo.mt_asset.tgl_perolehan, dbo.mt_asset.tgl_pemakaian, dbo.mt_asset.qty, dbo.mt_asset.estimasi_penggunaan, 
                      dbo.mt_asset.metode_penyusutan, dbo.mt_asset.rate, dbo.mt_bagian.nama_bagian, YEAR(dbo.mt_asset.tgl_perolehan) AS thn_peroleh, dbo.mt_tipe_asset.acc_d, dbo.mt_tipe_asset.acc_k, 
                      dbo.mt_tipe_asset.nama_tipe, dbo.mt_barang_jasa.nama_brg, dbo.mt_barang_jasa.kode_brg, dbo.mt_barang_jasa.satuan_kecil, dbo.mt_barang_jasa.harga_beli, dbo.mt_barang_jasa.satuan_besar, 
                      dbo.mt_asset.residu, dbo.mt_asset.status_asset, dbo.mt_tipe_asset.id_tipe_asset, dbo.mt_asset.no_asset AS kode_aset, dbo.mt_asset.tgl_kadaluarsa, dbo.tbl_proses_penyusutan.flag, 
                      dbo.tbl_proses_penyusutan.bulan, dbo.tbl_proses_penyusutan.tahun
FROM         dbo.mt_asset INNER JOIN
                      dbo.mt_bagian ON dbo.mt_asset.kode_bagian = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_tipe_asset ON dbo.mt_asset.asset_type = dbo.mt_tipe_asset.acc_tipe INNER JOIN
                      dbo.mt_barang_jasa ON dbo.mt_asset.kode_brg = dbo.mt_barang_jasa.kode_brg CROSS JOIN
                      dbo.tbl_proses_penyusutan
WHERE     (dbo.mt_barang_jasa.harga_beli >= 1000000) AND (dbo.tbl_proses_penyusutan.flag = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_depo_asset2_v]");
    }
};
