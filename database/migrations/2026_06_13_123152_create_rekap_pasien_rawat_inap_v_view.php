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
        DB::statement("CREATE VIEW dbo.rekap_pasien_rawat_inap_v
AS
SELECT        TOP (100) PERCENT dbo.ri_tc_riwayat_kelas.no_mr, dbo.ri_tc_riwayat_kelas.no_registrasi, dbo.mt_master_pasien.nama_pasien, dbo.ri_tc_riwayat_kelas.bagian_tujuan, dbo.ri_tc_riwayat_kelas.kelas_tujuan, 
                         dbo.ri_tc_riwayat_kelas.bagian_asal, dbo.tc_registrasi.umur, dbo.tc_registrasi.diagnosa, dbo.mt_master_pasien.jen_kelamin, dbo.ri_tc_riwayat_kelas.tgl_masuk, dbo.ri_tc_riwayat_kelas.tgl_pindah, 
                         dbo.ri_tc_riwayat_kelas.ket_keluar, 3 AS status, dbo.mt_bagian.kode_depo_bag AS group_tujuan, DAY(dbo.ri_tc_riwayat_kelas.tgl_pindah) AS tgl_klr, MONTH(dbo.ri_tc_riwayat_kelas.tgl_pindah) AS bln_klr, 
                         YEAR(dbo.ri_tc_riwayat_kelas.tgl_pindah) AS thn_klr, dbo.ri_tc_riwayat_kelas.kode_kematian, dbo.ri_tc_riwayat_kelas.no_kamar_asal, dbo.ri_tc_riwayat_kelas.no_kamar_tujuan, dbo.tc_registrasi.tgl_jam_masuk,
                          dbo.tc_registrasi.tgl_jam_keluar
FROM            dbo.ri_tc_riwayat_kelas INNER JOIN
                         dbo.ri_tc_rawatinap ON dbo.ri_tc_riwayat_kelas.kode_ri = dbo.ri_tc_rawatinap.kode_ri INNER JOIN
                         dbo.mt_master_pasien ON dbo.ri_tc_riwayat_kelas.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                         dbo.tc_kunjungan ON dbo.ri_tc_rawatinap.no_kunjungan = dbo.tc_kunjungan.no_kunjungan INNER JOIN
                         dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                         dbo.mt_bagian ON dbo.ri_tc_riwayat_kelas.bagian_tujuan = dbo.mt_bagian.kode_bagian
WHERE        (dbo.tc_kunjungan.status_batal IS NULL)
ORDER BY dbo.ri_tc_riwayat_kelas.tgl_masuk DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [rekap_pasien_rawat_inap_v]");
    }
};
