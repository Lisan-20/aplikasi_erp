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
        DB::statement("CREATE OR ALTER VIEW dbo.slip_pajak_v
AS
SELECT     id_periode_gaji, npp, gross_bln AS nilai, 'Tunjangan Pajak' AS ket, 5 AS urut
FROM         dbo.tc_gaji_tiap_bulan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [slip_pajak_v]");
    }
};
