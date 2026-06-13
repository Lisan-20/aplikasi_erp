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
        DB::statement("CREATE VIEW dbo.mt_periode_gaji_v
AS
SELECT     periode_gaji, YEAR(periode_akhir) AS thn, MONTH(periode_akhir) AS bln, flag_final, id_periode_gaji
FROM         dbo.mt_periode_gaji
WHERE     (flag_final = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_periode_gaji_v]");
    }
};
