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
        DB::statement("CREATE VIEW dbo.ri_cari_pasien_history_v
AS
SELECT        dbo.mt_master_pasien.no_mr, dbo.tc_registrasi.no_registrasi, dbo.tc_kunjungan.no_kunjungan, dbo.ri_tc_rawatinap.kode_ri, dbo.mt_master_pasien.nama_pasien, dbo.ri_tc_rawatinap.kode_ruangan, 
                         dbo.ri_tc_rawatinap.bag_pas, dbo.ri_tc_rawatinap.kelas_pas, dbo.ri_tc_rawatinap.tgl_masuk, dbo.ri_tc_rawatinap.dr_merawat, dbo.ri_tc_rawatinap.asal_pasien, dbo.ri_tc_rawatinap.bag_ibu, dbo.ri_tc_rawatinap.kelas_ibu, 
                         dbo.mt_master_pasien.gol_darah, dbo.mt_master_pasien.alergi, dbo.mt_master_pasien.tgl_lhr, dbo.mt_master_pasien.jen_kelamin, dbo.mt_master_pasien.almt_ttp_pasien, dbo.ri_tc_rawatinap.tgl_keluar, 
                         dbo.ri_tc_rawatinap.status_pulang, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.kode_perusahaan, dbo.ri_tc_rawatinap.jatah_klas, dbo.ri_tc_rawatinap.plafon_bpjs, dbo.ri_tc_rawatinap.diagnosa_awal, 
                         dbo.ri_tc_rawatinap.no_jkn, dbo.ri_tc_rawatinap.kode_plafon, dbo.tc_kunjungan.user_pulang, dbo.mt_master_pasien.mr_ibu, dbo.tc_kunjungan.tgl_kontrol, dbo.mt_master_pasien.tlp_almt_ttp AS no_telpon, 
                         dbo.tc_kunjungan.flag_wa, REPLACE(CONVERT(varchar, dbo.mt_master_pasien.tgl_lhr, 103), '/', '') AS pass, dbo.mt_karyawan.nama_pegawai AS nama_dokter
FROM            dbo.tc_kunjungan INNER JOIN
                         dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                         dbo.ri_tc_rawatinap ON dbo.tc_kunjungan.no_kunjungan = dbo.ri_tc_rawatinap.no_kunjungan INNER JOIN
                         dbo.mt_master_pasien ON dbo.tc_registrasi.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                         dbo.mt_karyawan ON dbo.ri_tc_rawatinap.dr_merawat = dbo.mt_karyawan.kode_dokter
WHERE        (dbo.ri_tc_rawatinap.status_pulang = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ri_cari_pasien_history_v]");
    }
};
