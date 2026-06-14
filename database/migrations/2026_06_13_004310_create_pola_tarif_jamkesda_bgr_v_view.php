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
        DB::statement("CREATE OR ALTER VIEW dbo.pola_tarif_jamkesda_bgr_v
AS
SELECT     5 AS kode_kelompok, bill_rs_bpjs, bill_dr1_bpjs, kode_klas, kode_bagian, jenis_tindakan, kode_tarif, 388 AS kode_perusahaan
FROM         dbo.mt_tarif_v
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pola_tarif_jamkesda_bgr_v]");
    }
};
