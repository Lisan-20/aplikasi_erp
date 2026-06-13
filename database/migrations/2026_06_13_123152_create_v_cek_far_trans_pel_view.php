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
        DB::statement("CREATE VIEW dbo.v_cek_far_trans_pel
AS
SELECT     dbo.tc_trans_pelayanan.kode_barang, dbo.fr_tc_far_detail.harga_jual, dbo.fr_tc_far_detail.kd_tr_resep, dbo.fr_tc_far_detail.kode_trans_far, dbo.tc_trans_pelayanan.kd_tr_resep AS kode, 
                      dbo.fr_tc_far_detail.kode_brg, dbo.fr_tc_far.tgl_trans, YEAR(dbo.fr_tc_far.tgl_trans) AS tahun, dbo.fr_tc_far_detail.status_kirim
FROM         dbo.fr_tc_far_detail INNER JOIN
                      dbo.fr_tc_far ON dbo.fr_tc_far_detail.kode_trans_far = dbo.fr_tc_far.kode_trans_far LEFT OUTER JOIN
                      dbo.tc_trans_pelayanan ON dbo.fr_tc_far_detail.kode_brg = dbo.tc_trans_pelayanan.kode_barang AND dbo.fr_tc_far_detail.kd_tr_resep = dbo.tc_trans_pelayanan.kd_tr_resep AND 
                      dbo.fr_tc_far_detail.kode_trans_far = dbo.tc_trans_pelayanan.kode_trans_far
WHERE     (dbo.tc_trans_pelayanan.kd_tr_resep IS NULL) AND (dbo.fr_tc_far_detail.status_kirim = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_cek_far_trans_pel]");
    }
};
