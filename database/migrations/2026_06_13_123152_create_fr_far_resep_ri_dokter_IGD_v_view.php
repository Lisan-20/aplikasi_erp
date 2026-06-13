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
        DB::statement("CREATE VIEW dbo.fr_far_resep_ri_dokter_IGD_v
AS
SELECT     dbo.fr_far_resep_ri_dokter.kode_resep, dbo.fr_far_resep_ri_dokter.no_kunjungan, dbo.fr_far_resep_ri_dokter.no_registrasi, dbo.fr_far_resep_ri_dokter.no_mr, 
                      dbo.fr_far_resep_ri_dokter.kode_dokter, dbo.fr_far_resep_ri_dokter.flag_kirim, dbo.fr_far_resep_ri_dokter.kode_rm, dbo.fr_far_resep_ri_dokter.kode_bagian_isi AS kode_bagian_asal, 
                      dbo.fr_far_resep_ri_dokter.flag_igd_resep, dbo.fr_far_resep_ri_dokter.flag_1x, dbo.ri_tc_rawatinap2_v.bag_pas, dbo.ri_tc_rawatinap2_v.kode_ruangan, dbo.tc_registrasi.tgl_jam_keluar, 
                      dbo.mt_bagian.nama_bagian, dbo.mt_bagian.kode_depo_bag, dbo.ri_tc_rawatinap2_v.kelas_pas, dbo.fr_far_resep_ri_dokter.flag_perawat
FROM         dbo.mt_bagian INNER JOIN
                      dbo.ri_tc_rawatinap2_v ON dbo.mt_bagian.kode_bagian = dbo.ri_tc_rawatinap2_v.bag_pas RIGHT OUTER JOIN
                      dbo.fr_far_resep_ri_dokter INNER JOIN
                      dbo.tc_registrasi ON dbo.fr_far_resep_ri_dokter.no_registrasi = dbo.tc_registrasi.no_registrasi ON dbo.ri_tc_rawatinap2_v.no_registrasi = dbo.tc_registrasi.no_registrasi LEFT OUTER JOIN
                      dbo.fr_tc_far ON dbo.fr_far_resep_ri_dokter.kode_resep = dbo.fr_tc_far.kode_resep
GROUP BY dbo.fr_far_resep_ri_dokter.kode_resep, dbo.fr_far_resep_ri_dokter.no_kunjungan, dbo.fr_far_resep_ri_dokter.no_registrasi, dbo.fr_far_resep_ri_dokter.no_mr, 
                      dbo.fr_far_resep_ri_dokter.kode_dokter, dbo.fr_far_resep_ri_dokter.flag_kirim, dbo.tc_registrasi.tgl_jam_keluar, dbo.tc_registrasi.status_batal, dbo.fr_far_resep_ri_dokter.kode_rm, 
                      dbo.fr_far_resep_ri_dokter.kode_bagian_isi, dbo.fr_far_resep_ri_dokter.flag_igd_resep, dbo.fr_far_resep_ri_dokter.flag_1x, dbo.ri_tc_rawatinap2_v.bag_pas, dbo.ri_tc_rawatinap2_v.kode_ruangan, 
                      dbo.mt_bagian.nama_bagian, dbo.mt_bagian.kode_depo_bag, dbo.ri_tc_rawatinap2_v.kelas_pas, dbo.fr_far_resep_ri_dokter.flag_perawat
HAVING      (dbo.tc_registrasi.tgl_jam_keluar IS NULL) AND (dbo.tc_registrasi.status_batal IS NULL) AND (dbo.fr_far_resep_ri_dokter.flag_igd_resep IS NULL) AND 
                      (dbo.fr_far_resep_ri_dokter.kode_bagian_isi = '020101') AND (dbo.fr_far_resep_ri_dokter.flag_kirim = 1) AND (dbo.fr_far_resep_ri_dokter.flag_1x IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fr_far_resep_ri_dokter_IGD_v]");
    }
};
