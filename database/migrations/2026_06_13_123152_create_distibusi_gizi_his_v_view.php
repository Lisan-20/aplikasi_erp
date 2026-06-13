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
        DB::statement("CREATE VIEW dbo.distibusi_gizi_his_v
AS
SELECT     TOP (100) PERCENT a.no_mr, a.no_registrasi, a.no_kunjungan, a.kode_ri, a.nama_pasien, a.kode_ruangan, a.bag_pas, a.kelas_pas, a.tgl_masuk, a.dr_merawat, a.asal_pasien, a.bag_ibu, 
                      a.kelas_ibu, a.gol_darah, a.alergi, a.tgl_lhr, a.jen_kelamin, a.almt_ttp_pasien, a.tgl_keluar, a.status_pulang, a.status_cuti, a.status_registrasi, a.kode_perusahaan, a.kode_kelompok, a.no_jkn, 
                      a.kode_plafon, a.plafon_old, a.diagnosa_awal, a.icd10, a.icd9, a.jatah_klas, a.Expr1, a.kode_dokter, a.nama_pegawai, a.Expr2, a.status_batal, a.nama_bagian, a.nama_klas, a.umur, a.alamat, 
                      a.catatan, a.noSep, a.tgl_blpl, a.id_paket, a.status_keluar, a.kode_bagian_tujuan, a.status_blpl, a.tgl_pulang, a.plafon_bpjs, a.mr_ibu, a.nama_kelompok, b.nama_bagian AS Expr3, 
                      dbo.tc_pemesanan_gizi.status_selesai, dbo.tc_pemesanan_gizi.kode_menu, dbo.tc_pemesanan_gizi.tgl_input, dbo.tc_pemesanan_gizi.distribusi
FROM         dbo.ri_cari_pasien_v AS a INNER JOIN
                      dbo.mt_bagian AS b ON a.bag_pas = b.kode_bagian INNER JOIN
                      dbo.tc_pemesanan_gizi ON a.no_registrasi = dbo.tc_pemesanan_gizi.no_registrasi
WHERE     (dbo.tc_pemesanan_gizi.status_selesai = 1)
ORDER BY a.tgl_masuk DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [distibusi_gizi_his_v]");
    }
};
