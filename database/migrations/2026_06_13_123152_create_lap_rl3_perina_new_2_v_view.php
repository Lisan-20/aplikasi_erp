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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_rl3_perina_new_2_v
AS
SELECT     nama_diagnosa, thn, bln, COUNT(jumlah) AS jumlah
FROM         dbo.lap_rl3_perina_new_v
GROUP BY nama_diagnosa, thn, bln
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_rl3_perina_new_2_v]");
    }
};
