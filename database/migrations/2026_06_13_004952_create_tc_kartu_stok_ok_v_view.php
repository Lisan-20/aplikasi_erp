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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_kartu_stok_ok_v
AS
SELECT     dbo.tc_kartu_stok.kode_brg, dbo.mt_barang.nama_brg, SUM(dbo.tc_kartu_stok.stok_awal) AS stok_awal, SUM(dbo.tc_kartu_stok.pemasukan) AS pemasukan, SUM(dbo.tc_kartu_stok.pengeluaran) 
                      AS pengeluaran, SUM(dbo.tc_kartu_stok.stok_akhir) AS stok_akhir, dbo.tc_kartu_stok.kode_bagian, dbo.tc_kartu_stok.id_kartu, dbo.tc_kartu_stok.tgl_input, MONTH(dbo.tc_kartu_stok.tgl_input) 
                      AS bln, YEAR(dbo.tc_kartu_stok.tgl_input) AS thn, dbo.tc_kartu_stok.jenis_transaksi, dbo.tc_kartu_stok.keterangan
FROM         dbo.mt_barang INNER JOIN
                      dbo.tc_kartu_stok ON dbo.mt_barang.kode_brg = dbo.tc_kartu_stok.kode_brg
GROUP BY dbo.tc_kartu_stok.kode_bagian, dbo.tc_kartu_stok.id_kartu, dbo.tc_kartu_stok.kode_brg, dbo.mt_barang.nama_brg, dbo.tc_kartu_stok.tgl_input, MONTH(dbo.tc_kartu_stok.tgl_input), 
                      YEAR(dbo.tc_kartu_stok.tgl_input), dbo.tc_kartu_stok.jenis_transaksi, dbo.tc_kartu_stok.keterangan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_kartu_stok_ok_v]");
    }
};
