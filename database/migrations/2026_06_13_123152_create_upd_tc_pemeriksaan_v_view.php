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
        DB::statement("CREATE VIEW dbo.upd_tc_pemeriksaan_v
AS
SELECT     dbo.tc_pemeriksaan_erm.no_kunjungan, dbo.tc_pemeriksaan_erm.no_registrasi, dbo.tc_kunjungan.no_registrasi AS no_registrasi_up
FROM         dbo.tc_pemeriksaan_erm INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_pemeriksaan_erm.no_kunjungan = dbo.tc_kunjungan.no_kunjungan
WHERE     (dbo.tc_pemeriksaan_erm.no_kunjungan IS NOT NULL) AND (dbo.tc_pemeriksaan_erm.no_registrasi = N' ')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_tc_pemeriksaan_v]");
    }
};
