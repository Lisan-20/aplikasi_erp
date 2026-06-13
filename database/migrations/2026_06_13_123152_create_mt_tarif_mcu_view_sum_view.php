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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_tarif_mcu_view_sum
AS
SELECT     kode_tarif, SUM(total) AS total, tindakan AS nama_tarif, '011801' AS kode_bagian
FROM         dbo.mt_tarif_mcu_view
GROUP BY kode_tarif, tindakan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_tarif_mcu_view_sum]");
    }
};
