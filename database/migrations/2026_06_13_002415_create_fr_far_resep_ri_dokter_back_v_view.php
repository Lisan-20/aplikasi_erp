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
        DB::statement("CREATE OR ALTER VIEW dbo.fr_far_resep_ri_dokter_back_v
AS
SELECT     dbo.fr_far_resep_ri_dokter.id_resep_ri_dr, dbo.fr_far_resep_ri_dokter.kode_resep, dbo.fr_far_resep_ri_dokter.no_kunjungan, dbo.fr_far_resep_ri_dokter.no_registrasi, 
                      dbo.fr_far_resep_ri_dokter.no_mr, dbo.fr_far_resep_ri_dokter.kode_dokter, dbo.fr_far_resep_ri_dokter.tgl_input, dbo.fr_far_resep_ri_dokter.kode_brg, dbo.fr_far_resep_ri_dokter.jumlah, 
                      dbo.fr_far_resep_ri_dokter.satuan, dbo.fr_far_resep_ri_dokter.nama_brg, dbo.fr_far_resep_ri_dokter.harga, dbo.fr_far_resep_ri_dokter.takaran, dbo.fr_far_resep_ri_dokter.penggunaan, 
                      dbo.fr_far_resep_ri_dokter.instruksi, dbo.fr_far_resep_ri_dokter.jml_pakai, dbo.fr_far_resep_ri_dokter.jml_takar, dbo.fr_far_resep_ri_dokter.jam_pemberian, dbo.fr_far_resep_ri_dokter.jml_konversi, 
                      dbo.fr_far_resep_ri_dokter.komp_dtd, dbo.fr_far_resep_ri_dokter.racikan_obat_tambahan, dbo.fr_far_resep_ri_dokter.racik, dbo.fr_far_resep_ri_dokter.flag_kirim, dbo.fr_far_resep_ri_dokter.jam1, 
                      dbo.fr_far_resep_ri_dokter.jam2, dbo.fr_far_resep_ri_dokter.jam3, dbo.fr_far_resep_ri_dokter.jam4, dbo.fr_far_resep_ri_dokter.jam5, dbo.fr_far_resep_ri_dokter.tgl_st_pesan, 
                      dbo.fr_far_resep_ri_dokter.st_pesan, dbo.fr_far_resep_ri_dokter.id_user_st_pesan, dbo.fr_far_resep_ri_dokter.interaksi, dbo.fr_far_resep_ri_dokter.duplikasi, dbo.fr_far_resep_ri_dokter.dosis, 
                      dbo.fr_far_resep_ri_dokter.alergi, dbo.fr_far_resep_ri_dokter.kontra, dbo.fr_far_resep_ri_dokter.user_id_apot, dbo.fr_far_resep_ri_dokter.tgl_review, dbo.fr_far_resep_ri_dokter.st_review, 
                      dbo.fr_far_resep_ri_dokter.st_stop, dbo.fr_far_resep_ri_dokter.tgl_st_stop, dbo.fr_far_resep_ri_dokter.id_user_st_stop, dbo.fr_far_resep_ri_dokter.id_user_st_review, 
                      dbo.fr_far_resep_ri_dokter.kode_rm, dbo.fr_far_resep_ri_dokter.kode_bagian_isi, dbo.fr_far_resep_ri_dokter.isi_cara, dbo.fr_far_resep_ri_dokter.isi_waktu, dbo.fr_far_resep_ri_dokter.isi_signa, 
                      dbo.fr_far_resep_ri_dokter.st_rek_awal, dbo.fr_far_resep_ri_dokter.tgl_rek_awal, dbo.fr_far_resep_ri_dokter.id_user_rek, dbo.fr_far_resep_ri_dokter.bentuk_reaksi, 
                      dbo.fr_far_resep_ri_dokter.tgl_ass_alergi, dbo.fr_far_resep_ri_dokter.id_user_alergi, dbo.fr_far_resep_ri_dokter.st_alergi, dbo.fr_far_resep_ri_dokter.flag_perawat, 
                      dbo.fr_far_resep_ri_dokter.flag_igd_resep, dbo.fr_far_resep_ri_dokter.jam_khusus, dbo.fr_far_resep_ri_dokter.kode_bagian_inp, dbo.fr_far_resep_ri_dokter.flag_permintaan, 
                      dbo.fr_far_resep_ri_dokter.flag_1x, dbo.fr_far_resep_ri_dokter_back.id_resep_ri_dr AS Expr1
FROM         dbo.fr_far_resep_ri_dokter LEFT OUTER JOIN
                      dbo.fr_far_resep_ri_dokter_back ON dbo.fr_far_resep_ri_dokter.id_resep_ri_dr = dbo.fr_far_resep_ri_dokter_back.id_resep_ri_dr
WHERE     (dbo.fr_far_resep_ri_dokter_back.id_resep_ri_dr IS NULL) AND (dbo.fr_far_resep_ri_dokter.no_registrasi NOT IN
                          (SELECT     no_registrasi
                            FROM          dbo.tc_registrasi))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fr_far_resep_ri_dokter_back_v]");
    }
};
