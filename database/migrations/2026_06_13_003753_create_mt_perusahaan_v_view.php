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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_perusahaan_v
AS
SELECT     kode_perusahaan, nama_perusahaan
FROM         dbo.mt_perusahaan
GROUP BY kode_perusahaan, nama_perusahaan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_perusahaan_v]");
    }
};
