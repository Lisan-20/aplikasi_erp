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
        DB::statement("CREATE OR ALTER VIEW dbo.pasien_periksa_USG_v
AS
SELECT     kode_tarif, kode_trans_pelayanan, nama_tindakan, kode_tc_trans_kasir, no_kunjungan, no_registrasi
FROM         dbo.tc_trans_pelayanan
WHERE     (kode_tarif IN
                          (SELECT     kode_tarif
                            FROM          dbo.pemeriksaan_USG_v))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pasien_periksa_USG_v]");
    }
};
