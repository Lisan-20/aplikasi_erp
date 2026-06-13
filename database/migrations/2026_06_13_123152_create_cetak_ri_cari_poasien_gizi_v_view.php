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
        DB::statement("CREATE VIEW dbo.cetak_ri_cari_poasien_gizi_v
AS
SELECT     dbo.ri_cari_pasien_v.no_mr, dbo.ri_cari_pasien_v.no_registrasi, dbo.ri_cari_pasien_v.no_kunjungan, dbo.ri_cari_pasien_v.kode_ri, 
                      dbo.ri_cari_pasien_v.nama_pasien, dbo.mt_ruangan.kode_ruangan, dbo.ri_cari_pasien_v.bag_pas, dbo.ri_cari_pasien_v.kelas_pas, 
                      dbo.ri_cari_pasien_v.tgl_masuk, dbo.ri_cari_pasien_v.dr_merawat, dbo.ri_cari_pasien_v.asal_pasien, dbo.ri_cari_pasien_v.bag_ibu, 
                      dbo.ri_cari_pasien_v.kelas_ibu, dbo.ri_cari_pasien_v.gol_darah, dbo.ri_cari_pasien_v.alergi, dbo.ri_cari_pasien_v.tgl_lhr, 
                      dbo.ri_cari_pasien_v.jen_kelamin, dbo.ri_cari_pasien_v.almt_ttp_pasien, dbo.ri_cari_pasien_v.tgl_keluar, dbo.ri_cari_pasien_v.status_pulang, 
                      dbo.ri_cari_pasien_v.status_cuti, dbo.ri_cari_pasien_v.status_registrasi, dbo.ri_cari_pasien_v.kode_perusahaan, 
                      dbo.ri_cari_pasien_v.kode_kelompok, dbo.ri_cari_pasien_v.no_jkn, dbo.ri_cari_pasien_v.kode_plafon, dbo.ri_cari_pasien_v.plafon_bpjs, 
                      dbo.ri_cari_pasien_v.diagnosa_awal, dbo.ri_cari_pasien_v.icd10, dbo.ri_cari_pasien_v.icd9, dbo.ri_cari_pasien_v.jatah_klas, 
                      dbo.ri_cari_pasien_v.Expr1, dbo.ri_cari_pasien_v.kode_dokter, dbo.ri_cari_pasien_v.nama_pegawai, dbo.ri_cari_pasien_v.Expr2, 
                      dbo.ri_cari_pasien_v.status_batal, dbo.ri_cari_pasien_v.nama_klas, dbo.ri_cari_pasien_v.umur, dbo.mt_ruangan.kode_bagian, 
                      dbo.mt_bagian.nama_bagian, dbo.tc_sensus_gizi.diet
FROM         dbo.tc_sensus_gizi INNER JOIN
                      dbo.ri_cari_pasien_v ON dbo.tc_sensus_gizi.no_registrasi = dbo.ri_cari_pasien_v.no_registrasi RIGHT OUTER JOIN
                      dbo.mt_bagian INNER JOIN
                      dbo.mt_ruangan ON dbo.mt_bagian.kode_bagian = dbo.mt_ruangan.kode_bagian ON 
                      dbo.ri_cari_pasien_v.kode_ruangan = dbo.mt_ruangan.kode_ruangan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cetak_ri_cari_poasien_gizi_v]");
    }
};
