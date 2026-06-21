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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_obat_promo_v
AS
SELECT     dbo.tbl_obat_promo_temp.id, dbo.tbl_obat_promo_temp.kode_trans_far, dbo.tbl_obat_promo_temp.kode_brg, dbo.tbl_obat_promo_temp.jml_sat_kcl, dbo.tbl_obat_promo_temp.satuan_kecil, 
                      dbo.tbl_obat_promo_temp.harga, dbo.tbl_obat_promo_temp.margin, dbo.tbl_obat_promo_temp.total_harga, dbo.tbl_obat_promo_temp.tgl, dbo.tbl_obat_promo_temp.user_id, 
                      dbo.tbl_obat_promo_temp.kode_brg_promo, dbo.tbl_obat_promo_temp.status_kirim, dbo.mt_barang.nama_brg, dbo.mt_depo_stok.kode_bagian, mt_barang_1.nama_brg AS nama_obat_promo, 
                      dbo.tbl_obat_promo_temp.kd_tr_resep, dbo.tbl_obat_promo_temp.jml_per_tablet, dbo.tbl_obat_promo_temp.satuan_per_tablet, dbo.tbl_obat_promo_temp.jumlah
FROM         dbo.tbl_obat_promo_temp INNER JOIN
                      dbo.mt_barang ON dbo.tbl_obat_promo_temp.kode_brg = dbo.mt_barang.kode_brg INNER JOIN
                      dbo.mt_depo_stok ON dbo.mt_barang.kode_brg = dbo.mt_depo_stok.kode_brg INNER JOIN
                      dbo.mt_barang AS mt_barang_1 ON dbo.tbl_obat_promo_temp.kode_brg_promo = mt_barang_1.kode_brg INNER JOIN
                      dbo.fr_tc_far_detail ON dbo.tbl_obat_promo_temp.kd_tr_resep = dbo.fr_tc_far_detail.kd_tr_resep
GROUP BY dbo.tbl_obat_promo_temp.id, dbo.tbl_obat_promo_temp.kode_trans_far, dbo.tbl_obat_promo_temp.kode_brg, dbo.tbl_obat_promo_temp.jml_sat_kcl, dbo.tbl_obat_promo_temp.satuan_kecil, 
                      dbo.tbl_obat_promo_temp.harga, dbo.tbl_obat_promo_temp.margin, dbo.tbl_obat_promo_temp.total_harga, dbo.tbl_obat_promo_temp.tgl, dbo.tbl_obat_promo_temp.user_id, 
                      dbo.tbl_obat_promo_temp.kode_brg_promo, dbo.tbl_obat_promo_temp.status_kirim, dbo.mt_barang.nama_brg, dbo.mt_depo_stok.kode_bagian, mt_barang_1.nama_brg, 
                      dbo.tbl_obat_promo_temp.kd_tr_resep, dbo.tbl_obat_promo_temp.jml_per_tablet, dbo.tbl_obat_promo_temp.satuan_per_tablet, dbo.tbl_obat_promo_temp.jumlah
HAVING      (dbo.mt_depo_stok.kode_bagian = '060101')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_obat_promo_v]");
    }
};
