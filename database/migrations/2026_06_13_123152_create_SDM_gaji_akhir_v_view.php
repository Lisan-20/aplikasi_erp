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
        DB::statement("CREATE VIEW dbo.SDM_gaji_akhir_v
AS
SELECT     MAX(id_tc_thp) AS id_tc_thp, npp
FROM         dbo.tc_gaji_tiap_bulan
GROUP BY npp
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [SDM_gaji_akhir_v]");
    }
};
