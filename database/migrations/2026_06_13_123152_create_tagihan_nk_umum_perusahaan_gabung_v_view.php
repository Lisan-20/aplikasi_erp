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
        DB::statement("CREATE VIEW dbo.tagihan_nk_umum_perusahaan_gabung_v
AS
SELECT     *
FROM         dbo.tagihan_nk_umum_v 
UNION
SELECT  *
FROM          dbo.tagihan_nk_perusahaan_v
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tagihan_nk_umum_perusahaan_gabung_v]");
    }
};
