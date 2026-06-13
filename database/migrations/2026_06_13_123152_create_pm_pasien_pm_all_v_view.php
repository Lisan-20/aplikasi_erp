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
        DB::statement("CREATE VIEW dbo.pm_pasien_pm_all_v
AS
SELECT     dbo.tc_registrasi.status_batal, dbo.tc_registrasi.stat_pasien, dbo.tc_kunjungan.no_kunjungan, dbo.tc_kunjungan.kode_bagian_tujuan, 
                      dbo.tc_kunjungan.kode_bagian_asal, dbo.tc_kunjungan.tgl_masuk, dbo.tc_kunjungan.tgl_keluar, dbo.tc_kunjungan.status_masuk, dbo.tc_kunjungan.status_keluar, 
                      dbo.tc_kunjungan.status_cito, dbo.tc_kunjungan.keterangan, dbo.pm_tc_penunjang.kode_penunjang, dbo.pm_tc_penunjang.tgl_daftar, 
                      dbo.pm_tc_penunjang.kode_bagian, dbo.pm_tc_penunjang.no_antrian, dbo.pm_tc_penunjang.tgl_isihasil, dbo.pm_tc_penunjang.no_foto, 
                      dbo.pm_tc_penunjang.dr_pengirim, dbo.pm_tc_penunjang.petugas_input, dbo.pm_tc_penunjang.status_daftar, dbo.pm_tc_penunjang.radiografer, 
                      dbo.pm_tc_penunjang.petugas_isihasil, dbo.pm_tc_penunjang.catatan_hasil, dbo.pm_tc_penunjang.status_isihasil, dbo.tc_registrasi.no_induk, 
                      dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.no_registrasi, dbo.pm_tc_penunjang.kode_klas, dbo.pm_tc_penunjang.no_hasil_pm, 
                      dbo.pm_tc_penunjang.status_bayar, dbo.tc_registrasi.kode_kelompok
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_registrasi.no_registrasi = dbo.tc_kunjungan.no_registrasi INNER JOIN
                      dbo.pm_tc_penunjang ON dbo.tc_kunjungan.no_kunjungan = dbo.pm_tc_penunjang.no_kunjungan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pm_pasien_pm_all_v]");
    }
};
