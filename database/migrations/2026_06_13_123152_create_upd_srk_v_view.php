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
        DB::statement("CREATE VIEW dbo.upd_srk_v
AS
SELECT     dbo.tc_registrasi.no_registrasi, dbo.tc_registrasi.noRujukan, dbo.tc_kontrol_bpjs.noSuratKontrol, dbo.tc_registrasi.tgl_jam_masuk, dbo.tc_kontrol_bpjs.tglRencanaKontrol, 
                      dbo.mt_master_pasien.no_askes, dbo.tc_kontrol_bpjs.noKartu, dbo.tc_registrasi.no_mr, dbo.tc_registrasi.flag_daftar, dbo.tc_registrasi.status_batal, dbo.tc_kontrol_bpjs.poli, 
                      dbo.tc_kontrol_bpjs.tgl_input, dbo.tc_kontrol_bpjs.flag_hapus_kontrol
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_registrasi.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.tc_kontrol_bpjs ON dbo.mt_master_pasien.no_askes = dbo.tc_kontrol_bpjs.noKartu AND CONVERT(varchar, dbo.tc_registrasi.tgl_jam_masuk, 105) = CONVERT(varchar, 
                      dbo.tc_kontrol_bpjs.tglRencanaKontrol, 105)
WHERE     (dbo.tc_registrasi.status_batal IS NULL) AND (dbo.tc_registrasi.tgl_jam_masuk >= GETDATE()) AND (dbo.tc_kontrol_bpjs.flag_hapus_kontrol IS NULL) AND (dbo.tc_registrasi.noRujukan IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [upd_srk_v]");
    }
};
