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
        DB::statement("CREATE OR ALTER VIEW dbo.cek_bukti_bd_tc_dobel_v
AS
SELECT     TOP (100) PERCENT no_bukti, COUNT(no_bukti) AS jml_bukti
FROM         dbo.bd_tc_trans
GROUP BY no_bukti
HAVING      (COUNT(no_bukti) > 1) AND (no_bukti NOT LIKE '%UMD%')
ORDER BY no_bukti
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_bukti_bd_tc_dobel_v]");
    }
};
