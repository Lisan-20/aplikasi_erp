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
        DB::statement("CREATE OR ALTER VIEW dbo.ina_in_ds_v
AS
SELECT     inacbg, regional, kode_tariff, kelas_rawat, [ jenis_pelayanan], tariff_original, [ tariff], inp
FROM         dbo.tariff_cbg
WHERE     (kode_tariff = 'DS') AND ([ jenis_pelayanan] = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ina_in_ds_v]");
    }
};
