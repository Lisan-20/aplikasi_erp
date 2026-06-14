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
        DB::statement("CREATE OR ALTER VIEW dbo.resum_obat_lengkap5_v
AS
SELECT     dbo.tc_trans_pelayanan.tgl_transaksi, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.jumlah, dbo.tc_trans_pelayanan.kode_trans_far, 
                      dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.kode_barang, dbo.tc_trans_pelayanan.kd_tr_resep, dbo.mt_takaran.takaran, dbo.fr_tc_far_detail.jml_pakai, 
                      dbo.fr_tc_far_detail.jml_takar, dbo.mt_penggunaan.penggunaan, dbo.fr_tc_far_detail.takaran AS Expr1, dbo.fr_tc_far_detail.penggunaan AS Expr2, dbo.tc_trans_pelayanan.no_mr
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.fr_tc_far_detail ON dbo.tc_trans_pelayanan.kd_tr_resep = dbo.fr_tc_far_detail.kd_tr_resep LEFT OUTER JOIN
                      dbo.mt_penggunaan ON dbo.fr_tc_far_detail.penggunaan = dbo.mt_penggunaan.id LEFT OUTER JOIN
                      dbo.mt_takaran ON dbo.fr_tc_far_detail.takaran = dbo.mt_takaran.id_takaran
WHERE     (dbo.tc_trans_pelayanan.kode_barang LIKE 'D%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [resum_obat_lengkap5_v]");
    }
};
