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
        DB::statement("CREATE OR ALTER VIEW dbo.pengeluaran_obat_gudang_v
AS
SELECT     dbo.tc_kartu_stok.kode_brg, dbo.tc_kartu_stok.pemasukan, dbo.tc_kartu_stok.pengeluaran, dbo.tc_kartu_stok.jenis_transaksi, dbo.tc_kartu_stok.kode_bagian, 
                      MONTH(dbo.tc_kartu_stok.tgl_input) AS bulan, YEAR(dbo.tc_kartu_stok.tgl_input) AS tahun, dbo.mt_barang.status_aktif, dbo.mt_barang.nama_brg
FROM         dbo.tc_kartu_stok INNER JOIN
                      dbo.mt_barang ON dbo.tc_kartu_stok.kode_brg = dbo.mt_barang.kode_brg
GROUP BY dbo.tc_kartu_stok.kode_brg, dbo.tc_kartu_stok.pemasukan, dbo.tc_kartu_stok.pengeluaran, dbo.tc_kartu_stok.jenis_transaksi, dbo.tc_kartu_stok.kode_bagian, 
                      MONTH(dbo.tc_kartu_stok.tgl_input), YEAR(dbo.tc_kartu_stok.tgl_input), dbo.mt_barang.status_aktif, dbo.mt_barang.nama_brg
HAVING      (dbo.tc_kartu_stok.kode_bagian = '060201') AND (NOT (dbo.tc_kartu_stok.jenis_transaksi IN (1, 9))) AND (dbo.mt_barang.status_aktif <> 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pengeluaran_obat_gudang_v]");
    }
};
