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
        DB::statement("CREATE VIEW dbo.fr_far_resep_ri_dokter_apo_isi_v
AS
SELECT     dbo.fr_far_resep_ri_dokter.id_resep_ri_dr, dbo.fr_far_resep_ri_dokter.kode_resep, dbo.fr_far_resep_ri_dokter.no_kunjungan, dbo.fr_far_resep_ri_dokter.no_registrasi, 
                      dbo.fr_far_resep_ri_dokter.no_mr, dbo.fr_far_resep_ri_dokter.kode_dokter, dbo.fr_far_resep_ri_dokter.tgl_input, dbo.fr_far_resep_ri_dokter.kode_brg, dbo.fr_far_resep_ri_dokter.jumlah, 
                      dbo.fr_far_resep_ri_dokter.satuan, dbo.mt_barang.nama_brg, dbo.fr_far_resep_ri_dokter.harga, dbo.fr_far_resep_ri_dokter.takaran, dbo.fr_far_resep_ri_dokter.penggunaan, 
                      dbo.fr_far_resep_ri_dokter.instruksi, dbo.fr_far_resep_ri_dokter.jml_pakai, dbo.fr_far_resep_ri_dokter.jml_takar, dbo.fr_far_resep_ri_dokter.jam_pemberian, dbo.fr_far_resep_ri_dokter.jml_konversi, 
                      dbo.fr_far_resep_ri_dokter.komp_dtd, dbo.fr_far_resep_ri_dokter.racikan_obat_tambahan, dbo.fr_far_resep_ri_dokter.racik, dbo.fr_far_resep_ri_dokter.flag_kirim, dbo.fr_far_resep_ri_dokter.jam1, 
                      dbo.fr_far_resep_ri_dokter.jam2, dbo.fr_far_resep_ri_dokter.jam3, dbo.fr_far_resep_ri_dokter.jam4, dbo.fr_far_resep_ri_dokter.jam5, dbo.fr_far_resep_ri_dokter.st_pesan, 
                      dbo.fr_far_resep_ri_dokter.tgl_st_pesan, dbo.fr_far_resep_ri_dokter.id_user_st_pesan, dbo.fr_far_resep_ri_dokter.interaksi, dbo.fr_far_resep_ri_dokter.duplikasi, dbo.fr_far_resep_ri_dokter.dosis, 
                      dbo.fr_far_resep_ri_dokter.alergi, dbo.fr_far_resep_ri_dokter.kontra, dbo.fr_far_resep_ri_dokter.user_id_apot, dbo.fr_far_resep_ri_dokter.tgl_review, dbo.fr_far_resep_ri_dokter.st_review, 
                      dbo.tc_registrasi.tgl_jam_keluar, dbo.tc_registrasi.status_batal, dbo.fr_tc_far_detail.jam1 AS jam1_isi, dbo.fr_tc_far_detail.jam2 AS jam2_isi, dbo.fr_tc_far_detail.jam3 AS jam3_isi, 
                      dbo.fr_tc_far_detail.jam4 AS jam4_isi, dbo.fr_tc_far_detail.jam5 AS jam5_isi, dbo.fr_tc_far_detail.jumlah_tebus, dbo.fr_tc_far.tgl_trans AS tgl_trans_apotik, dbo.mt_master_pasien.nama_pasien, 
                      dbo.mt_master_pasien.jen_kelamin, dbo.mt_barang.satuan_kecil, dbo.fr_tc_far_detail.tgl_update1, dbo.fr_tc_far_detail.tgl_update2, dbo.fr_tc_far_detail.tgl_update3, dbo.fr_tc_far_detail.tgl_update4, 
                      dbo.fr_tc_far_detail.tgl_update5, dbo.fr_tc_far_detail.id_user1, dbo.fr_tc_far_detail.id_user2, dbo.fr_tc_far_detail.id_user3, dbo.fr_tc_far_detail.id_user4, dbo.fr_tc_far_detail.id_user5, 
                      dbo.fr_tc_far_detail.kd_tr_resep, dbo.mt_bagian.nama_bagian, dbo.mt_bagian.kode_depo_bag, dbo.fr_tc_far.status_transaksi, dbo.fr_far_resep_ri_dokter.flag_perawat, 
                      dbo.fr_tc_far.tgl_status_transaksi
FROM         dbo.fr_far_resep_ri_dokter INNER JOIN
                      dbo.tc_registrasi ON dbo.fr_far_resep_ri_dokter.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.fr_tc_far_detail ON dbo.fr_far_resep_ri_dokter.id_resep_ri_dr = dbo.fr_tc_far_detail.id_resep_ri_dr INNER JOIN
                      dbo.fr_tc_far ON dbo.fr_tc_far_detail.kode_trans_far = dbo.fr_tc_far.kode_trans_far INNER JOIN
                      dbo.mt_barang ON dbo.fr_far_resep_ri_dokter.kode_brg = dbo.mt_barang.kode_brg INNER JOIN
                      dbo.mt_master_pasien ON dbo.fr_far_resep_ri_dokter.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.mt_bagian ON dbo.fr_tc_far.kode_bagian_asal = dbo.mt_bagian.kode_bagian
WHERE     (dbo.tc_registrasi.tgl_jam_keluar IS NULL) AND (dbo.tc_registrasi.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fr_far_resep_ri_dokter_apo_isi_v]");
    }
};
