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
        DB::statement("CREATE VIEW dbo.mt_depo_stok_batch_v
AS
SELECT     dbo.mt_depo_stok.kode_bagian, dbo.mt_bagian.nama_bagian, dbo.mt_depo_stok.kode_brg, dbo.mt_depo_stok.stok_minimum, dbo.mt_depo_stok.stok_maksimum, 
                      dbo.mt_depo_stok.jml_sat_kcl, SUM(CASE WHEN dbo.tc_kartu_stok.pemasukan IS NULL THEN 0 ELSE dbo.tc_kartu_stok.pemasukan END) AS pemasukan, 
                      SUM(CASE WHEN dbo.tc_kartu_stok.pengeluaran IS NULL THEN 0 ELSE dbo.tc_kartu_stok.pengeluaran END) AS pengeluaran, dbo.tc_kartu_stok.no_batch, 
                      dbo.tc_kartu_stok.tgl_kadaluarsa
FROM         dbo.mt_bagian INNER JOIN
                      dbo.mt_depo_stok ON dbo.mt_bagian.kode_bagian = dbo.mt_depo_stok.kode_bagian LEFT OUTER JOIN
                      dbo.tc_kartu_stok ON dbo.mt_depo_stok.kode_bagian = dbo.tc_kartu_stok.kode_bagian AND dbo.mt_depo_stok.kode_brg = dbo.tc_kartu_stok.kode_brg
GROUP BY dbo.mt_depo_stok.kode_bagian, dbo.mt_bagian.nama_bagian, dbo.mt_depo_stok.kode_brg, dbo.mt_depo_stok.stok_minimum, dbo.mt_depo_stok.stok_maksimum, 
                      dbo.mt_depo_stok.jml_sat_kcl, dbo.tc_kartu_stok.no_batch, dbo.tc_kartu_stok.tgl_kadaluarsa
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_depo_stok_batch_v]");
    }
};
