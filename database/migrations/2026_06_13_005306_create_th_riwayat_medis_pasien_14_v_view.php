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
        DB::statement("CREATE OR ALTER VIEW dbo.th_riwayat_medis_pasien_14_v
AS
SELECT     dbo.tc_registrasi.no_mr, dbo.tc_registrasi.tgl_jam_inv_fisio AS tgl_jam, dbo.tc_registrasi.kode_dokter, mt_karyawan_1.nama_pegawai, dbo.tc_registrasi.st_ass_inv_fisio AS st_ass, 
                      dbo.mt_karyawan.nama_pegawai AS nama_perawat, 14 AS flag, dbo.tc_registrasi.no_registrasi
FROM         dbo.tc_registrasi LEFT OUTER JOIN
                      dbo.mt_karyawan ON dbo.tc_registrasi.id_user_inv_fisio = dbo.mt_karyawan.no_induk LEFT OUTER JOIN
                      dbo.mt_karyawan AS mt_karyawan_1 ON dbo.tc_registrasi.kode_dokter = mt_karyawan_1.kode_dokter
WHERE     (dbo.tc_registrasi.status_batal IS NULL) AND (dbo.tc_registrasi.st_ass_inv_fisio = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [th_riwayat_medis_pasien_14_v]");
    }
};
