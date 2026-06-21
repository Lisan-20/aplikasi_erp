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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_pengirim_pm_v
AS
SELECT     dbo.mt_karyawan.kode_dokter, dbo.mt_master_pasien.no_mr, dbo.mt_master_pasien.nama_pasien, dbo.tc_kunjungan.no_registrasi, dbo.tc_trans_pelayanan.nama_tindakan AS tindakan, 
                      dbo.pm_tc_penunjang.kode_penunjang, dbo.pm_tc_penunjang.tgl_daftar, dbo.pm_tc_penunjang.kode_bagian, dbo.pm_tc_penunjang.no_kunjungan, dbo.pm_tc_penunjang.dr_pengirim, 
                      dbo.pm_tc_penunjang.kode_dr_pengirim, dbo.pm_tc_penunjang.status_batal
FROM         dbo.pm_tc_penunjang INNER JOIN
                      dbo.mt_karyawan ON dbo.pm_tc_penunjang.dr_pengirim = dbo.mt_karyawan.nama_pegawai INNER JOIN
                      dbo.tc_kunjungan ON dbo.pm_tc_penunjang.no_kunjungan = dbo.tc_kunjungan.no_kunjungan INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_kunjungan.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.pm_tc_penunjang.kode_penunjang = dbo.tc_trans_pelayanan.kode_penunjang
GROUP BY dbo.mt_karyawan.kode_dokter, dbo.mt_master_pasien.no_mr, dbo.mt_master_pasien.nama_pasien, dbo.tc_kunjungan.no_registrasi, dbo.tc_trans_pelayanan.nama_tindakan, 
                      dbo.pm_tc_penunjang.kode_penunjang, dbo.pm_tc_penunjang.tgl_daftar, dbo.pm_tc_penunjang.kode_bagian, dbo.pm_tc_penunjang.no_kunjungan, dbo.pm_tc_penunjang.dr_pengirim, 
                      dbo.pm_tc_penunjang.kode_dr_pengirim, dbo.pm_tc_penunjang.status_batal
HAVING      (NOT (dbo.tc_trans_pelayanan.nama_tindakan LIKE 'admin%'))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_pengirim_pm_v]");
    }
};
