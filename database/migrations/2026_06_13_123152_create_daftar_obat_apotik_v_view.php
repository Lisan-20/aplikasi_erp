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
        DB::statement("CREATE VIEW dbo.daftar_obat_apotik_v
AS
SELECT     kode_brg, nama_brg, kode_bagian, stok_minimum, jml_sat_kcl
FROM         dbo.mt_depo_stok_v
WHERE     (kode_bagian = '060101')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [daftar_obat_apotik_v]");
    }
};
