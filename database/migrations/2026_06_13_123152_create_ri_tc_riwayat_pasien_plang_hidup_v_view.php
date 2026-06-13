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
        DB::statement("CREATE VIEW dbo.ri_tc_riwayat_pasien_plang_hidup_v
AS
SELECT     dbo.mt_master_pasien.no_mr, dbo.tc_registrasi.no_registrasi, dbo.tc_kunjungan.no_kunjungan, dbo.ri_tc_rawatinap.kode_ri, dbo.mt_master_pasien.nama_pasien, 
                      dbo.ri_tc_rawatinap.kode_ruangan, dbo.ri_tc_rawatinap.bag_pas AS kode_pelayanan, dbo.ri_tc_rawatinap.kelas_pas, dbo.ri_tc_rawatinap.tgl_masuk, dbo.ri_tc_rawatinap.dr_merawat, 
                      dbo.ri_tc_rawatinap.asal_pasien, dbo.ri_tc_rawatinap.bag_ibu, dbo.ri_tc_rawatinap.kelas_ibu, dbo.mt_master_pasien.gol_darah, dbo.mt_master_pasien.alergi, dbo.mt_master_pasien.tgl_lhr, 
                      dbo.mt_master_pasien.jen_kelamin, dbo.mt_master_pasien.almt_ttp_pasien, dbo.ri_tc_rawatinap.tgl_keluar, dbo.ri_tc_rawatinap.status_pulang, dbo.tc_registrasi.kode_perusahaan, 
                      dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.status_batal, dbo.tc_registrasi.tgl_jam_masuk, dbo.tc_kunjungan.tgl_keluar AS Expr1, YEAR(dbo.tc_kunjungan.tgl_keluar) AS tahun, 1 AS jumlah, 
                      dbo.ri_tc_riwayat_kelas.kode_kematian, dbo.ri_tc_riwayat_kelas.ket_keluar, MONTH(dbo.tc_kunjungan.tgl_keluar) AS bln, dbo.tc_registrasi.kode_bagian_masuk
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.ri_tc_rawatinap ON dbo.tc_kunjungan.no_kunjungan = dbo.ri_tc_rawatinap.no_kunjungan INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_registrasi.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.ri_tc_riwayat_kelas ON dbo.ri_tc_rawatinap.kode_ri = dbo.ri_tc_riwayat_kelas.kode_ri AND dbo.ri_tc_rawatinap.kode_ruangan = dbo.ri_tc_riwayat_kelas.kode_ruangan
WHERE     (dbo.tc_registrasi.status_batal IS NULL) AND (dbo.ri_tc_rawatinap.status_pulang = 1) AND (dbo.ri_tc_riwayat_kelas.ket_keluar IN (3, 2)) AND (YEAR(dbo.tc_kunjungan.tgl_keluar) >= 2014)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ri_tc_riwayat_pasien_plang_hidup_v]");
    }
};
