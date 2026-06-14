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
        DB::statement("CREATE OR ALTER VIEW dbo.daftar_pasien_ri_v
AS
SELECT     TOP (100) PERCENT dbo.ri_cari_pasien_v.no_mr, dbo.ri_cari_pasien_v.no_registrasi, dbo.ri_cari_pasien_v.no_kunjungan, dbo.ri_cari_pasien_v.kode_ri, dbo.ri_cari_pasien_v.nama_pasien, 
                      dbo.ri_cari_pasien_v.kode_ruangan, dbo.ri_cari_pasien_v.bag_pas, dbo.ri_cari_pasien_v.kelas_pas, dbo.ri_cari_pasien_v.tgl_masuk, dbo.ri_cari_pasien_v.dr_merawat, 
                      dbo.ri_cari_pasien_v.asal_pasien, dbo.ri_cari_pasien_v.bag_ibu, dbo.ri_cari_pasien_v.kelas_ibu, dbo.ri_cari_pasien_v.gol_darah, dbo.ri_cari_pasien_v.alergi, dbo.ri_cari_pasien_v.tgl_lhr, 
                      dbo.ri_cari_pasien_v.jen_kelamin, dbo.ri_cari_pasien_v.almt_ttp_pasien, dbo.ri_cari_pasien_v.tgl_keluar, dbo.ri_cari_pasien_v.status_pulang, dbo.ri_cari_pasien_v.status_cuti, 
                      dbo.ri_cari_pasien_v.status_registrasi, dbo.ri_cari_pasien_v.kode_perusahaan, dbo.ri_cari_pasien_v.kode_kelompok, dbo.ri_cari_pasien_v.no_jkn, dbo.ri_cari_pasien_v.kode_plafon, 
                      dbo.ri_cari_pasien_v.plafon_old, dbo.ri_cari_pasien_v.diagnosa_awal, dbo.ri_cari_pasien_v.icd10, dbo.ri_cari_pasien_v.icd9, dbo.ri_cari_pasien_v.jatah_klas, dbo.ri_cari_pasien_v.Expr1, 
                      dbo.ri_cari_pasien_v.kode_dokter, dbo.ri_cari_pasien_v.nama_pegawai, dbo.ri_cari_pasien_v.Expr2, dbo.ri_cari_pasien_v.status_batal, dbo.ri_cari_pasien_v.nama_bagian, 
                      dbo.ri_cari_pasien_v.nama_klas, dbo.ri_cari_pasien_v.umur, dbo.ri_cari_pasien_v.alamat, dbo.ri_cari_pasien_v.catatan, dbo.ri_cari_pasien_v.noSep, dbo.ri_cari_pasien_v.tgl_blpl, 
                      dbo.ri_cari_pasien_v.id_paket, dbo.ri_cari_pasien_v.status_keluar, dbo.ri_cari_pasien_v.kode_bagian_tujuan, dbo.ri_cari_pasien_v.status_blpl, dbo.ri_cari_pasien_v.tgl_pulang, 
                      dbo.ri_cari_pasien_v.plafon_bpjs, dbo.ri_cari_pasien_v.mr_ibu, dbo.ri_cari_pasien_v.nama_kelompok, dbo.ri_cari_pasien_v.flag_sk_pasien, dbo.ri_cari_pasien_v.ttd_sk_pasien, 
                      dbo.ri_cari_pasien_v.ttd_ri, dbo.ri_cari_pasien_v.flag_dr, dbo.ri_cari_pasien_v.flag_serah, dbo.ri_cari_pasien_v.no_kunjungan_asal, dbo.ri_cari_pasien_v.kode_bagian_asal, 
                      dbo.ri_cari_pasien_v.kode_depo_bag, dbo.mt_bagian.nama_bagian AS Expr3, dbo.mt_bagian.kode_depo_bag AS Expr4, mt_bagian_1.nama_bagian AS nama_bagian_depo
FROM         dbo.ri_cari_pasien_v INNER JOIN
                      dbo.mt_bagian ON dbo.ri_cari_pasien_v.bag_pas = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_bagian AS mt_bagian_1 ON dbo.mt_bagian.kode_depo_bag = mt_bagian_1.kode_bagian
ORDER BY nama_bagian_depo
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [daftar_pasien_ri_v]");
    }
};
