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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_pemesanan_gizi_v
AS
SELECT     dbo.ri_cari_pasien_v.no_mr, dbo.ri_cari_pasien_v.no_registrasi, dbo.ri_cari_pasien_v.no_kunjungan, dbo.ri_cari_pasien_v.kode_ri, 
                      dbo.ri_cari_pasien_v.nama_pasien, dbo.ri_cari_pasien_v.kode_ruangan, dbo.ri_cari_pasien_v.bag_pas, dbo.ri_cari_pasien_v.kelas_pas, 
                      dbo.ri_cari_pasien_v.tgl_masuk, dbo.ri_cari_pasien_v.dr_merawat, dbo.ri_cari_pasien_v.asal_pasien, dbo.ri_cari_pasien_v.bag_ibu, 
                      dbo.ri_cari_pasien_v.kelas_ibu, dbo.ri_cari_pasien_v.gol_darah, dbo.ri_cari_pasien_v.alergi, dbo.ri_cari_pasien_v.tgl_lhr, 
                      dbo.ri_cari_pasien_v.jen_kelamin, dbo.ri_cari_pasien_v.almt_ttp_pasien, dbo.ri_cari_pasien_v.tgl_keluar, dbo.ri_cari_pasien_v.status_pulang, 
                      dbo.ri_cari_pasien_v.status_cuti, dbo.ri_cari_pasien_v.status_registrasi, dbo.ri_cari_pasien_v.kode_perusahaan, 
                      dbo.ri_cari_pasien_v.kode_kelompok, dbo.ri_cari_pasien_v.no_jkn, dbo.ri_cari_pasien_v.kode_plafon, dbo.ri_cari_pasien_v.plafon_bpjs, 
                      dbo.ri_cari_pasien_v.diagnosa_awal, dbo.ri_cari_pasien_v.icd10, dbo.ri_cari_pasien_v.icd9, dbo.ri_cari_pasien_v.jatah_klas, 
                      dbo.tc_pemesanan_gizi.id_tc_pemesanan, dbo.tc_pemesanan_gizi.tgl_pesan, dbo.tc_pemesanan_gizi.status, dbo.tc_pemesanan_gizi.no_pesan, 
                      dbo.tc_pemesanan_gizi.user_pesan, COUNT(dbo.tc_pemesanan_gizi_det.id_tc_pemesanan_det) AS jumlah, 
                      SUM(dbo.tc_pemesanan_gizi_det.harga_jual) AS harga_jual, dbo.tc_pemesanan_gizi.id_tc_sensus_gizi
FROM         dbo.tc_pemesanan_gizi_det INNER JOIN
                      dbo.tc_pemesanan_gizi ON dbo.tc_pemesanan_gizi_det.id_tc_pemesanan = dbo.tc_pemesanan_gizi.id_tc_pemesanan INNER JOIN
                      dbo.ri_cari_pasien_v ON dbo.tc_pemesanan_gizi.no_registrasi = dbo.ri_cari_pasien_v.no_registrasi
GROUP BY dbo.ri_cari_pasien_v.no_mr, dbo.ri_cari_pasien_v.no_registrasi, dbo.ri_cari_pasien_v.no_kunjungan, dbo.ri_cari_pasien_v.kode_ri, 
                      dbo.ri_cari_pasien_v.nama_pasien, dbo.ri_cari_pasien_v.kode_ruangan, dbo.ri_cari_pasien_v.bag_pas, dbo.ri_cari_pasien_v.kelas_pas, 
                      dbo.ri_cari_pasien_v.tgl_masuk, dbo.ri_cari_pasien_v.dr_merawat, dbo.ri_cari_pasien_v.asal_pasien, dbo.ri_cari_pasien_v.bag_ibu, 
                      dbo.ri_cari_pasien_v.kelas_ibu, dbo.ri_cari_pasien_v.gol_darah, dbo.ri_cari_pasien_v.alergi, dbo.ri_cari_pasien_v.tgl_lhr, 
                      dbo.ri_cari_pasien_v.jen_kelamin, dbo.ri_cari_pasien_v.almt_ttp_pasien, dbo.ri_cari_pasien_v.tgl_keluar, dbo.ri_cari_pasien_v.status_pulang, 
                      dbo.ri_cari_pasien_v.status_cuti, dbo.ri_cari_pasien_v.status_registrasi, dbo.ri_cari_pasien_v.kode_perusahaan, 
                      dbo.ri_cari_pasien_v.kode_kelompok, dbo.ri_cari_pasien_v.no_jkn, dbo.ri_cari_pasien_v.kode_plafon, dbo.ri_cari_pasien_v.plafon_bpjs, 
                      dbo.ri_cari_pasien_v.diagnosa_awal, dbo.ri_cari_pasien_v.icd10, dbo.ri_cari_pasien_v.icd9, dbo.ri_cari_pasien_v.jatah_klas, 
                      dbo.tc_pemesanan_gizi.id_tc_pemesanan, dbo.tc_pemesanan_gizi.tgl_pesan, dbo.tc_pemesanan_gizi.status, dbo.tc_pemesanan_gizi.no_pesan, 
                      dbo.tc_pemesanan_gizi.user_pesan, dbo.tc_pemesanan_gizi.id_tc_sensus_gizi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_pemesanan_gizi_v]");
    }
};
