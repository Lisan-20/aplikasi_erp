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
        DB::statement("CREATE VIEW dbo.upd_L_Rugi_sel_biaya4_v
AS
SELECT     SUM(total_pend) AS total_pend, SUM(total_pend_ll) AS total_pend_ll, bulan, tahun
FROM         dbo.upd_L_Rugi_sel_biaya1_v
GROUP BY bulan, tahun
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_L_Rugi_sel_biaya4_v]");
    }
};
