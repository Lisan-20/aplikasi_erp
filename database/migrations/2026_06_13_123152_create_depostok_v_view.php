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
        DB::statement("CREATE VIEW dbo.depostok_v
AS
SELECT     kode_brg, kode_bagian, jml_sat_kcl
FROM         dbo.mt_depo_stok
WHERE     (kode_bagian = '060201') AND (kode_brg = 'D01A01737')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [depostok_v]");
    }
};
