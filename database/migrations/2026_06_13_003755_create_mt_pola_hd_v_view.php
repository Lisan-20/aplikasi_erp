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
        DB::statement("CREATE OR ALTER VIEW dbo.mt_pola_hd_v
AS
SELECT     kd_pola_hd, kode_tarif, kode_dokter, pola_dr, pola_rs, kode_bagian, kode_kelompok, kode_klas, jenis_tindakan
FROM         dbo.mt_pola_hd
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mt_pola_hd_v]");
    }
};
