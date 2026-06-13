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
        DB::statement("CREATE VIEW dbo.jml_rj_pasien_kinerja_rs_sum_v
AS
SELECT     SUM(jml) AS jml_rj, thn, bln
FROM         dbo.jml_rj_pasien_kinerja_rs_v
GROUP BY thn, bln
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jml_rj_pasien_kinerja_rs_sum_v]");
    }
};
