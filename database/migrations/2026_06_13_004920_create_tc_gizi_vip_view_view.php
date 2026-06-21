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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_gizi_vip_view
AS
SELECT     tgl, bln, thn, kelas_pas, SUM(jml) AS vip, distribusi
FROM         dbo.tc_gizi_kelas_view
GROUP BY tgl, bln, thn, kelas_pas, distribusi
HAVING      (kelas_pas = 4)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_gizi_vip_view]");
    }
};
