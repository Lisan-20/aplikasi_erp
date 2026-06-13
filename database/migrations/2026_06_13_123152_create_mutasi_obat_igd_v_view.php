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
        DB::statement("CREATE VIEW dbo.mutasi_obat_igd_v
AS
SELECT     dbo.tc_kartu_stok.kode_brg, dbo.mt_barang.nama_brg, SUM(dbo.tc_kartu_stok.pemasukan) AS masuk, SUM(dbo.tc_kartu_stok.pengeluaran) AS keluar, 
                      dbo.tc_kartu_stok.kode_bagian, YEAR(dbo.tc_kartu_stok.tgl_input) AS thn, MONTH(dbo.tc_kartu_stok.tgl_input) AS bln, DAY(dbo.tc_kartu_stok.tgl_input) 
                      AS tgl
FROM         dbo.tc_kartu_stok INNER JOIN
                      dbo.mt_barang ON dbo.tc_kartu_stok.kode_brg = dbo.mt_barang.kode_brg
GROUP BY YEAR(dbo.tc_kartu_stok.tgl_input), dbo.tc_kartu_stok.kode_bagian, dbo.tc_kartu_stok.kode_brg, dbo.mt_barang.nama_brg, 
                      MONTH(dbo.tc_kartu_stok.tgl_input), DAY(dbo.tc_kartu_stok.tgl_input)
HAVING      (dbo.tc_kartu_stok.kode_bagian = '020101')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mutasi_obat_igd_v]");
    }
};
