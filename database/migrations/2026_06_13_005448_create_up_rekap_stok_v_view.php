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
        DB::statement("CREATE OR ALTER VIEW dbo.up_rekap_stok_v
AS
SELECT     dbo.mt_depo_stok.kode_bagian, dbo.mt_depo_stok.kode_rekap_stok, dbo.mt_rekap_stok.kode_rekap_stok AS kode_rekap_stok_up
FROM         dbo.mt_rekap_stok INNER JOIN
                      dbo.mt_depo_stok ON dbo.mt_rekap_stok.kode_brg = dbo.mt_depo_stok.kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [up_rekap_stok_v]");
    }
};
