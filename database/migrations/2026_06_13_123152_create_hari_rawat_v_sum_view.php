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
        DB::statement("CREATE VIEW dbo.hari_rawat_v_sum
AS
SELECT     no_kunjungan, SUM(jumlah) AS jumlah
FROM         dbo.hari_rawat_v
GROUP BY no_kunjungan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [hari_rawat_v_sum]");
    }
};
