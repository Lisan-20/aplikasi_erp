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
        DB::statement("CREATE VIEW dbo.th_riwayat_pasien_sytem_lama_v
AS
SELECT     T_MR, TANGGAL, ICD, KODE_BAGIAN_OK, PERIKSA, 1 AS no_registrasi, '' AS no_kunjungan
FROM         dbo.th_riwayat_pasien_sytem_lama
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [th_riwayat_pasien_sytem_lama_v]");
    }
};
