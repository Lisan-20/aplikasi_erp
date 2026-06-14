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
        DB::statement("CREATE OR ALTER VIEW dbo.pasien_setuju_1sehat_v
AS
SELECT     TOP (1) dbo.tc_registrasi.no_registrasi, dbo.tc_registrasi.no_mr, dbo.tc_registrasi.tgl_jam_masuk, dbo.tc_registrasi.kode_dokter, dbo.mt_karyawan.no_ktp AS ktp_dokter, 
                      dbo.mt_master_pasien.no_ktp AS ktp_pasien, dbo.tc_registrasi.tgl_jam_keluar, dbo.mt_master_pasien.nama_pasien, dbo.tc_registrasi.kode_bagian_masuk, dbo.tc_registrasi.kode_bagian_keluar, 
                      YEAR(dbo.tc_registrasi.tgl_jam_keluar) AS Expr1, dbo.mt_karyawan.nama_pegawai, DATEADD(DD, - 2, GETDATE()) AS Expr2, dbo.tc_registrasi.flag_ver_erm, 
                      dbo.th_kirim_1sehat.no_registrasi AS Expr3
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.mt_karyawan ON dbo.tc_registrasi.kode_dokter = dbo.mt_karyawan.kode_dokter INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_registrasi.no_mr = dbo.mt_master_pasien.no_mr LEFT OUTER JOIN
                      dbo.th_kirim_1sehat ON dbo.tc_registrasi.no_registrasi = dbo.th_kirim_1sehat.no_registrasi
WHERE     (dbo.mt_master_pasien.no_ktp > '0') AND (dbo.tc_registrasi.kode_bagian_keluar LIKE '01%') AND (YEAR(dbo.tc_registrasi.tgl_jam_keluar) = 2024) AND (dbo.mt_karyawan.no_ktp IS NOT NULL) AND 
                      (dbo.mt_karyawan.no_ktp <> '') AND (dbo.tc_registrasi.tgl_jam_keluar <= DATEADD(DD, - 2, GETDATE())) AND (dbo.th_kirim_1sehat.no_registrasi IS NULL)
ORDER BY dbo.tc_registrasi.tgl_jam_masuk DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pasien_setuju_1sehat_v]");
    }
};
