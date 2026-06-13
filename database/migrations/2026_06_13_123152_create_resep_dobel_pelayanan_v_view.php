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
        DB::statement("CREATE OR ALTER VIEW dbo.resep_dobel_pelayanan_v
AS
SELECT     kd_tr_resep, COUNT(kd_tr_resep) AS jml, status_kredit, MIN(kode_trans_pelayanan) AS kode
FROM         dbo.tc_trans_pelayanan
GROUP BY kd_tr_resep, status_kredit
HAVING      (COUNT(kd_tr_resep) > 1) AND (status_kredit IS NULL OR
                      status_kredit = 0) AND (kd_tr_resep > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [resep_dobel_pelayanan_v]");
    }
};
