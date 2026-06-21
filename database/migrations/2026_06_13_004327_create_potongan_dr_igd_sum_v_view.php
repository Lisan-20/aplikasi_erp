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
        DB::statement("CREATE OR ALTER VIEW dbo.potongan_dr_igd_sum_v
AS
SELECT     TOP (100) PERCENT no, tgl, bln, thn, kode_dr, SUM(jumlah) AS jumlah, kode_kelompok
FROM         dbo.potongan_dr_igd_v
GROUP BY no, tgl, bln, thn, kode_dr, kode_kelompok
HAVING      (no < 6)
ORDER BY tgl
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [potongan_dr_igd_sum_v]");
    }
};
