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
        DB::statement("CREATE OR ALTER VIEW dbo.kasir_rj_ver_v
AS
SELECT     seri_kuitansi, no_kuitansi, no_registrasi, tgl_ver, flag_jurnal
FROM         dbo.tc_trans_kasir
WHERE     (seri_kuitansi NOT IN ('RI', 'AI')) AND (YEAR(tgl_jam) = 2017) AND (NOT (flag_jurnal IS NULL))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [kasir_rj_ver_v]");
    }
};
