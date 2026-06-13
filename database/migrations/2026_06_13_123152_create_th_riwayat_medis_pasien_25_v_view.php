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
        DB::statement("CREATE VIEW dbo.th_riwayat_medis_pasien_25_v
AS
SELECT     dbo.tc_emr_form.no_mr, dbo.tc_emr_form.tgl_update AS tgl_jam, dbo.tc_emr_form.id_user_imp AS kode_dokter, mt_karyawan_1.nama_pegawai, 1 AS st_ass, 
                      dbo.mt_karyawan.nama_pegawai AS nama_perawat, 25 AS flag, dbo.tc_emr_form.no_registrasi
FROM         dbo.mt_karyawan RIGHT OUTER JOIN
                      dbo.tc_emr_form ON dbo.tc_emr_form.id_user = dbo.mt_karyawan.no_induk LEFT OUTER JOIN
                      dbo.mt_karyawan AS mt_karyawan_1 ON mt_karyawan_1.no_induk = dbo.tc_emr_form.id_user
WHERE     (dbo.tc_emr_form.kode_rm = 154)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [th_riwayat_medis_pasien_25_v]");
    }
};
