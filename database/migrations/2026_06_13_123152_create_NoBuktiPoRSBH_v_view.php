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
        DB::statement("CREATE VIEW dbo.NoBuktiPoRSBH_v
AS
SELECT     TOP (100) PERCENT RIGHT(no_pesanan, 4) AS NoUrut, no_pesanan, CAST(RIGHT(no_pesanan, 4) AS int) AS NoInt, MONTH(tgl_pesanan) AS bln, YEAR(tgl_pesanan) AS thn
FROM         dbo.trans_co_header
ORDER BY thn DESC, bln DESC, no_pesanan DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [NoBuktiPoRSBH_v]");
    }
};
