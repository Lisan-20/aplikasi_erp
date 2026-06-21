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
        DB::statement("CREATE OR ALTER VIEW dbo.stok_obat_pakai_30_hari_v
AS
SELECT     dbo.tc_kartu_stok.kode_brg, SUM(dbo.tc_kartu_stok.stok_awal) AS awal, SUM(dbo.tc_kartu_stok.pemasukan) AS masuk, SUM(dbo.tc_kartu_stok.pengeluaran) 
                      AS jumlah, SUM(dbo.tc_kartu_stok.stok_akhir) AS stok, dbo.tc_kartu_stok.kode_bagian, dbo.mt_bagian.nama_bagian, YEAR(dbo.tc_kartu_stok.tgl_input) AS thn, 
                      MONTH(dbo.tc_kartu_stok.tgl_input) AS bln, DAY(dbo.tc_kartu_stok.tgl_input) AS tgl
FROM         dbo.tc_kartu_stok INNER JOIN
                      dbo.mt_bagian ON dbo.tc_kartu_stok.kode_bagian = dbo.mt_bagian.kode_bagian
GROUP BY MONTH(dbo.tc_kartu_stok.tgl_input), YEAR(dbo.tc_kartu_stok.tgl_input), dbo.tc_kartu_stok.kode_brg, dbo.tc_kartu_stok.kode_bagian, dbo.mt_bagian.nama_bagian, 
                      DAY(dbo.tc_kartu_stok.tgl_input)
HAVING      (dbo.tc_kartu_stok.kode_brg <> '') AND (dbo.tc_kartu_stok.kode_bagian <> '060201')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [stok_obat_pakai_30_hari_v]");
    }
};
