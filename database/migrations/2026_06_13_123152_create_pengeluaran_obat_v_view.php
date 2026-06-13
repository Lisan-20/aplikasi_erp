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
        DB::statement("CREATE VIEW dbo.pengeluaran_obat_v
AS
SELECT     MONTH(tgl_input) AS bln, YEAR(tgl_input) AS thn, kode_brg, SUM(pemasukan) AS masuk, SUM(pengeluaran) AS keluar
FROM         dbo.tc_kartu_stok
WHERE     (NOT (jenis_transaksi IN (9, 4, 20, 3, 4, 1)))
GROUP BY MONTH(tgl_input), YEAR(tgl_input), kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pengeluaran_obat_v]");
    }
};
