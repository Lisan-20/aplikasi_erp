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
        DB::statement("CREATE VIEW dbo.SDM_keluar_bln_sum_v
AS
SELECT     COUNT(npp) AS jml, thn, bln
FROM         dbo.SDM_keluar_bln_v
GROUP BY thn, bln
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [SDM_keluar_bln_sum_v]");
    }
};
