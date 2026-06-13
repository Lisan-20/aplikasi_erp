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
        DB::statement("CREATE VIEW dbo.ri_cariPasienBedah_dr_anestesi_rj__v
AS
SELECT     dbo.mt_master_pasien.no_mr, dbo.mt_master_pasien.nama_pasien, dbo.tc_registrasi.no_registrasi, dbo.tc_kunjungan.no_kunjungan, dbo.tc_registrasi.kode_kelompok, 
                      dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.umur, dbo.mt_master_pasien.tgl_lhr, dbo.tc_registrasi.stat_pasien, dbo.tc_bedah.nama_tindakan, 
                      dbo.tc_bedah.kode_dr_anestesi AS kode_dokter, dbo.mt_karyawan.nama_pegawai AS nama_dokter, dbo.tc_bedah.tgl_jam_mulai, dbo.mt_karyawan.no_induk, dbo.tc_bedah.tgl_jam_keluar, 
                      dbo.tc_rencana_operasi.status, dbo.tc_bedah.kode_bagian, 16 AS kelas_tujuan, dbo.pl_tc_poli.kode_poli
FROM         dbo.tc_registrasi INNER JOIN
                      dbo.tc_kunjungan ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_registrasi.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.tc_bedah ON dbo.tc_kunjungan.no_kunjungan = dbo.tc_bedah.no_kunjungan INNER JOIN
                      dbo.tc_rencana_operasi ON dbo.tc_kunjungan.no_kunjungan = dbo.tc_rencana_operasi.no_kunjungan INNER JOIN
                      dbo.pl_tc_poli ON dbo.tc_kunjungan.no_kunjungan = dbo.pl_tc_poli.no_kunjungan INNER JOIN
                      dbo.mt_karyawan ON dbo.tc_bedah.kode_dr_anestesi = dbo.mt_karyawan.kode_dokter
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ri_cariPasienBedah_dr_anestesi_rj_v]");
    }
};
