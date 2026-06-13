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
        DB::statement("CREATE VIEW dbo.jml_pasien_meninggal_sum_v
AS
SELECT     COUNT(jml) AS jml_meninggal, status_pulang, thn, bln
FROM         dbo.jml_pasien_meninggal_v
GROUP BY status_pulang, thn, bln
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jml_pasien_meninggal_sum_v]");
    }
};
