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
        DB::statement("
CREATE OR ALTER VIEW dbo.dd_bagian_v
AS
SELECT     kode_level, nama_struktur, kode_level_org, kode_level_ref, ko_wil, jenis_struktur, id_dc_struktur_organisasi
FROM         dbo.dc_struktur_organisasi
WHERE     (kode_level_org = '60')

");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [dd_bagian_v]");
    }
};
