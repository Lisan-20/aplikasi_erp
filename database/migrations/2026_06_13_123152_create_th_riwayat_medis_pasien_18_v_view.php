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
        DB::statement("CREATE VIEW dbo.th_riwayat_medis_pasien_18_v
AS
SELECT     dbo.tc_cppt.no_mr, dbo.tc_cppt.tgl_jam, dbo.tc_cppt.kode_dokter, mt_karyawan_1.nama_pegawai, 1 AS st_ass, dbo.mt_karyawan.nama_pegawai AS nama_perawat, 18 AS flag, 
                      dbo.tc_cppt.no_registrasi
FROM         dbo.tc_cppt LEFT OUTER JOIN
                      dbo.mt_karyawan ON dbo.tc_cppt.user_id = dbo.mt_karyawan.no_induk LEFT OUTER JOIN
                      dbo.mt_karyawan AS mt_karyawan_1 ON dbo.tc_cppt.kode_dokter = mt_karyawan_1.kode_dokter
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [th_riwayat_medis_pasien_18_v]");
    }
};
