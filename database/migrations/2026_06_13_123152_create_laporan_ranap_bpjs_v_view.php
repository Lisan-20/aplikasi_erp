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
        DB::statement("CREATE VIEW dbo.laporan_ranap_bpjs_v
AS
SELECT     dbo.mt_master_pasien.no_mr, dbo.tc_registrasi.no_registrasi, dbo.tc_kunjungan.no_kunjungan, dbo.mt_master_pasien.nama_pasien, dbo.ri_tc_rawatinap.bag_pas, 
                      dbo.ri_tc_rawatinap.kelas_pas, dbo.ri_tc_rawatinap.tgl_masuk, dbo.ri_tc_rawatinap.dr_merawat, dbo.tc_registrasi.kode_dokter, dbo.mt_master_pasien.tgl_lhr, 
                      dbo.mt_master_pasien.jen_kelamin, dbo.mt_master_pasien.almt_ttp_pasien, dbo.ri_tc_rawatinap.tgl_keluar, dbo.ri_tc_rawatinap.status_pulang, 
                      dbo.ri_tc_rawatinap.status_cuti, dbo.tc_registrasi.status_registrasi, dbo.tc_registrasi.kode_perusahaan, dbo.tc_registrasi.kode_kelompok, dbo.ri_tc_rawatinap.no_jkn, 
                      dbo.ri_tc_rawatinap.kode_plafon, dbo.ri_tc_rawatinap.plafon_bpjs, dbo.ri_tc_rawatinap.diagnosa_awal, MONTH(dbo.tc_kunjungan.tgl_keluar) AS bln, 
                      YEAR(dbo.tc_kunjungan.tgl_keluar) AS thn, dbo.ri_tc_rawatinap.kode_ri, dbo.tc_kunjungan.status_batal
FROM         dbo.tc_kunjungan INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_kunjungan.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.ri_tc_rawatinap ON dbo.tc_kunjungan.no_kunjungan = dbo.ri_tc_rawatinap.no_kunjungan INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_registrasi.no_mr = dbo.mt_master_pasien.no_mr
WHERE     (dbo.ri_tc_rawatinap.status_pulang = 1) AND (dbo.tc_kunjungan.status_batal IS NULL) AND (dbo.tc_registrasi.kode_kelompok IN ('8', '9', '11'))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [laporan_ranap_bpjs_v]");
    }
};
