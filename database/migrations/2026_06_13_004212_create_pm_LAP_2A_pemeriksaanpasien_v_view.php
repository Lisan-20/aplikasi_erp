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
        DB::statement("CREATE OR ALTER VIEW dbo.pm_LAP_2A_pemeriksaanpasien_v
AS
SELECT     TOP (100) PERCENT status_daftar, jen_kelamin, catatan_hasil, nama_pasien, dr_pengirim, kode_penunjang, no_hasil_pm, petugas_isihasil, kode_klas, 
                      kode_bagian_asal
FROM         dbo.pm_pasienpm_v
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pm_LAP_2A_pemeriksaanpasien_v]");
    }
};
