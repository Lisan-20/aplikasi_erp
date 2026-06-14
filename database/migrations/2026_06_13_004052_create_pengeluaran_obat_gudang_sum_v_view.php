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
        DB::statement("CREATE OR ALTER VIEW dbo.pengeluaran_obat_gudang_sum_v
AS
SELECT     TOP (100) PERCENT kode_brg, SUM(CAST(pemasukan AS int)) AS pemasukan, SUM(CAST(pengeluaran AS int)) AS pengeluaran, kode_bagian, bulan, tahun, 
                      nama_brg
FROM         dbo.pengeluaran_obat_gudang_v
GROUP BY kode_brg, kode_bagian, bulan, tahun, nama_brg
ORDER BY bulan DESC, tahun
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pengeluaran_obat_gudang_sum_v]");
    }
};
