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
        DB::statement("CREATE OR ALTER VIEW dbo.depo_stok_farmasi_v
AS
SELECT     kode_depo_stok, kode_brg, jml_sat_kcl, stok_minimum, stok_maksimum, kode_bagian, kode_rekap_stok, id_kartu
FROM         dbo.mt_depo_stok
WHERE     (kode_bagian = '060101')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [depo_stok_farmasi_v]");
    }
};
