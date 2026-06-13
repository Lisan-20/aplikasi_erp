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
        DB::statement("CREATE VIEW dbo.slip_gaji_3v
AS
SELECT     npp, id_mt_periode_gaji, nilai, ket, urut
FROM         slip_potongan_v
UNION
SELECT     npp, id_periode_gaji, nilai, ket, urut
FROM         slip_pajak_v
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [slip_gaji_3v]");
    }
};
