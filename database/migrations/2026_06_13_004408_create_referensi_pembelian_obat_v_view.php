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
        DB::statement("CREATE OR ALTER VIEW dbo.referensi_pembelian_obat_v
AS
SELECT     TOP (100) PERCENT dbo.mt_depo_stok.jml_sat_kcl, dbo.mt_barang.satuan_kecil, dbo.mt_barang.satuan_besar, dbo.mt_depo_stok.stok_minimum, 
                      dbo.mt_barang.[content], dbo.mt_depo_stok.kode_bagian, SUM(CAST(dbo.tc_kartu_stok.pengeluaran AS money)) AS pengeluaran, dbo.mt_barang.status_aktif, 
                      dbo.mt_barang.nama_brg, dbo.mt_depo_stok.kode_brg
FROM         dbo.mt_depo_stok INNER JOIN
                      dbo.mt_barang ON dbo.mt_depo_stok.kode_brg = dbo.mt_barang.kode_brg INNER JOIN
                      dbo.tc_kartu_stok ON dbo.mt_depo_stok.kode_brg = dbo.tc_kartu_stok.kode_brg
GROUP BY dbo.mt_depo_stok.jml_sat_kcl, dbo.mt_barang.satuan_kecil, dbo.mt_barang.satuan_besar, dbo.mt_depo_stok.stok_minimum, dbo.mt_barang.[content], 
                      dbo.mt_depo_stok.kode_bagian, MONTH(dbo.tc_kartu_stok.tgl_input), dbo.mt_barang.status_aktif, dbo.mt_barang.nama_brg, dbo.mt_depo_stok.kode_brg
HAVING      (dbo.mt_depo_stok.kode_bagian = '060201') AND (dbo.mt_barang.status_aktif IS NULL OR
                      dbo.mt_barang.status_aktif = 0) AND (MONTH(dbo.tc_kartu_stok.tgl_input) BETWEEN MONTH(GETDATE()) - 3 AND MONTH(GETDATE())) AND 
                      (SUM(CAST(dbo.tc_kartu_stok.pengeluaran AS money)) > N'0')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [referensi_pembelian_obat_v]");
    }
};
