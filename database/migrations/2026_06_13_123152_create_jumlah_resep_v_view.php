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
        DB::statement("CREATE VIEW dbo.jumlah_resep_v
AS
SELECT     TOP (100) PERCENT COUNT(kode_trans_far) AS jml_resep, MONTH(tgl_trans) AS bulan, YEAR(tgl_trans) AS tahun, kode_profit
FROM         dbo.fr_tc_far
GROUP BY MONTH(tgl_trans), kode_profit, YEAR(tgl_trans)
ORDER BY bulan, tahun
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jumlah_resep_v]");
    }
};
