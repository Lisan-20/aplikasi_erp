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
        DB::statement("CREATE OR ALTER VIEW dbo.riwayat_status_unit_v
AS
SELECT     dbo.tc_kunjungan.no_kunjungan, dbo.tc_kunjungan.no_registrasi, dbo.tc_kunjungan.no_mr, dbo.tc_riwayat_status.tgl_upd, dbo.tc_riwayat_status.user_upd, 
                      dbo.tc_kunjungan.status_batal, dbo.tc_riwayat_status.kode_bagian_kirim, dbo.tc_riwayat_status.kode_bagian_terima, dbo.tc_riwayat_status.user_terima, 
                      dbo.tc_riwayat_status.user_kirim, dbo.tc_riwayat_status.status, dbo.tc_kunjungan.kode_bagian_tujuan, dbo.tc_kunjungan.kode_bagian_asal, 
                      dbo.tc_kunjungan.tgl_masuk, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.flag_p2d
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi LEFT OUTER JOIN
                      dbo.tc_riwayat_status ON dbo.tc_kunjungan.no_kunjungan = dbo.tc_riwayat_status.no_kunjungan AND 
                      dbo.tc_kunjungan.no_registrasi = dbo.tc_riwayat_status.no_registrasi
WHERE     (dbo.tc_kunjungan.status_batal IS NULL) AND (dbo.tc_registrasi.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [riwayat_status_unit_v]");
    }
};
