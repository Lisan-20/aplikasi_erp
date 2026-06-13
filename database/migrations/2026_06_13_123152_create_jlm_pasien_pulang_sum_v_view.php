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
        DB::statement("CREATE OR ALTER VIEW dbo.jlm_pasien_pulang_sum_v
AS
SELECT     COUNT(jml) AS jml_pulang, status_pulang, thn, bln
FROM         dbo.jml_pasien_pulang_v
GROUP BY status_pulang, thn, bln
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jlm_pasien_pulang_sum_v]");
    }
};
