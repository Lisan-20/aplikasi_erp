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
        DB::statement("CREATE OR ALTER VIEW dbo.sortir_no_mr
AS
SELECT     TOP (100) PERCENT no_mr, nama_pasien, nama_kel_pasien
FROM         dbo.mt_master_pasien
WHERE     (no_mr NOT IN
                          (SELECT     no_mr
                            FROM          dbo.tc_kunjungan
                            WHERE      (status_batal IS NULL)))
ORDER BY no_mr
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sortir_no_mr]");
    }
};
