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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_gizi_kelas_III_view
AS
SELECT     tgl, bln, kelas_pas, SUM(jml) AS kelas_III, thn, distribusi
FROM         dbo.tc_gizi_kelas_view
GROUP BY tgl, bln, kelas_pas, thn, distribusi
HAVING      (kelas_pas = 7)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_gizi_kelas_III_view]");
    }
};
