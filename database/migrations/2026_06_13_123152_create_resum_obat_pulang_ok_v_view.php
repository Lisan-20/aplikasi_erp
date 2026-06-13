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
        DB::statement("CREATE VIEW dbo.resum_obat_pulang_ok_v
AS
SELECT     dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.jumlah, dbo.tc_trans_pelayanan.kode_trans_far, dbo.tc_trans_pelayanan.kode_bagian, 
                      dbo.tc_trans_pelayanan.kode_barang, dbo.tc_trans_pelayanan.kd_tr_resep, dbo.mt_takaran.takaran, dbo.fr_tc_far_detail.jml_pakai, dbo.fr_tc_far_detail.jml_takar, dbo.mt_penggunaan.penggunaan, 
                      dbo.fr_tc_far_detail.takaran AS Expr1, dbo.fr_tc_far_detail.penggunaan AS Expr2, dbo.fr_tc_far_detail.jumlah_pesan - ISNULL(dbo.fr_tc_far_detail.jumlah_retur, 0) AS Expr3, 
                      dbo.fr_tc_far_detail.jumlah_pesan, dbo.tc_trans_pelayanan.kode_bagian_asal, dbo.fr_tc_far_detail.instruksi, dbo.fr_tc_far.flag_obt_plang, dbo.tc_trans_pelayanan.no_mr, dbo.fr_tc_far.kode_dokter, 
                      dbo.fr_tc_far_detail.isi_cara, dbo.fr_tc_far_detail.isi_waktu, dbo.fr_tc_far_detail.isi_signa, dbo.fr_tc_far_detail.tgl_update_rek, dbo.fr_tc_far_detail.id_user_rek
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.fr_tc_far_detail ON dbo.tc_trans_pelayanan.kd_tr_resep = dbo.fr_tc_far_detail.kd_tr_resep INNER JOIN
                      dbo.fr_tc_far ON dbo.tc_trans_pelayanan.kode_trans_far = dbo.fr_tc_far.kode_trans_far LEFT OUTER JOIN
                      dbo.mt_penggunaan ON dbo.fr_tc_far_detail.penggunaan = dbo.mt_penggunaan.id LEFT OUTER JOIN
                      dbo.mt_takaran ON dbo.fr_tc_far_detail.takaran = dbo.mt_takaran.id_takaran
GROUP BY dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.jumlah, dbo.tc_trans_pelayanan.kode_trans_far, dbo.tc_trans_pelayanan.kode_bagian, 
                      dbo.tc_trans_pelayanan.kode_barang, dbo.tc_trans_pelayanan.kd_tr_resep, dbo.mt_takaran.takaran, dbo.fr_tc_far_detail.jml_pakai, dbo.fr_tc_far_detail.jml_takar, dbo.mt_penggunaan.penggunaan, 
                      dbo.fr_tc_far_detail.takaran, dbo.fr_tc_far_detail.penggunaan, dbo.fr_tc_far_detail.jumlah_pesan - ISNULL(dbo.fr_tc_far_detail.jumlah_retur, 0), dbo.fr_tc_far_detail.jumlah_pesan, 
                      dbo.tc_trans_pelayanan.kode_bagian_asal, dbo.fr_tc_far_detail.instruksi, dbo.fr_tc_far.flag_obt_plang, dbo.tc_trans_pelayanan.no_mr, dbo.fr_tc_far.kode_dokter, dbo.fr_tc_far_detail.isi_cara, 
                      dbo.fr_tc_far_detail.isi_waktu, dbo.fr_tc_far_detail.isi_signa, dbo.fr_tc_far_detail.tgl_update_rek, dbo.fr_tc_far_detail.id_user_rek
HAVING      (dbo.fr_tc_far_detail.jumlah_pesan - ISNULL(dbo.fr_tc_far_detail.jumlah_retur, 0) > 0) AND (dbo.fr_tc_far.flag_obt_plang = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [resum_obat_pulang_ok_v]");
    }
};
