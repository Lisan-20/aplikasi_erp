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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_cppt_max_v
AS
SELECT     TOP (100) PERCENT MAX(Id) AS Id_per, no_registrasi, MAX(hp_s) AS hp_s, MAX(hp_o) AS hp_o, MAX(hp_a) AS hp_a, MAX(hp_p) AS hp_p, MAX(tgl_jam) AS tgl_jam, profesi, MAX(instruksi) 
                      AS instruksi
FROM         dbo.tc_cppt
GROUP BY no_registrasi, profesi
HAVING      (profesi = 'Perawat')
ORDER BY Id_per DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_cppt_max_v]");
    }
};
