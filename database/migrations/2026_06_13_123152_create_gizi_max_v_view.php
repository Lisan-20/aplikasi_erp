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
        DB::statement("CREATE VIEW dbo.gizi_max_v
AS
SELECT     no_registrasi, MAX(id_tc_sensus_gizi) AS id_tc_sensus_gizi
FROM         dbo.tc_sensus_gizi
GROUP BY no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [gizi_max_v]");
    }
};
