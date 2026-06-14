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
        DB::statement("CREATE OR ALTER VIEW dbo.L_Rugi_4_K_acc_v
AS
SELECT     acc_no, bulan, tahun, tx_tipe, SUM(tx_nominal) AS kredit, referensi
FROM         dbo.laba_tx_harian_lev_5
GROUP BY acc_no, bulan, tahun, tx_tipe, referensi
HAVING      (tx_tipe = 'K')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [L_Rugi_4_K_acc_v]");
    }
};
