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
        DB::statement("CREATE OR ALTER VIEW dbo.entry_makan_gizi_v
AS
SELECT     no_mr, no_registrasi, nama_pasien, kode_ruangan, kelas_pas, tgl_masuk, dr_merawat, jen_kelamin, kode_kelompok, diagnosa_awal, bag_pas
FROM         dbo.ri_cari_pasien_v
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [entry_makan_gizi_v]");
    }
};
