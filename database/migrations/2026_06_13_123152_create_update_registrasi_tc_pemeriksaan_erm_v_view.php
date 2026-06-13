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
        DB::statement("CREATE OR ALTER VIEW dbo.update_registrasi_tc_pemeriksaan_erm_v
AS
SELECT     dbo.tc_pemeriksaan_erm.no_kunjungan, dbo.tc_pemeriksaan_erm.no_registrasi, dbo.tc_kunjungan_srv_back_v.no_registrasi AS no_registrasi_up, dbo.tc_pemeriksaan_erm.kode_tc_periksa
FROM         dbo.tc_pemeriksaan_erm INNER JOIN
                      dbo.tc_kunjungan_srv_back_v ON dbo.tc_pemeriksaan_erm.no_kunjungan = dbo.tc_kunjungan_srv_back_v.no_kunjungan
WHERE     (dbo.tc_pemeriksaan_erm.no_registrasi = ' ')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_registrasi_tc_pemeriksaan_erm_v]");
    }
};
