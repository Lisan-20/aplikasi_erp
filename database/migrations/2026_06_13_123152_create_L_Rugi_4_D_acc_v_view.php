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
        DB::statement("CREATE VIEW dbo.L_Rugi_4_D_acc_v
AS
SELECT     acc_no, bulan, tahun, tx_tipe, referensi, SUM(tx_nominal) AS debet
FROM         dbo.laba_tx_harian_lev_5
GROUP BY acc_no, bulan, tahun, tx_tipe, referensi
HAVING      (tx_tipe = 'D')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [L_Rugi_4_D_acc_v]");
    }
};
