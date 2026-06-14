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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_kartu_stok_lap_v
AS
SELECT     YEAR(tgl_input) AS thn, MONTH(tgl_input) AS bln, SUM(pemasukan) AS pemasukan_up, SUM(pengeluaran) AS pengeluaran_up, kode_brg, kode_bagian
FROM         dbo.tc_kartu_stok
GROUP BY YEAR(tgl_input), MONTH(tgl_input), kode_brg, kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_kartu_stok_lap_v]");
    }
};
