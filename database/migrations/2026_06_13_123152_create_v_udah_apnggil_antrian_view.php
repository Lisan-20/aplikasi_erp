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
        DB::statement("CREATE VIEW dbo.v_udah_apnggil_antrian
AS
SELECT     MAX(CASE WHEN no_urut IS NULL THEN 0 ELSE no_urut END) AS no_antrian, kode_bagian
FROM         dbo.tc_antrian_loket
WHERE     (panggil = 1)
GROUP BY kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_udah_apnggil_antrian]");
    }
};
