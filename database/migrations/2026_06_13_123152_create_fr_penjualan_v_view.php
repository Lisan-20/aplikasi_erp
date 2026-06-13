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
        DB::statement("CREATE OR ALTER VIEW dbo.fr_penjualan_v
AS
SELECT     SUM(jumlah_pesan) AS pesan, SUM(jumlah_tebus) AS tebus, SUM(sisa) AS sisa, MONTH(tgl_trans) AS bln, DAY(tgl_trans) AS tgl, YEAR(tgl_trans) AS thn, SUM(jumlah_retur) AS retur, kode_brg
FROM         dbo.fr_hisbebasluar_v
GROUP BY MONTH(tgl_trans), DAY(tgl_trans), YEAR(tgl_trans), kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fr_penjualan_v]");
    }
};
