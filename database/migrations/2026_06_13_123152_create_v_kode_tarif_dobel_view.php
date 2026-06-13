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
        DB::statement("CREATE VIEW dbo.v_kode_tarif_dobel
AS
SELECT     TOP (100) PERCENT kode_perusahaan, kode_klas, bill_rs, bill_dr1, bill_dr2, kode_tarif, total, COUNT(kode_tarif) AS Expr1, MAX(kode_master_tarif_detail) 
                      AS kode_dobel
FROM         dbo.mt_master_tarif_detail_perusahaan
GROUP BY kode_perusahaan, kode_klas, bill_rs, bill_dr1, bill_dr2, kode_tarif, total
HAVING      (COUNT(kode_tarif) > 1)
ORDER BY kode_klas
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_kode_tarif_dobel]");
    }
};
