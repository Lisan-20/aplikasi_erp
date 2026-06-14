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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_kartu_stok_ok3_v
AS
SELECT     kode_brg, MONTH(tgl_input) AS bln, stok_awal
FROM         dbo.tc_kartu_stok
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_kartu_stok_ok3_v]");
    }
};
