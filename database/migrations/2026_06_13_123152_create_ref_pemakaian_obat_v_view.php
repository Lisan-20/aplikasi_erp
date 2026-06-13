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
        DB::statement("CREATE OR ALTER VIEW dbo.ref_pemakaian_obat_v
AS
SELECT     TOP (100) PERCENT dbo.mt_depo_stok.jml_sat_kcl, dbo.mt_barang.satuan_kecil, dbo.mt_barang.satuan_besar, dbo.mt_depo_stok.stok_minimum, 
                      dbo.mt_barang.[content], dbo.mt_depo_stok.kode_bagian, SUM(CAST(dbo.tc_kartu_stok.pengeluaran AS money)) - SUM(CAST(dbo.tc_kartu_stok.pemasukan AS money))
                       AS pengeluaran, dbo.mt_barang.status_aktif, dbo.mt_barang.nama_brg, dbo.mt_depo_stok.kode_brg, MONTH(dbo.tc_kartu_stok.tgl_input) AS bulan, 
                      SUM(CAST(dbo.tc_kartu_stok.pemasukan AS money)) AS pemasukan, dbo.tc_kartu_stok.jenis_transaksi
FROM         dbo.mt_depo_stok INNER JOIN
                      dbo.mt_barang ON dbo.mt_depo_stok.kode_brg = dbo.mt_barang.kode_brg INNER JOIN
                      dbo.tc_kartu_stok ON dbo.mt_depo_stok.kode_brg = dbo.tc_kartu_stok.kode_brg
GROUP BY dbo.mt_depo_stok.jml_sat_kcl, dbo.mt_barang.satuan_kecil, dbo.mt_barang.satuan_besar, dbo.mt_depo_stok.stok_minimum, dbo.mt_barang.[content], 
                      dbo.mt_depo_stok.kode_bagian, MONTH(dbo.tc_kartu_stok.tgl_input), dbo.mt_barang.status_aktif, dbo.mt_barang.nama_brg, dbo.mt_depo_stok.kode_brg, 
                      dbo.tc_kartu_stok.jenis_transaksi
HAVING      (dbo.mt_barang.status_aktif IS NULL OR
                      dbo.mt_barang.status_aktif = 0) AND (MONTH(dbo.tc_kartu_stok.tgl_input) BETWEEN MONTH(GETDATE()) - 3 AND MONTH(GETDATE())) AND 
                      (NOT (dbo.tc_kartu_stok.jenis_transaksi IN (1, 9))) AND (SUM(CAST(dbo.tc_kartu_stok.pengeluaran AS money)) - SUM(CAST(dbo.tc_kartu_stok.pemasukan AS money)) 
                      > N'0')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ref_pemakaian_obat_v]");
    }
};
