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
        DB::statement("CREATE OR ALTER VIEW dbo.update_kode_dokter_trans_pelayanan_v
AS
SELECT     dbo.tc_trans_pelayanan.kode_trans_far, dbo.tc_trans_pelayanan.kd_tr_resep, dbo.tc_trans_pelayanan.kode_barang, dbo.fr_tc_far.kode_dokter, 
                      dbo.tc_trans_pelayanan.kode_dokter1
FROM         dbo.fr_tc_far INNER JOIN
                      dbo.fr_tc_far_detail ON dbo.fr_tc_far.kode_trans_far = dbo.fr_tc_far_detail.kode_trans_far INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.fr_tc_far.kode_trans_far = dbo.tc_trans_pelayanan.kode_trans_far AND 
                      dbo.fr_tc_far_detail.kd_tr_resep = dbo.tc_trans_pelayanan.kd_tr_resep AND dbo.fr_tc_far_detail.kode_brg = dbo.tc_trans_pelayanan.kode_barang AND 
                      dbo.fr_tc_far.kode_dokter <> dbo.tc_trans_pelayanan.kode_dokter1
WHERE     (dbo.fr_tc_far.kode_dokter > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_kode_dokter_trans_pelayanan_v]");
    }
};
