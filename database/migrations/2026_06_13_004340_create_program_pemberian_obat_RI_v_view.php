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
        DB::statement("CREATE OR ALTER VIEW dbo.program_pemberian_obat_RI_v
AS
SELECT     dbo.mt_barang.nama_brg, dbo.mt_barang.satuan_kecil, dbo.fr_far_resep_ri_dokter.instruksi, dbo.fr_far_resep_ri_dokter.jml_pakai, dbo.fr_far_resep_ri_dokter.jml_takar, 
                      dbo.mt_penggunaan.penggunaan, dbo.mt_takaran.takaran, dbo.fr_far_resep_ri_dokter.jam1, dbo.fr_far_resep_ri_dokter.jam2, dbo.fr_far_resep_ri_dokter.jam3, dbo.fr_far_resep_ri_dokter.jam4, 
                      dbo.fr_far_resep_ri_dokter.jam5, dbo.fr_far_resep_ri_dokter.no_registrasi, dbo.fr_far_resep_ri_dokter.no_mr, dbo.fr_far_resep_ri_dokter.kode_dokter, 
                      dbo.fr_far_resep_ri_dokter.tgl_input AS tgl_trans, dbo.fr_far_resep_ri_dokter.jumlah, dbo.fr_far_resep_ri_dokter.kode_brg, dbo.mt_karyawan.nama_pegawai AS dokter_pengirim, 
                      dbo.fr_far_resep_ri_dokter.id_resep_ri_dr, dbo.fr_far_resep_ri_dokter.st_pesan, dbo.fr_far_resep_ri_dokter.tgl_st_pesan, dbo.fr_far_resep_ri_dokter.id_user_st_pesan, 
                      dbo.fr_far_resep_ri_dokter.tgl_review, dbo.fr_far_resep_ri_dokter.user_id_apot, dbo.fr_far_resep_ri_dokter.kontra, dbo.fr_far_resep_ri_dokter.alergi, dbo.fr_far_resep_ri_dokter.dosis, 
                      dbo.fr_far_resep_ri_dokter.interaksi, dbo.fr_far_resep_ri_dokter.duplikasi, dbo.fr_far_resep_ri_dokter.st_review, dbo.fr_far_resep_ri_dokter.st_stop, dbo.fr_far_resep_ri_dokter.tgl_st_stop, 
                      dbo.fr_far_resep_ri_dokter.id_user_st_stop, dbo.fr_far_resep_ri_dokter.id_user_st_review, dbo.fr_far_resep_ri_dokter.flag_perawat
FROM         dbo.mt_barang INNER JOIN
                      dbo.fr_far_resep_ri_dokter ON dbo.mt_barang.kode_brg = dbo.fr_far_resep_ri_dokter.kode_brg INNER JOIN
                      dbo.mt_karyawan ON dbo.fr_far_resep_ri_dokter.kode_dokter = dbo.mt_karyawan.kode_dokter LEFT OUTER JOIN
                      dbo.mt_penggunaan ON dbo.fr_far_resep_ri_dokter.penggunaan = dbo.mt_penggunaan.id LEFT OUTER JOIN
                      dbo.mt_takaran ON dbo.fr_far_resep_ri_dokter.takaran = dbo.mt_takaran.id_takaran
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [program_pemberian_obat_RI_v]");
    }
};
