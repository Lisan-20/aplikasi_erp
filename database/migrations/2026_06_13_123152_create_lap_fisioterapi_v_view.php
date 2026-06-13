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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_fisioterapi_v
AS
SELECT     TOP (100) PERCENT DAY(dbo.tc_kunjungan.tgl_keluar) AS tgl, MONTH(dbo.tc_kunjungan.tgl_keluar) AS bln, YEAR(dbo.tc_kunjungan.tgl_keluar) AS thn, 
                      dbo.tc_kunjungan.no_kunjungan, dbo.tc_kunjungan.kode_bagian_tujuan, dbo.tc_kunjungan.no_registrasi, dbo.tc_kunjungan.no_mr, 
                      dbo.tc_kunjungan.kode_dokter, dbo.tc_registrasi.stat_pasien, dbo.tc_kunjungan.status_batal, dbo.tc_registrasi.kode_kelompok, 
                      dbo.tc_kunjungan.tgl_masuk, dbo.tc_kunjungan.tgl_keluar, mt_karyawan_1.nama_pegawai, dbo.mt_master_pasien.almt_ttp_pasien, 
                      dbo.mt_master_pasien.tlp_almt_ttp, dbo.dd_user.no_induk, dbo.dd_user.username, dbo.fisioterapis_v.kode_dokter1, 
                      mt_karyawan_2.nama_pegawai AS fisioterapis
FROM         dbo.mt_karyawan AS mt_karyawan_2 RIGHT OUTER JOIN
                      dbo.pm_tc_penunjang INNER JOIN
                      dbo.tc_kunjungan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_kunjungan.no_mr = dbo.mt_master_pasien.no_mr ON 
                      dbo.pm_tc_penunjang.no_kunjungan = dbo.tc_kunjungan.no_kunjungan LEFT OUTER JOIN
                      dbo.fisioterapis_v ON dbo.pm_tc_penunjang.kode_penunjang = dbo.fisioterapis_v.kode_penunjang ON 
                      mt_karyawan_2.kode_dokter = dbo.fisioterapis_v.kode_dokter1 LEFT OUTER JOIN
                      dbo.dd_user ON dbo.pm_tc_penunjang.petugas_input = dbo.dd_user.no_induk LEFT OUTER JOIN
                      dbo.mt_karyawan AS mt_karyawan_1 ON dbo.tc_kunjungan.kode_dokter = mt_karyawan_1.kode_dokter
WHERE     (dbo.tc_kunjungan.status_batal IS NULL) AND (dbo.tc_kunjungan.kode_bagian_tujuan = '050301')
ORDER BY dbo.tc_kunjungan.tgl_keluar DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_fisioterapi_v]");
    }
};
