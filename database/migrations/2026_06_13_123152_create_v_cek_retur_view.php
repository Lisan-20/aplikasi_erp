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
        DB::statement("CREATE VIEW dbo.v_cek_retur
AS
SELECT     kode_trans_far, SUM(CASE WHEN jumlah_retur IS NULL THEN 0 ELSE jumlah_retur END) AS retur, SUM(CASE WHEN jumlah_tebus IS NULL THEN 0 ELSE jumlah_tebus END) AS tebus, 
                      SUM(CASE WHEN jumlah_tebus IS NULL THEN 0 ELSE jumlah_tebus END - CASE WHEN jumlah_retur IS NULL THEN 0 ELSE jumlah_retur END) AS hasil
FROM         dbo.fr_tc_far_detail
GROUP BY kode_trans_far
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_cek_retur]");
    }
};
