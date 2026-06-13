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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_mutasi_pengeluaran_sum_v
AS
SELECT     kode_brg, SUM(pengeluaran) AS pengeluaran, bulan, tahun
FROM         dbo.lap_mutasi_pengeluaran_v
GROUP BY kode_brg, bulan, tahun
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_mutasi_pengeluaran_sum_v]");
    }
};
