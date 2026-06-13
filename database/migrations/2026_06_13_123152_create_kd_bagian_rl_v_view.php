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
        DB::statement("CREATE VIEW dbo.kd_bagian_rl_v
AS
SELECT     CASE WHEN grup_rl = 1 THEN '030001' ELSE mt_bagian.kode_bagian END AS kode_bagian
FROM         dbo.mt_bagian
WHERE     (status_aktif = 1) AND (group_bag = 'Detail')
GROUP BY CASE WHEN grup_rl = 1 THEN '030001' ELSE mt_bagian.kode_bagian END
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [kd_bagian_rl_v]");
    }
};
