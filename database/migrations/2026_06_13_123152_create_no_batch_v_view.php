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
        DB::statement("CREATE VIEW dbo.no_batch_v
AS
SELECT     TOP (100) PERCENT kode_brg, no_batch, CONVERT(VARCHAR(10), tgl_kadaluarsa, 110) AS tgl_kadaluarsa, SUM(pemasukan) AS masuk, SUM(pengeluaran) AS keluar, 
                      SUM(pemasukan) - SUM(pengeluaran) AS sisa
FROM         dbo.tc_kartu_stok
WHERE     (kode_bagian = '060201')
GROUP BY kode_brg, no_batch, CONVERT(VARCHAR(10), tgl_kadaluarsa, 110)
HAVING      (SUM(pemasukan) - SUM(pengeluaran) > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [no_batch_v]");
    }
};
