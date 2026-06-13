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
        DB::statement("CREATE OR ALTER VIEW dbo.jumlah_pemakaian_far_bln_v
AS
SELECT     TOP (100) PERCENT kode_brg, SUM(pengeluaran) AS jumlah, kode_bagian, YEAR(tgl_input) AS thn, MONTH(tgl_input) AS bln
FROM         dbo.tc_kartu_stok
WHERE     (NOT (keterangan LIKE '%opname'))
GROUP BY MONTH(tgl_input), YEAR(tgl_input), kode_brg, kode_bagian
HAVING      (kode_brg <> '') AND (kode_bagian = '060101')
ORDER BY bln, thn
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jumlah_pemakaian_far_bln_v]");
    }
};
