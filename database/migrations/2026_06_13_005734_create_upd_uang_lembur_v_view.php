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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_uang_lembur_v
AS
SELECT     jumlah_jam_lembur, jumlah_uang_lembur, jumlah_jam_lembur * 7000 AS upd_uang_lembur, flag
FROM         dbo.tc_lembur
WHERE     (jumlah_uang_lembur = 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_uang_lembur_v]");
    }
};
