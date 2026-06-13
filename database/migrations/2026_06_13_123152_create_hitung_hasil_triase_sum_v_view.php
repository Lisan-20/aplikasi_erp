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
        DB::statement("CREATE VIEW dbo.hitung_hasil_triase_sum_v
AS
SELECT     TOP (100) PERCENT COUNT(hasil) AS hasil, id_triase, kd_golongan
FROM         dbo.hitung_hasil_triase_v
GROUP BY id_triase, kd_golongan
ORDER BY hasil DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [hitung_hasil_triase_sum_v]");
    }
};
