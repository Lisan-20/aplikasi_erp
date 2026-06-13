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
        DB::statement("CREATE VIEW dbo.rl_1_3_v
AS
SELECT     YEAR(dbo.tc_kunjungan.tgl_keluar) AS thn, dbo.tc_kunjungan.kode_bagian_tujuan, dbo.mt_bagian.nama_bagian AS tujuan, COUNT(dbo.tc_kunjungan.no_registrasi) AS jml_pasien
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.mt_bagian ON dbo.tc_kunjungan.kode_bagian_tujuan = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.ri_tc_riwayat_kelas ON dbo.tc_kunjungan.no_registrasi = dbo.ri_tc_riwayat_kelas.no_registrasi LEFT OUTER JOIN
                      dbo.mt_bagian AS mt_bagian_1 ON dbo.tc_kunjungan.kode_bagian_asal = mt_bagian_1.kode_bagian
GROUP BY YEAR(dbo.tc_kunjungan.tgl_keluar), dbo.tc_kunjungan.kode_bagian_tujuan, dbo.mt_bagian.nama_bagian
HAVING      (NOT (YEAR(dbo.tc_kunjungan.tgl_keluar) IS NULL)) AND (NOT (dbo.mt_bagian.nama_bagian IS NULL))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rl_1_3_v]");
    }
};
