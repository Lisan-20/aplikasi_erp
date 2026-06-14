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
        DB::statement("CREATE OR ALTER VIEW dbo.listing_pasien_registasi_v
AS
SELECT     dbo.tc_registrasi.id_tc_registrasi, dbo.tc_registrasi.no_registrasi, dbo.tc_registrasi.no_mr, dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.kode_kelompok, dbo.tc_registrasi.kode_dokter, 
                      dbo.tc_registrasi.no_induk, dbo.tc_registrasi.tgl_jam_masuk, dbo.tc_registrasi.tgl_jam_keluar, dbo.tc_registrasi.prioritas, dbo.tc_registrasi.kode_bagian_masuk, 
                      dbo.tc_registrasi.kode_bagian_keluar, dbo.tc_registrasi.status_batal, dbo.tc_registrasi.stat_pasien, dbo.tc_registrasi.status_registrasi, dbo.tc_registrasi.umur_old, dbo.tc_registrasi.tgl_input, 
                      dbo.tc_registrasi.id_paket, dbo.tc_registrasi.no_jaminan, dbo.tc_registrasi.nik, dbo.tc_registrasi.kode_pt, dbo.tc_registrasi.nama_pt, dbo.tc_registrasi.status_man, dbo.tc_registrasi.no_jkn, 
                      dbo.tc_registrasi.no_skp, dbo.tc_registrasi.plafon_bpjs, dbo.tc_registrasi.diagnosa, dbo.tc_registrasi.kode_plafon, dbo.tc_registrasi.byr_selisih, dbo.tc_registrasi.flag_daftar, 
                      dbo.tc_registrasi.st_daftar_ulang, dbo.tc_registrasi.status_milik, dbo.tc_registrasi.kode_penanggung, dbo.tc_registrasi.umur, dbo.tc_registrasi.id_dc_asal_pasien, 
                      dbo.tc_registrasi.flag_dr_fis_perujuk, dbo.tc_registrasi.nama_karyawan, dbo.tc_registrasi.flag_status, dbo.tc_registrasi.noKartuPeserta, dbo.tc_registrasi.tglSep, dbo.tc_registrasi.tglRujukan, 
                      dbo.tc_registrasi.noRujukan, dbo.tc_registrasi.ppkRujukan, dbo.tc_registrasi.ppkPelayanan, dbo.tc_registrasi.jnsPelayanan, dbo.tc_registrasi.catatan, dbo.tc_registrasi.kdDiag, 
                      dbo.tc_registrasi.diagAwal, dbo.tc_registrasi.poliTujuan, dbo.tc_registrasi.klsRawat, dbo.tc_registrasi.userInp, dbo.tc_registrasi.noMr, dbo.tc_registrasi.noSep, dbo.tc_registrasi.milike, 
                      dbo.tc_registrasi.jnsPeserta, dbo.tc_registrasi.code, dbo.tc_registrasi.id_dc_sub_asal_pasien, dbo.tc_registrasi.ket_batal, dbo.tc_registrasi.flag_p2d, dbo.mt_bagian.nama_bagian, 
                      dbo.mt_master_pasien.nama_pasien, dbo.mt_master_pasien.tgl_lhr, dbo.mt_master_pasien.almt_ttp_pasien, dbo.mt_master_pasien.tlp_almt_ttp, dbo.tc_registrasi.tgl_jam_masuk AS tgl_jam_poli, 
                      dbo.mt_bagian.nama_bagian AS nama_poli, dbo.mt_karyawan.nama_pegawai AS nama_dokter, dbo.mt_master_pasien.nama_kel_pasien, dbo.mt_bagian.kode_bagian, dbo.tc_registrasi.ttd
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.mt_bagian ON dbo.tc_registrasi.kode_bagian_masuk = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_registrasi.no_mr = dbo.mt_master_pasien.no_mr LEFT OUTER JOIN
                      dbo.mt_karyawan ON dbo.tc_registrasi.kode_dokter = dbo.mt_karyawan.kode_dokter
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [listing_pasien_registasi_v]");
    }
};
