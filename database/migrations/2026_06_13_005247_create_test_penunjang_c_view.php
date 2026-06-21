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
        DB::statement("CREATE OR ALTER VIEW dbo.test_penunjang_c
AS
SELECT     dbo.pm_tc_hasilpenunjang.kode_tc_hasilpenunjang, dbo.pm_tc_hasilpenunjang.kode_trans_pelayanan, 
                      dbo.pm_tc_hasilpenunjang_new.kode_tc_hasilpenunjang AS kode_tc_hasilpenunjang_new, 
                      dbo.pm_tc_hasilpenunjang_new.kode_trans_pelayanan AS kode_trans_pelayanan_new
FROM         dbo.pm_tc_hasilpenunjang INNER JOIN
                      dbo.pm_tc_hasilpenunjang_new ON 
                      dbo.pm_tc_hasilpenunjang.kode_tc_hasilpenunjang = dbo.pm_tc_hasilpenunjang_new.kode_tc_hasilpenunjang
WHERE     (dbo.pm_tc_hasilpenunjang.kode_trans_pelayanan IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [test_penunjang_c]");
    }
};
