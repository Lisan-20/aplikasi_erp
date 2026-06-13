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
        DB::statement("CREATE OR ALTER VIEW dbo.v_barang_paket_gudang
AS
SELECT     dbo.mt_depo_stok.jml_sat_kcl, dbo.mt_depo_stok.kode_bagian, dbo.tbl_tarif_detail_obat.jumlah, dbo.tbl_tarif_detail_obat.kode_brg_paket, dbo.tbl_tarif_detail_obat.kode_brg, 
                      dbo.mt_barang.nama_brg, dbo.tbl_tarif_detail_obat.status
FROM         dbo.tbl_tarif_detail_obat INNER JOIN
                      dbo.mt_depo_stok ON dbo.tbl_tarif_detail_obat.kode_brg = dbo.mt_depo_stok.kode_brg INNER JOIN
                      dbo.mt_barang ON dbo.mt_depo_stok.kode_brg = dbo.mt_barang.kode_brg
WHERE     (dbo.tbl_tarif_detail_obat.status IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_barang_paket_gudang]");
    }
};
