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
        DB::statement("CREATE VIEW dbo.id_bobot_nilai_2_v
AS
SELECT     npp, id_tc_kinerja, id_bobot, AVG(nilai) AS nilai
FROM         dbo.tc_kinerja_v
GROUP BY npp, id_tc_kinerja, id_bobot
HAVING      (id_bobot = 2)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [id_bobot_nilai_2_v]");
    }
};
