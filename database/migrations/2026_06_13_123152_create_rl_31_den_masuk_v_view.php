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
        DB::statement("CREATE VIEW dbo.rl_31_den_masuk_v
AS
SELECT     COUNT(dbo.tc_registrasi.no_registrasi) AS jml, dbo.ri_tc_rawatinap.bag_pas, dbo.tc_registrasi.status_batal, YEAR(dbo.tc_registrasi.tgl_jam_masuk) AS thn, 
                      MONTH(dbo.tc_registrasi.tgl_jam_masuk) AS bln, dbo.tc_kunjungan.kode_bagian_asal AS kode_bagian, dbo.tc_kunjungan.no_registrasi, dbo.ri_tc_rawatinap.kelas_pas AS kode_klas, 
                      dbo.ri_tc_rawatinap.status_pulang, dbo.tc_kunjungan.status_batal AS batal, dbo.tc_trans_pelayanan_hari_rawat_v.hari_rawat, dbo.ri_tc_riwayat_kelas.ket_masuk, 
                      dbo.tc_registrasi.tgl_jam_masuk AS tgl_masuk
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.ri_tc_rawatinap ON dbo.tc_kunjungan.no_kunjungan = dbo.ri_tc_rawatinap.no_kunjungan INNER JOIN
                      dbo.tc_trans_pelayanan_hari_rawat_v ON dbo.tc_kunjungan.no_kunjungan = dbo.tc_trans_pelayanan_hari_rawat_v.no_kunjungan INNER JOIN
                      dbo.ri_tc_riwayat_kelas ON dbo.ri_tc_rawatinap.kode_ri = dbo.ri_tc_riwayat_kelas.kode_ri AND dbo.ri_tc_rawatinap.kode_ruangan = dbo.ri_tc_riwayat_kelas.kode_ruangan
GROUP BY dbo.ri_tc_rawatinap.bag_pas, dbo.tc_registrasi.status_batal, YEAR(dbo.tc_registrasi.tgl_jam_masuk), MONTH(dbo.tc_registrasi.tgl_jam_masuk), dbo.tc_kunjungan.kode_bagian_asal, 
                      dbo.tc_kunjungan.no_registrasi, dbo.ri_tc_rawatinap.kelas_pas, dbo.ri_tc_rawatinap.status_pulang, dbo.tc_kunjungan.status_batal, dbo.tc_trans_pelayanan_hari_rawat_v.hari_rawat, 
                      dbo.ri_tc_riwayat_kelas.ket_masuk, dbo.tc_registrasi.tgl_jam_masuk
HAVING      (dbo.tc_registrasi.status_batal IS NULL) AND (dbo.tc_kunjungan.status_batal IS NULL) AND (YEAR(dbo.tc_registrasi.tgl_jam_masuk) >= 2014) AND (dbo.ri_tc_riwayat_kelas.ket_masuk IN (1, 0))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rl_31_den_masuk_v]");
    }
};
