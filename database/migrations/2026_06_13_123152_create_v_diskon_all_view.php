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
        DB::statement("CREATE VIEW dbo.v_diskon_all
AS
SELECT     TOP (100) PERCENT SUM(CASE WHEN diskon_rs IS NULL THEN 0 ELSE diskon_rs END) AS diskon_rs, SUM(CASE WHEN diskon_dr1 IS NULL 
                      THEN 0 ELSE diskon_dr1 END) AS diskon_dr1, SUM(CASE WHEN diskon_dr2 IS NULL THEN 0 ELSE diskon_dr2 END) AS diskon_dr2, no_registrasi, no_mr, 
                      status_batal
FROM         dbo.tc_trans_pelayanan
GROUP BY no_registrasi, no_mr, status_batal
HAVING      (status_batal IS NULL)
ORDER BY no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_diskon_all]");
    }
};
