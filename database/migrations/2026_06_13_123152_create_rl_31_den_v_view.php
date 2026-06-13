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
        DB::statement("CREATE VIEW dbo.rl_31_den_v
AS
SELECT     COUNT(dbo.tc_registrasi.no_registrasi) AS jml, dbo.ri_tc_rawatinap.bag_pas, dbo.tc_registrasi.status_batal, YEAR(dbo.tc_registrasi.tgl_jam_masuk) AS thn, 
                      MONTH(dbo.tc_registrasi.tgl_jam_masuk) AS bln, YEAR(dbo.tc_kunjungan.tgl_keluar) AS thn_plg, MONTH(dbo.tc_kunjungan.tgl_keluar) AS bln_plg, 
                      dbo.tc_kunjungan.kode_bagian_asal AS kode_bagian, dbo.tc_kunjungan.no_registrasi, dbo.ri_tc_rawatinap.kelas_pas AS kode_klas, 
                      dbo.ri_tc_rawatinap.status_pulang, dbo.ri_tc_riwayat_klas_v.ket_keluar AS status_hidup, dbo.tc_kunjungan.status_batal AS batal, 
                      dbo.tc_trans_pelayanan_hari_rawat_v.hari_rawat
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.ri_tc_riwayat_klas_v ON dbo.tc_registrasi.no_registrasi = dbo.ri_tc_riwayat_klas_v.no_registrasi INNER JOIN
                      dbo.ri_tc_rawatinap ON dbo.tc_kunjungan.no_kunjungan = dbo.ri_tc_rawatinap.no_kunjungan INNER JOIN
                      dbo.tc_trans_pelayanan_hari_rawat_v ON dbo.tc_kunjungan.no_kunjungan = dbo.tc_trans_pelayanan_hari_rawat_v.no_kunjungan
GROUP BY dbo.ri_tc_rawatinap.bag_pas, dbo.tc_registrasi.status_batal, YEAR(dbo.tc_registrasi.tgl_jam_masuk), MONTH(dbo.tc_registrasi.tgl_jam_masuk), 
                      YEAR(dbo.tc_kunjungan.tgl_keluar), MONTH(dbo.tc_kunjungan.tgl_keluar), dbo.tc_kunjungan.kode_bagian_asal, dbo.tc_kunjungan.no_registrasi, 
                      dbo.ri_tc_rawatinap.kelas_pas, dbo.ri_tc_rawatinap.status_pulang, dbo.ri_tc_riwayat_klas_v.ket_keluar, dbo.tc_kunjungan.status_batal, 
                      dbo.tc_trans_pelayanan_hari_rawat_v.hari_rawat
HAVING      (dbo.tc_registrasi.status_batal IS NULL) AND (dbo.tc_kunjungan.status_batal IS NULL) AND (YEAR(dbo.tc_registrasi.tgl_jam_masuk) >= 2014)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rl_31_den_v]");
    }
};
