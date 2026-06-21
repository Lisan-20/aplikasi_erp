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
        DB::statement("CREATE OR ALTER VIEW dbo.fr_tc_far_obat_resum_rj_v
AS
SELECT     TOP (100) PERCENT kode_trans_pelayanan, kode_trans_far, no_registrasi, kode_bagian
FROM         dbo.tc_trans_pelayanan
GROUP BY no_registrasi, kode_trans_far, kode_bagian, kode_trans_pelayanan
HAVING      (kode_bagian = '060101')
ORDER BY kode_trans_pelayanan DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fr_tc_far_obat_resum_rj_v]");
    }
};
