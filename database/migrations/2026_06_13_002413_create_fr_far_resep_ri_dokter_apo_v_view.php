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
        DB::statement("CREATE OR ALTER VIEW dbo.fr_far_resep_ri_dokter_apo_v
AS
SELECT     dbo.fr_far_resep_ri_dokter.id_resep_ri_dr, dbo.fr_far_resep_ri_dokter.kode_resep, dbo.fr_far_resep_ri_dokter.no_kunjungan, dbo.fr_far_resep_ri_dokter.no_registrasi, 
                      dbo.fr_far_resep_ri_dokter.no_mr, dbo.fr_far_resep_ri_dokter.kode_dokter, dbo.fr_far_resep_ri_dokter.tgl_input, dbo.fr_far_resep_ri_dokter.kode_brg, dbo.fr_far_resep_ri_dokter.jumlah, 
                      dbo.fr_far_resep_ri_dokter.satuan, dbo.fr_far_resep_ri_dokter.nama_brg, dbo.fr_far_resep_ri_dokter.harga, dbo.fr_far_resep_ri_dokter.takaran, dbo.fr_far_resep_ri_dokter.penggunaan, 
                      dbo.fr_far_resep_ri_dokter.instruksi, dbo.fr_far_resep_ri_dokter.jml_pakai, dbo.fr_far_resep_ri_dokter.jml_takar, dbo.fr_far_resep_ri_dokter.jam_pemberian, dbo.fr_far_resep_ri_dokter.jml_konversi, 
                      dbo.fr_far_resep_ri_dokter.komp_dtd, dbo.fr_far_resep_ri_dokter.racikan_obat_tambahan, dbo.fr_far_resep_ri_dokter.racik, dbo.fr_far_resep_ri_dokter.flag_kirim, dbo.fr_far_resep_ri_dokter.jam1, 
                      dbo.fr_far_resep_ri_dokter.jam2, dbo.fr_far_resep_ri_dokter.jam3, dbo.fr_far_resep_ri_dokter.jam4, dbo.fr_far_resep_ri_dokter.jam5, dbo.fr_far_resep_ri_dokter.st_pesan, 
                      dbo.fr_far_resep_ri_dokter.tgl_st_pesan, dbo.fr_far_resep_ri_dokter.id_user_st_pesan, dbo.fr_far_resep_ri_dokter.interaksi, dbo.fr_far_resep_ri_dokter.duplikasi, dbo.fr_far_resep_ri_dokter.dosis, 
                      dbo.fr_far_resep_ri_dokter.alergi, dbo.fr_far_resep_ri_dokter.kontra, dbo.fr_far_resep_ri_dokter.user_id_apot, dbo.fr_far_resep_ri_dokter.tgl_review, dbo.fr_far_resep_ri_dokter.st_review, 
                      dbo.tc_registrasi.tgl_jam_keluar, dbo.tc_registrasi.status_batal, dbo.fr_far_resep_ri_dokter.kode_rm, dbo.fr_far_resep_ri_dokter.kode_bagian_inp, dbo.ri_tc_rawatinap2_v.bag_pas, 
                      dbo.ri_tc_rawatinap2_v.tgl_keluar, dbo.ri_tc_rawatinap2_v.kode_ruangan, dbo.ri_tc_rawatinap2_v.kelas_pas, dbo.mt_bagian.nama_bagian, dbo.fr_far_resep_ri_dokter.flag_perawat, 
                      dbo.mt_bagian.kode_depo_bag, dbo.fr_far_resep_ri_dokter.flag_permintaan
FROM         dbo.mt_bagian INNER JOIN
                      dbo.ri_tc_rawatinap2_v ON dbo.mt_bagian.kode_bagian = dbo.ri_tc_rawatinap2_v.bag_pas INNER JOIN
                      dbo.fr_far_resep_ri_dokter INNER JOIN
                      dbo.tc_registrasi ON dbo.fr_far_resep_ri_dokter.no_registrasi = dbo.tc_registrasi.no_registrasi ON dbo.ri_tc_rawatinap2_v.no_registrasi = dbo.fr_far_resep_ri_dokter.no_registrasi
WHERE     (dbo.tc_registrasi.status_batal IS NULL) AND (dbo.fr_far_resep_ri_dokter.flag_perawat IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fr_far_resep_ri_dokter_apo_v]");
    }
};
