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
        DB::statement("CREATE OR ALTER VIEW dbo.gud_pemakaian_bhp_v
AS
SELECT     dbo.tc_kartu_stok.kode_brg, DAY(dbo.tc_kartu_stok.tgl_input) AS tgl, MONTH(dbo.tc_kartu_stok.tgl_input) AS bln, YEAR(dbo.tc_kartu_stok.tgl_input) AS thn, dbo.tc_kartu_stok.petugas, 
                      dbo.tc_kartu_stok.kode_bagian, dbo.mt_barang.nama_brg, dbo.tc_kartu_stok.pengeluaran AS jumlah, dbo.mt_rekap_stok.harga_beli AS harga, dbo.tc_kartu_stok.keterangan, 
                      dbo.mt_barang.flag_medis
FROM         dbo.mt_rekap_stok INNER JOIN
                      dbo.mt_barang ON dbo.mt_rekap_stok.kode_brg = dbo.mt_barang.kode_brg INNER JOIN
                      dbo.tc_kartu_stok ON dbo.mt_barang.kode_brg = dbo.tc_kartu_stok.kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [gud_pemakaian_bhp_v]");
    }
};
