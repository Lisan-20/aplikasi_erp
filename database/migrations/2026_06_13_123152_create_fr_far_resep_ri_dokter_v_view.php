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
        DB::statement("CREATE VIEW dbo.fr_far_resep_ri_dokter_v
AS
SELECT     dbo.fr_far_resep_ri_dokter.id_resep_ri_dr, dbo.fr_far_resep_ri_dokter.no_registrasi, dbo.fr_far_resep_ri_dokter.no_mr, dbo.fr_far_resep_ri_dokter.kode_dokter, dbo.fr_far_resep_ri_dokter.tgl_input, 
                      dbo.fr_far_resep_ri_dokter.kode_brg, dbo.fr_far_resep_ri_dokter.jumlah, dbo.fr_far_resep_ri_dokter.satuan, dbo.fr_far_resep_ri_dokter.instruksi, dbo.fr_far_resep_ri_dokter.racikan_obat_tambahan, 
                      dbo.fr_far_resep_ri_dokter.racik, dbo.fr_far_resep_ri_dokter.jam1, dbo.fr_far_resep_ri_dokter.jam2, dbo.fr_far_resep_ri_dokter.jam3, dbo.fr_far_resep_ri_dokter.jam4, 
                      dbo.fr_far_resep_ri_dokter.jam5, dbo.fr_far_resep_ri_dokter.st_pesan, dbo.fr_far_resep_ri_dokter.tgl_st_pesan, dbo.fr_far_resep_ri_dokter.id_user_st_pesan, dbo.mt_penggunaan.penggunaan, 
                      dbo.fr_far_resep_ri_dokter.no_kunjungan, dbo.mt_takaran.takaran, dbo.fr_far_resep_ri_dokter.jml_pakai, dbo.fr_far_resep_ri_dokter.kode_resep, dbo.fr_far_resep_ri_dokter.st_stop, 
                      dbo.fr_far_resep_ri_dokter.tgl_st_stop, dbo.fr_far_resep_ri_dokter.id_user_st_stop, dbo.fr_far_resep_ri_dokter.tgl_review, dbo.fr_far_resep_ri_dokter.st_review, dbo.mt_barang.nama_brg, 
                      dbo.fr_far_resep_ri_dokter.flag_kirim, dbo.fr_far_resep_ri_dokter.flag_perawat, dbo.fr_far_resep_ri_dokter.flag_permintaan, dbo.fr_far_resep_ri_dokter.jml_takar
FROM         dbo.fr_far_resep_ri_dokter INNER JOIN
                      dbo.mt_barang ON dbo.fr_far_resep_ri_dokter.kode_brg = dbo.mt_barang.kode_brg LEFT OUTER JOIN
                      dbo.mt_penggunaan ON dbo.fr_far_resep_ri_dokter.penggunaan = dbo.mt_penggunaan.id LEFT OUTER JOIN
                      dbo.mt_takaran ON dbo.fr_far_resep_ri_dokter.takaran = dbo.mt_takaran.id_takaran
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fr_far_resep_ri_dokter_v]");
    }
};
