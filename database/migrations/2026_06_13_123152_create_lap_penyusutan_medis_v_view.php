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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_penyusutan_medis_v
AS
SELECT     tahun, bulan, saldo_awal, acc_no
FROM         dbo.master_hist_bl
WHERE     (acc_no IN (1210202))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_penyusutan_medis_v]");
    }
};
