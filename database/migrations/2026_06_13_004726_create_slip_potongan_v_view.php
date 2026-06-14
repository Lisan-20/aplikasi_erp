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
        DB::statement("CREATE OR ALTER VIEW dbo.slip_potongan_v
AS
SELECT     npp, ket_potongan AS ket, nilai_pot_kel AS nilai, id_mt_periode_gaji, 1 AS urut
FROM         dbo.tc_potongan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [slip_potongan_v]");
    }
};
