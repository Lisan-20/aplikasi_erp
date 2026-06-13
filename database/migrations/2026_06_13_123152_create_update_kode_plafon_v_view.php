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
        DB::statement("CREATE VIEW dbo.update_kode_plafon_v
AS
SELECT     dbo.tc_registrasi.kode_plafon, dbo.tc_registrasi.status_batal, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.no_registrasi, dbo.tc_registrasi.tgl_jam_keluar, 
                      dbo.ri_tc_riwayat_kelas.bagian_tujuan
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.ri_tc_riwayat_kelas ON dbo.tc_registrasi.no_registrasi = dbo.ri_tc_riwayat_kelas.no_registrasi
WHERE     (dbo.tc_registrasi.status_batal IS NULL) AND (NOT (dbo.tc_registrasi.kode_kelompok IN (1, 3, 5))) AND (NOT (dbo.tc_registrasi.tgl_jam_keluar IS NULL)) AND 
                      (dbo.tc_registrasi.no_registrasi NOT IN
                          (SELECT     no_registrasi
                            FROM          dbo.ri_tc_riwayat_kelas AS ri_tc_riwayat_kelas_1
                            WHERE      (bagian_tujuan IN (031001)))) AND (dbo.tc_registrasi.kode_plafon IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_kode_plafon_v]");
    }
};
