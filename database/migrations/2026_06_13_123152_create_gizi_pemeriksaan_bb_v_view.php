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
        DB::statement("CREATE VIEW dbo.gizi_pemeriksaan_bb_v
AS
SELECT     no_kunjungan, no_registrasi, kode_pemeriksaan, nama_pemeriksaan, hasil, ket_hasil_bmi
FROM         dbo.tc_pemeriksaan_erm
WHERE     (kode_pemeriksaan IN (10215, 42208, 50208, 83211, 20214, 41208, 35210))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [gizi_pemeriksaan_bb_v]");
    }
};
