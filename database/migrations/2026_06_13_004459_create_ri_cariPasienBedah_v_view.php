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
        DB::statement("CREATE OR ALTER VIEW dbo.ri_cariPasienBedah_v
AS
SELECT     dbo.mt_master_pasien.no_mr, dbo.mt_master_pasien.nama_pasien, dbo.tc_registrasi.no_registrasi, dbo.tc_kunjungan.no_kunjungan, dbo.ri_tc_riwayat_kelas.bagian_tujuan, 
                      dbo.ri_tc_riwayat_kelas.kelas_tujuan, dbo.ri_tc_riwayat_kelas.no_kamar_tujuan, dbo.ri_tc_riwayat_kelas.no_bed_tujuan, dbo.ri_tc_rawatinap.kode_ri, dbo.ri_tc_rawatinap.status_pulang, 
                      dbo.ri_tc_riwayat_kelas.kode_ruangan, dbo.tc_registrasi.kode_kelompok, dbo.ri_tc_riwayat_kelas.ket_pindah, dbo.ri_tc_riwayat_kelas.kode_riw_klas, dbo.tc_registrasi.kode_perusahaan, 
                      dbo.ri_tc_riwayat_kelas.tgl_masuk, dbo.tc_registrasi.umur, dbo.mt_master_pasien.tgl_lhr, dbo.tc_registrasi.stat_pasien, dbo.ri_tc_riwayat_kelas.tgl_pindah
FROM         dbo.ri_tc_rawatinap INNER JOIN
                      dbo.ri_tc_riwayat_kelas ON dbo.ri_tc_rawatinap.kode_ri = dbo.ri_tc_riwayat_kelas.kode_ri INNER JOIN
                      dbo.tc_registrasi ON dbo.ri_tc_riwayat_kelas.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.tc_kunjungan ON dbo.ri_tc_rawatinap.no_kunjungan = dbo.tc_kunjungan.no_kunjungan AND dbo.tc_registrasi.no_registrasi = dbo.tc_kunjungan.no_registrasi INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_registrasi.no_mr = dbo.mt_master_pasien.no_mr
WHERE     (dbo.ri_tc_rawatinap.status_pulang = 0) AND (dbo.ri_tc_riwayat_kelas.ket_pindah IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ri_cariPasienBedah_v]");
    }
};
