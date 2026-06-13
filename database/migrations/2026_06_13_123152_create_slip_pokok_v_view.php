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
        DB::statement("CREATE VIEW dbo.slip_pokok_v
AS
SELECT     npp, id_mt_periode_gaji, gaji_pokok AS nilai, 'Gaji Pokok' AS ket, 1 AS urut
FROM         dbo.tc_gaji_pokok
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [slip_pokok_v]");
    }
};
