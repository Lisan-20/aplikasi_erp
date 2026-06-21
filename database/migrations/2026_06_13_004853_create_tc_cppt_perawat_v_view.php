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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_cppt_perawat_v
AS
SELECT     TOP (100) PERCENT Id AS Id_per, no_registrasi, hp_s, hp_o, hp_a, hp_p, tgl_jam, profesi, instruksi
FROM         dbo.tc_cppt
WHERE     (profesi = 'Perawat')
ORDER BY Id DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_cppt_perawat_v]");
    }
};
