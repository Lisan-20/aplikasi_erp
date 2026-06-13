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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_mutasi_gabung_v
AS
SELECT     TOP (100) PERCENT a.kode_brg, b.nama_brg, dbo.lap_mutasi_retur_masuk_v.pengeluaran AS retur_pengeluaran, dbo.lap_awal_mutasi_v.stok_awal, 
                      dbo.lap_mutasi_retur_keluar_v.pemasukan AS retur_pemasukan, dbo.lap_mutasi_akhir_v.stok_akhir, dbo.lap_mutasi_pengeluaran_sum_v.pengeluaran, 
                      dbo.lap_pemasukan_mutasi_v.pemasukan, a.kode_bagian
FROM         dbo.mt_depo_stok AS a INNER JOIN
                      dbo.mt_barang AS b ON b.kode_brg = a.kode_brg LEFT OUTER JOIN
                      dbo.lap_pemasukan_mutasi_v ON b.kode_brg = dbo.lap_pemasukan_mutasi_v.kode_brg LEFT OUTER JOIN
                      dbo.lap_mutasi_akhir_v ON b.kode_brg = dbo.lap_mutasi_akhir_v.kode_brg LEFT OUTER JOIN
                      dbo.lap_mutasi_pengeluaran_sum_v ON b.kode_brg = dbo.lap_mutasi_pengeluaran_sum_v.kode_brg LEFT OUTER JOIN
                      dbo.lap_mutasi_retur_keluar_v ON b.kode_brg = dbo.lap_mutasi_retur_keluar_v.kode_brg LEFT OUTER JOIN
                      dbo.lap_mutasi_retur_masuk_v ON b.kode_brg = dbo.lap_mutasi_retur_masuk_v.kode_brg LEFT OUTER JOIN
                      dbo.lap_awal_mutasi_v ON b.kode_brg = dbo.lap_awal_mutasi_v.kode_brg
ORDER BY b.nama_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_mutasi_gabung_v]");
    }
};
