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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_pemeriksaan_keluhan_utama_v
AS
SELECT     kode_pemeriksaan, hasil, no_registrasi
FROM         dbo.tc_pemeriksaan_erm
WHERE     (kode_pemeriksaan IN (10102, 11102, 18102, 185102, 19101, 195101, 20102, 26102, 30104, 32108, 35101, 40101, 41102, 42102, 50102, 56402, 60101, 78101, 79101, 80102, 81102, 82102, 83102, 
                      84102, 85102, 90102, 9613202, 99702))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_pemeriksaan_keluhan_utama_v]");
    }
};
