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
        DB::statement("CREATE VIEW dbo.part_djj_v
AS
SELECT     TOP (100) PERCENT kd_periksa, nama_pemeriksaan AS ukuran_djj
FROM         dbo.mt_acc_erm
WHERE     (kd_periksa > 48100) AND (kd_periksa < 48200)
ORDER BY kd_periksa
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [part_djj_v]");
    }
};
