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
        DB::statement("CREATE OR ALTER VIEW dbo.resum_pasien_RI_v
AS
SELECT     dbo.mt_master_pasien.no_mr, dbo.tc_registrasi.no_registrasi, dbo.tc_kunjungan.no_kunjungan, dbo.ri_tc_rawatinap.kode_ri, dbo.mt_master_pasien.nama_pasien, 
                      dbo.ri_tc_rawatinap.kode_ruangan, dbo.ri_tc_rawatinap.bag_pas, dbo.ri_tc_rawatinap.kelas_pas, dbo.ri_tc_rawatinap.tgl_masuk, dbo.ri_tc_rawatinap.dr_merawat, dbo.ri_tc_rawatinap.asal_pasien, 
                      dbo.ri_tc_rawatinap.bag_ibu, dbo.ri_tc_rawatinap.kelas_ibu, dbo.mt_master_pasien.gol_darah, dbo.mt_master_pasien.alergi, dbo.mt_master_pasien.tgl_lhr, dbo.mt_master_pasien.jen_kelamin, 
                      dbo.mt_master_pasien.almt_ttp_pasien, dbo.ri_tc_rawatinap.tgl_keluar, dbo.ri_tc_rawatinap.status_pulang, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.kode_perusahaan, 
                      dbo.ri_tc_rawatinap.jatah_klas, dbo.ri_tc_rawatinap.plafon_bpjs, dbo.ri_tc_rawatinap.diagnosa_awal, dbo.ri_tc_rawatinap.no_jkn, dbo.ri_tc_rawatinap.kode_plafon, dbo.tc_kunjungan.user_pulang, 
                      dbo.mt_master_pasien.mr_ibu, dbo.tc_kunjungan.tgl_kontrol, dbo.mt_master_pasien.tlp_almt_ttp AS no_telpon, dbo.tc_kunjungan.flag_wa, REPLACE(CONVERT(varchar, 
                      dbo.mt_master_pasien.tgl_lhr, 103), '/', '') AS pass, dbo.mt_karyawan.nama_pegawai AS nama_dokter, dbo.mt_master_pasien.nik, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, 
                      dbo.tc_trans_kasir.tgl_jam, dbo.tc_kunjungan.kode_tc_trans_kasir, dbo.tc_registrasi.noSep, dbo.tc_registrasi.kode_bagian_masuk, dbo.tc_trans_kasir.flag_ver_berkas, 
                      dbo.tc_trans_kasir.kode_bagian, dbo.mt_bagian.nama_bagian, dbo.tc_trans_kasir.status_batal, dbo.tc_registrasi.tgl_jam_masuk, dbo.mt_master_pasien.no_askes, dbo.tc_registrasi.no_jaminan, 
                      dbo.tc_registrasi.noRujukan
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.ri_tc_rawatinap ON dbo.tc_kunjungan.no_kunjungan = dbo.ri_tc_rawatinap.no_kunjungan INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_registrasi.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.mt_karyawan ON dbo.ri_tc_rawatinap.dr_merawat = dbo.mt_karyawan.kode_dokter INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_registrasi.no_registrasi = dbo.tc_trans_kasir.no_registrasi INNER JOIN
                      dbo.mt_bagian ON dbo.tc_trans_kasir.kode_bagian = dbo.mt_bagian.kode_bagian
WHERE     (dbo.tc_trans_kasir.status_batal IS NULL) AND (dbo.tc_trans_kasir.seri_kuitansi = 'AI') AND (dbo.tc_registrasi.kode_kelompok NOT IN (1, 5, 3)) AND (YEAR(dbo.tc_trans_kasir.tgl_jam) >= 2024) AND 
                      (dbo.ri_tc_rawatinap.status_pulang = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [resum_pasien_RI_v]");
    }
};
