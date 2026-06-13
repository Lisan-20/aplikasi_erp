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
        DB::statement("CREATE VIEW dbo.ri_tc_riwayat_kelas_v
AS
SELECT     dbo.ri_tc_riwayat_kelas.kode_riw_klas, dbo.ri_tc_riwayat_kelas.kode_ri, dbo.ri_tc_riwayat_kelas.kode_kunjungan, dbo.ri_tc_riwayat_kelas.no_registrasi, 
                      dbo.ri_tc_riwayat_kelas.no_mr, dbo.ri_tc_riwayat_kelas.kode_kelompok, dbo.ri_tc_riwayat_kelas.kode_perusahaan, dbo.ri_tc_riwayat_kelas.kode_dokter, 
                      dbo.ri_tc_riwayat_kelas.kode_ruangan, dbo.ri_tc_riwayat_kelas.bagian_tujuan, dbo.ri_tc_riwayat_kelas.kelas_tujuan, dbo.ri_tc_riwayat_kelas.no_kamar_tujuan, 
                      dbo.ri_tc_riwayat_kelas.no_bed_tujuan, dbo.ri_tc_riwayat_kelas.bagian_asal, dbo.ri_tc_riwayat_kelas.kelas_asal, dbo.ri_tc_riwayat_kelas.no_kamar_asal, 
                      dbo.ri_tc_riwayat_kelas.no_bed_asal, dbo.ri_tc_riwayat_kelas.harga, dbo.ri_tc_riwayat_kelas.tgl_masuk, dbo.ri_tc_riwayat_kelas.tgl_pindah, 
                      dbo.ri_tc_riwayat_kelas.ket_masuk, dbo.ri_tc_riwayat_kelas.ket_pindah, dbo.ri_tc_riwayat_kelas.ket_keluar, dbo.th_icd10_pasien.status_hidup, 
                      dbo.ri_tc_riwayat_kelas.kode_kematian, dbo.ri_tc_riwayat_kelas.waktu_kematian, dbo.ri_tc_riwayat_kelas.no_kamar_asli, dbo.ri_tc_riwayat_kelas.no_bed_asli, 
                      dbo.ri_tc_riwayat_kelas.flagtitip
FROM         dbo.ri_tc_riwayat_kelas INNER JOIN
                      dbo.th_icd10_pasien ON dbo.ri_tc_riwayat_kelas.no_registrasi = dbo.th_icd10_pasien.no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ri_tc_riwayat_kelas_v]");
    }
};
