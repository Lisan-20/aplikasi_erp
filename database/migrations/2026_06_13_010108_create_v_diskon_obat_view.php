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
        DB::statement("CREATE OR ALTER VIEW dbo.v_diskon_obat
AS
SELECT     TOP (100) PERCENT SUM(CASE WHEN diskon_rs IS NULL THEN 0 ELSE diskon_rs END) AS diskon_rs, no_registrasi, no_mr, kode_trans_far, status_batal
FROM         dbo.tc_trans_pelayanan
GROUP BY no_registrasi, no_mr, kode_trans_far, status_kredit, status_batal
HAVING      (kode_trans_far > 0) AND (status_kredit = 0) AND (SUM(CASE WHEN diskon_rs IS NULL THEN 0 ELSE diskon_rs END) > 0) AND (status_batal IS NULL)
ORDER BY no_registrasi, kode_trans_far
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_diskon_obat]");
    }
};
