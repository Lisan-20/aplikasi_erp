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
        DB::statement("CREATE VIEW dbo.sie_kinerja_rs_unit3_v
AS
SELECT     thn - 1 AS thn, bln, id_lap
FROM         dbo.sie_kinerja_rs_unit
GROUP BY thn - 1, bln, id_lap
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sie_kinerja_rs_unit3_v]");
    }
};
