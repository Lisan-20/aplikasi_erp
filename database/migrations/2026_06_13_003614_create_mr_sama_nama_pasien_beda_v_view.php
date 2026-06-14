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
        DB::statement("CREATE OR ALTER VIEW dbo.mr_sama_nama_pasien_beda_v
AS
SELECT     COUNT(nama_pasien) AS Expr1, no_mr
FROM         dbo.mt_master_pasien
GROUP BY no_mr
HAVING      (COUNT(nama_pasien) > 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mr_sama_nama_pasien_beda_v]");
    }
};
