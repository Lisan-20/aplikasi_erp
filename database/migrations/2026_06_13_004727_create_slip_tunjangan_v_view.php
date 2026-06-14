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
        DB::statement("CREATE OR ALTER VIEW dbo.slip_tunjangan_v
AS
SELECT     npp, ket_tunjangan AS ket, nilai_tunj_kel AS nilai, id_mt_periode_gaji, 2 AS urut
FROM         dbo.tc_tunjangan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [slip_tunjangan_v]");
    }
};
