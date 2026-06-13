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
        DB::statement("CREATE VIEW dbo.cek_saldo_awal_bl_v
AS
SELECT     TOP (100) PERCENT tahun, bulan, SUM(saldo_awal) AS saldo_awal
FROM         dbo.master_hist_bl
GROUP BY tahun, bulan
ORDER BY tahun DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_saldo_awal_bl_v]");
    }
};
