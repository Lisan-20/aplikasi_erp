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
        DB::statement("CREATE VIEW dbo.mt_bagian_inv_v
AS
SELECT     TOP (100) PERCENT kode_bagian, nama_bagian
FROM         dbo.mt_bagian
WHERE     (status_aktif = 1) AND (stat_depo = 1)
ORDER BY kode_bagian
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_bagian_inv_v]");
    }
};
