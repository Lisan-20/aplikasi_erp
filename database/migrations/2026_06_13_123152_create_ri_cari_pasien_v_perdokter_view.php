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
        DB::statement("CREATE VIEW dbo.ri_cari_pasien_v_perdokter
AS
SELECT     dbo.ri_cari_pasien_v.no_mr, dbo.ri_cari_pasien_v.no_registrasi, dbo.ri_cari_pasien_v.no_kunjungan, dbo.ri_cari_pasien_v.kode_ri, dbo.ri_cari_pasien_v.nama_pasien, 
                      dbo.ri_cari_pasien_v.kode_ruangan, dbo.ri_cari_pasien_v.bag_pas, dbo.ri_cari_pasien_v.kelas_pas, dbo.ri_cari_pasien_v.tgl_masuk, dbo.tc_dpjp_rinap.dr_merawat, 
                      dbo.ri_cari_pasien_v.kode_dokter, dbo.ri_cari_pasien_v.asal_pasien, dbo.ri_cari_pasien_v.bag_ibu, dbo.ri_cari_pasien_v.kelas_ibu, dbo.ri_cari_pasien_v.gol_darah, dbo.ri_cari_pasien_v.alergi, 
                      dbo.ri_cari_pasien_v.tgl_lhr, dbo.ri_cari_pasien_v.jen_kelamin, dbo.ri_cari_pasien_v.almt_ttp_pasien, dbo.ri_cari_pasien_v.tgl_keluar, dbo.ri_cari_pasien_v.status_pulang, 
                      dbo.ri_cari_pasien_v.status_cuti, dbo.ri_cari_pasien_v.status_registrasi, dbo.ri_cari_pasien_v.kode_perusahaan, dbo.ri_cari_pasien_v.kode_kelompok, dbo.ri_cari_pasien_v.no_jkn, 
                      dbo.ri_cari_pasien_v.kode_plafon, dbo.ri_cari_pasien_v.plafon_old, dbo.ri_cari_pasien_v.diagnosa_awal, dbo.ri_cari_pasien_v.icd10, dbo.ri_cari_pasien_v.icd9, dbo.ri_cari_pasien_v.jatah_klas, 
                      dbo.ri_cari_pasien_v.Expr1, dbo.ri_cari_pasien_v.nama_pegawai, dbo.ri_cari_pasien_v.Expr2, dbo.ri_cari_pasien_v.status_batal, dbo.ri_cari_pasien_v.nama_bagian, 
                      dbo.ri_cari_pasien_v.nama_klas, dbo.ri_cari_pasien_v.umur, dbo.ri_cari_pasien_v.alamat, dbo.ri_cari_pasien_v.catatan, dbo.ri_cari_pasien_v.noSep, dbo.ri_cari_pasien_v.tgl_blpl, 
                      dbo.ri_cari_pasien_v.id_paket, dbo.ri_cari_pasien_v.status_keluar, dbo.ri_cari_pasien_v.kode_bagian_tujuan, dbo.ri_cari_pasien_v.status_blpl, dbo.ri_cari_pasien_v.tgl_pulang, 
                      dbo.ri_cari_pasien_v.plafon_bpjs, dbo.ri_cari_pasien_v.mr_ibu, dbo.ri_cari_pasien_v.nama_kelompok, dbo.ri_cari_pasien_v.flag_sk_pasien, dbo.ri_cari_pasien_v.ttd_sk_pasien, 
                      dbo.ri_cari_pasien_v.ttd_ri, dbo.ri_cari_pasien_v.flag_dr, dbo.ri_cari_pasien_v.flag_serah, dbo.ri_cari_pasien_v.no_kunjungan_asal, dbo.ri_cari_pasien_v.kode_bagian_asal, 
                      dbo.mt_karyawan.no_induk, dbo.mt_karyawan.nama_pegawai AS nama_dokter
FROM         dbo.ri_cari_pasien_v INNER JOIN
                      dbo.tc_dpjp_rinap ON dbo.ri_cari_pasien_v.no_registrasi = dbo.tc_dpjp_rinap.no_registrasi INNER JOIN
                      dbo.mt_karyawan ON dbo.tc_dpjp_rinap.dr_merawat = dbo.mt_karyawan.kode_dokter
WHERE     (NOT (dbo.ri_cari_pasien_v.bag_pas IN ('032001', '030601', '030701', '031001', '033001')))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ri_cari_pasien_v_perdokter]");
    }
};
