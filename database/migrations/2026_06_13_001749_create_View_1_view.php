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
        DB::statement("CREATE OR ALTER VIEW dbo.View_1
AS
SELECT     TOP (100) PERCENT kode_brg, nama_brg, status_aktif
FROM         dbo.mt_barang
WHERE     (status_aktif = 0)
ORDER BY nama_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [View_1]");
    }
};
