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
        DB::statement("CREATE OR ALTER VIEW dbo.upd_noRujukan_v
AS
SELECT     dbo.tc_registrasi.no_registrasi, dbo.tc_registrasi.tgl_jam_masuk, dbo.tc_kontrol_bpjs.tglRencanaKontrol, dbo.tc_kontrol_bpjs.noSuratKontrol, dbo.tc_registrasi.noRujukan, 
                      dbo.tc_registrasi.flag_daftar
FROM         dbo.tc_kontrol_bpjs INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kontrol_bpjs.noKartu = dbo.tc_registrasi.no_jaminan AND dbo.tc_kontrol_bpjs.tglRencanaKontrol = dbo.tc_registrasi.tgl_jam_masuk
WHERE     (dbo.tc_registrasi.flag_daftar = 15) AND (dbo.tc_registrasi.noRujukan IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_noRujukan_v]");
    }
};
