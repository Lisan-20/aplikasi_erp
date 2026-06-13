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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_mutasi_retur_masuk_v
AS
SELECT     kode_brg, SUM(pengeluaran) AS pengeluaran, MONTH(tgl_input) AS bulan, YEAR(tgl_input) AS tahun, jenis_transaksi
FROM         dbo.tc_kartu_stok
GROUP BY kode_brg, MONTH(tgl_input), YEAR(tgl_input), jenis_transaksi
HAVING      (jenis_transaksi = 4)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_mutasi_retur_masuk_v]");
    }
};
